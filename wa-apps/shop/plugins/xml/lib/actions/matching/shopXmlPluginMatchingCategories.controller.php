<?php
class shopXmlPluginMatchingCategoriesController extends waJsonController {
    private $settings;

    public function execute(){
        $profile_id   = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        $path         = wa()->getDataPath( 'plugins/xml/' . $profile_id, true, 'shop' ) . '/' . $profile_id . '.xml';
        $settings     = shopXmlHelper::getProfileConfig($profile_id);
        $force_update = waRequest::post('reset', 0, waRequest::TYPE_INT);

        $this->settings = $settings;

        if ( !file_exists($path) || $force_update ){
            if ( empty($settings['url']) ) {
                throw new waException('Не указана ссылка на файл');
            }

            $this->download($settings['url'], $path);
        }
        
        $list = array();
        $from_cache = false;
        
        $cache_path = wa()->getDataPath('plugins/xml/' . $profile_id, false, 'shop') . '/categ_list.php';
        if ( file_exists($cache_path) && !$force_update ){
            $list = include($cache_path);
            $from_cache = !empty($list);
        }
        
        if ( empty($list) && file_exists($path) ){
            $reader = new XMLReader();
            if ( $reader->open($path) ){
                while ($reader->read() && !(($reader->depth === 3) && ($reader->name === 'category')));
                while ( $reader->name === 'category' ){
                    $category = simplexml_load_string($reader->readOuterXml());
                    $list[] = array(
                        'id'        => (string) $category['id'],
                        'parent_id' => isset($category['parentId']) ? (string) $category['parentId'] : 0,
                        'name'      => (string) $category
                    );
                    
                    if ( !$reader->next('category') ){
                        break;
                    }
                }
                 } else {
                throw new waException('не удалось получить доступ к файлу');
            }
        }
                
        if ( !empty($list) ){
            if ( !$from_cache ){
                waUtils::varExportToFile($list, $cache_path);
            }
            
            $tree = shopXmlHelper::makeTree($list);
            $view = wa()->getView();
            
            $this->response['file_tree'] = $tree;
            
            $view->assign('file_tree', $tree);
            $view->assign('profile_id', $profile_id);
            
            $template_path = wa()->getAppPath('plugins/xml/templates/actions/matching/') . 'Categories.html';
            $this->response['html'] = $view->fetch($template_path);
        }
    }

    private function download($url, $file, $n = 1){
        $ch = curl_init();

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

        if ( !empty($this->data['settings']['http_auth']) && ($this->settings['source_type'] === 'remote') && !empty($this->settings['http_login']) && !empty($this->settings['http_pass']) ){
            $headers[] = 'Authorization: Basic '. base64_encode(rawurlencode($this->settings['http_login']) . ':' . rawurlencode($this->settings['http_pass']));
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