<?php
class shopXmlPluginSnapshotMakeController extends waJsonController {
    static  $limit = 50000;
    private $offset;
    private $profile_id;

    private $done = false;
    private $settings;

    public function array_insert_before($key, array $array, $new_key, $new_value) {
        if (array_key_exists($key, $array)) {
            $new = array();

            foreach ($array as $k => $value) {
                if ($k === $key) {
                    $new[$new_key] = $new_value;
                }
                $new[$k] = $value;
            }

            return $new;
        }
        return $array;
    }

    public function execute(){
        $this->profile_id   = waRequest::request('profile_id',0, waRequest::TYPE_INT);
        $this->offset       = waRequest::post('offset', 0, waRequest::TYPE_INT);

        $settings           = shopXmlHelper::getProfileConfig($this->profile_id);

        $this->settings = $settings;

        $nodes_count        = 0;
        $file_path          = shopXmlHelper::xmlPath($this->profile_id, $settings);
        $shot_data          = array();

        if ( $this->offset === -1 ){
            $force_update = waRequest::post('reset', 0, waRequest::TYPE_INT);
            $cache_path   = shopXmlHelper::snapshotPath($this->profile_id, $settings['source_type']);
            if ( !$force_update && file_exists($cache_path) ){
                $shot_data = include($cache_path);
                if ( !empty($shot_data) ){
                    $this->done = true;
                }
            }

            if ( !$this->done &&  ($force_update || empty($shot_data)) ){
                if ( ($settings['source_type'] === 'remote') ){
                    if ( empty($settings['url']) ){
                        $this->response['error'] = _w('No file link specified');
                        return false;
                    }

                    $this->download($settings['url'], $file_path);
                }

                $this->offset = 0;
            }

            if (!file_exists($file_path)){
                $this->response['error'] = _w('File not found');
                return false;
            }

        } elseif ($this->offset >= 0) {
            $shot_data  = $this->collect($file_path, $nodes_count);
            $tmp_path   = wa()->getDataPath('plugins/xml/' . $this->profile_id . '/', true, 'shop') . 'tmp.snapshot.php';

            if ( !$nodes_count || ($nodes_count < self::$limit) ){
                $this->done = true;
                waFiles::delete($tmp_path, true);
            } else {
                waUtils::varExportToFile($shot_data, $tmp_path);
                $shot_data = null;
            }

            $this->offset += $nodes_count;
        }

        if ( !empty($shot_data) ){
            $cache_path   = shopXmlHelper::snapshotPath($this->profile_id, $settings['source_type']);
            waUtils::varExportToFile($shot_data, $cache_path);
        }

        if ( $this->done ){
            $this->response['html'] = !empty($shot_data) ? $this->fetchSnapshot($shot_data, $settings) : false;
        } else {
            $this->response['offset'] = $this->offset;
        }
    }

    public function collect($file_path, &$nodes){
        $reader     = new XMLReader();

        libxml_use_internal_errors(true);
        libxml_clear_errors();

        if (!$reader->open($file_path, null, LIBXML_NONET)) {
            return false;
        }

        $shot_data        = array();
        $last_inserted    = null;
        $key              = null;

        $tn = array(
            XMLReader::CDATA => 1,
            XMLReader::TEXT  => 1
        );

        $path  = array(); $d = 0; $p = ''; $prev = null;
        $moved = false;

        if ( $this->offset > 0 ){
            $i = 0;
            while ($reader->read()){
                if ( $reader->nodeType === XMLReader::ELEMENT ){
                    $depth = $reader->depth;

                    if ( $depth > $d ){
                        $path[$d] = $d . ':' . $p;
                    } elseif ( $depth < $d ){
                        end($path);
                        while ( key($path) >= $depth ){
                            array_pop($path);
                            end($path);
                        }
                    }

                    $d = $reader->depth;
                    $p = $reader->name;

                    if ( ++$i > $this->offset ){
                        $moved = true;
                        break;
                    }

                    $prev = $reader->nodeType;
                }
            }

            $tmp_path = wa()->getDataPath('plugins/xml/' . $this->profile_id . '/', true, 'shop') . 'tmp.snapshot.php';
            if ( file_exists($tmp_path) ){
                $shot_data = include($tmp_path);
                if ( !is_array($shot_data) ){
                    $shot_data = array();
                }
            }
        }

        $wl   = array(XMLReader::ELEMENT => 1, XMLReader::END_ELEMENT => 1) + $tn;
        while ($moved || $reader->read()){


            if ( isset($wl[$reader->nodeType]) ){

                if ( $reader->nodeType === XMLReader::ELEMENT ){
                    $name     = $reader->localName;
                    $depth    = $reader->depth;

                    if ( $depth > $d ){
                        $path[$d] = $d . ':' . $p;
                    } elseif ( $depth < $d ){
                        end($path);
                        while ( key($path) >= $depth ){
                            array_pop($path);
                            end($path);
                        }
                    }

                    if ( !($reader->isEmptyElement && !$reader->hasAttributes) ) {
                        $key = implode("\\", $path) . ($path ? "\\" : '') . $depth . ':' . $name;

                        if (empty($shot_data[$key])) {
                            $last_inserted = $key;

                            $insert = true;
                            if ($path) {
                                $parent_close = implode("\\", $path) . '/';
                                if (!empty($shot_data[$parent_close])) {
                                    $shot_data = $this->array_insert_before($parent_close, $shot_data, $key, array('value' => null, 'type' => null));
                                    $insert = false;
                                }
                            }

                            if ($insert) {
                                $shot_data[$key] = array('value' => null, 'type' => null);
                            }

                            if ($reader->isEmptyElement) {
                                $shot_data[$key]['empty'] = 1;
                            }
                        } elseif ( empty($shot_data[$key]['value']) && !$reader->isEmptyElement ){
                            $last_inserted = $key;
                        } else {
                            $last_inserted = null;
                        }

                        if ($reader->hasAttributes) {
                            if (!is_array($shot_data[$key])) {
                                $shot_data[$key] = array(
                                    'value' => $shot_data[$key],
                                    'attrs' => array()
                                );
                            }

                            while ($reader->moveToNextAttribute()) {
                                $shot_data[$key]['attrs'][$reader->name] = array('value' => trim(strip_tags($reader->value)), 'type' => null);
                            }

                            $reader->moveToElement();
                        }

                        if ( $reader->isEmptyElement ){
                            $last_inserted = false;
                        }
                    }

                    $d = $reader->depth;
                    $p = $reader->name;

                    ++$nodes;

                    if ( $nodes === self::$limit ){
                        break;
                    }

                } elseif ( $last_inserted && isset($tn[$reader->nodeType]) ){
                    $shot_data[$last_inserted]['value'] = trim(strip_tags($reader->value));
                } elseif ( $reader->nodeType === XMLReader::END_ELEMENT ){
                    if ( !empty($last_inserted) ){
                        $shot_data[$last_inserted]['end'] = 1;
                        $last_inserted = null;
                    } elseif (($reader->nodeType === $prev) || ($last_inserted === false)) {

                        if ( $reader->depth < $d ){
                            end($path);
                            while ( $path && (key($path) >= $reader->depth) ){
                                array_pop($path);
                                end($path);
                            }

                            $d = $reader->depth;
                            $p = $reader->name;
                        }

                        $end_key = implode("\\", $path) . ($path ? "\\" : '') . $reader->depth . ':' . $reader->localName . '/';
                        if ( empty($shot_data[$end_key]) ){
                            $shot_data[$end_key] = 1;
                        }
                    }
                }

                $prev = $reader->nodeType;
            }

            $moved = false;
        }

        $reader->close();

        return $shot_data;
    }

    public function fetchSnapshot($shot_data, $settings){
        $view = wa()->getView();
        $view->assign(array('profile_id' => $this->profile_id, 'snapshot' => $shot_data));

        $map = array();
        $map_path = shopXmlHelper::mapPath($this->profile_id, $settings['source_type']);
        if ( file_exists($map_path) ){
            $map = include($map_path);
        }

        $view->assign('map', $map);

        $max_inputs = (int) @ini_get('max_input_vars');
        if ( !$max_inputs || ($max_inputs < 0) ) {
            $max_inputs = 500;
        }

        $max_inputs -= 10;
        if ( $max_inputs < 10 ){
            $max_inputs = 10;
        } elseif ( $max_inputs > 1500 ){
            $max_inputs = 1000;
        }

        $view->assign('max_inputs', $max_inputs);

        $feature_model = new shopFeatureModel();
        $features      = $feature_model->select('id,name,multiple')->fetchAll('id');
        $view->assign('features', $features);

        $feature_types = shopFeatureModel::getTypes();
        $view->assign('feature_types', $feature_types);

        return $view->fetch(wa()->getAppPath('plugins/xml/templates/actions/snapshot/', 'shop') . 'Snapshot.html');
    }

    private function download($url, $file, $n = 1){
        $ch  = curl_init();

        $url = shopXmlHelper::secureUrl($url);

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        if ( file_exists($file) ){
            waFiles::delete($file);
        }

        $headers = array();
        $headers[] = "Connection: keep-alive";
        $headers[] = "Pragma: no-cache";
        $headers[] = "Cache-Control: no-cache";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "Dnt: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.62 Safari/537.36";

        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "Accept-Encoding: gzip, deflate";
        $headers[] = "Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,ro;q=0.6";
        $headers[] = "Cookie: PHPSESSID=6v79gnbrun4rpe3l1shqkunkn7; f_referer=https%3A%2F%2Fwww.google.ru%2F; _ym_uid=1528219457130625104; _ga=GA1.2.1582923881.1528219458; _gid=GA1.2.1346112713.1528219458; _ym_isad=1";

        if ( !empty($this->settings['http_auth']) && ($this->settings['source_type'] === 'remote') && !empty($this->settings['http_login']) && !empty($this->settings['http_pass']) ){
            $headers[] = 'Authorization: Basic '. base64_encode($this->settings['http_login'] . ':' . $this->settings['http_pass']);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FILE, fopen($file, 'w'));

        $follow = false;
        if ((version_compare(PHP_VERSION, '5.4', '>=') || !ini_get('safe_mode')) && !ini_get('open_basedir')) {
            curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
            $follow = true;
        }

        curl_exec($ch);

        if ( !$follow && ($n < 3) && ($redirectURL = curl_getinfo($ch, CURLINFO_REDIRECT_URL)) ){
            curl_close($ch);
            $this->download($redirectURL, $file, $n + 1);
        } else {
            curl_close($ch);
        }
    }

}