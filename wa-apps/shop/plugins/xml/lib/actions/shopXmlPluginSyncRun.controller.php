<?php
class shopXmlPluginSyncRunController extends waLongActionController {

    /**
     * @var shopProductModel
     */
    private $product_model;

    /**
     * @var shopCategoryModel
     */
    private $category_model;

    /**
     * @var shopProductImagesModel
     */
    private $productImagesModel;

    /**
     * @var shopCategoryProductsModel
     */
    protected $cat_prod_model;

    /**
     * @var shopFeatureModel
     */
    protected $feature_model;

    private $markup = array();

    /**
     * @var XMLReader
     */
    public $reader;

    private $cli = false;
    private $move = true;

    const STAGE_PRODUCT         = 'product';
    const STAGE_CATEGORY        = 'category';
    const DEFAULT_TYPE_ID       = 1;

    private $stage_labels = array(
        self::STAGE_CATEGORY => 'Importing categories',
        self::STAGE_PRODUCT  => 'Importing products'
    );

    static $types = array(
        XMLReader::CDATA       => 1, XMLReader::TEXT        => 1,
        XMLReader::ELEMENT     => 1, XMLReader::END_ELEMENT => 1
    );

    static $text_types = array(
        XMLReader::CDATA      => 1,
        XMLReader::TEXT       => 1
    );

    static $complex_types = array(
        'product:sku'      => 'skus',
        'feature:template' => 'features'
    );

    static $tPvm = array('typePrefix' => 1, 'vendor' => 1, 'model' => 1);

    private $_cache = array();
    static $stocks  = array();

    const IMAGES_UPLOAD_DELOLD      = '1';
    const IMAGES_UPLOAD_NEWOLD      = '2';
    const IMAGES_UPLOAD_NEWPROD     = '3';
    const IMAGES_UPLOAD_NONE        = '4';

    const SET_CATEGORY_ALL      = 1;
    const SET_CATEGORY_APPEND   = 2;
    const SET_CATEGORY_NEW      = 3;
    const CATEGORY_NONE         = 4;

    const TYPE_ARBITRARY = 2;
    const TYPE_SIMPLE    = 1;

    public function execute(){
        try {
            parent::execute();
        } catch  ( waException $Ex ) {
            $message = $Ex->getMessage();
            waLog::log($message, 'xml.log');
            if ( $Ex->getCode() == '302' ) {
                echo json_encode( array('warning' => $message) );
            } else {
                echo json_encode( array('error' => $message) );
            }
        }
    }

    protected function restore(){
        $this->initHelpers();

        $this->initReader();

        $this->gc_collect = function_exists('gc_collect_cycles');
        foreach (array('features', 'f_names', 'categories', 'values') as $k ){
            $this->_cache[$k] = array();
        }

        $stock_model  = new shopStockModel();
        $stocks       = $stock_model->select('id')->fetchAll();

        if ( $stocks ){
            foreach ( $stocks as $s ){
                self::$stocks[] = $s['id'];
            }
            unset($stocks);
        }

        if ( $this->data['settings']['markup_type'] == '2' ){
            $path = wa()->getDataPath('plugins/xml/' . $this->data['profile_id'] . '/', true, 'shop') . 'markup.php';
            if ( file_exists($path) ){
                $this->markup = include($path);
                if ( $this->markup ){
                    foreach ( $this->markup as &$m ){
                        $m['limit'] = (double) str_replace(',', '.',$m['limit']);
                        $m['rate']  = (double) str_replace(',', '.', $m['rate']);
                    }
                    unset($m);
                }
            }
        }

        if ( !empty($this->data['settings']['product_name']) && ($this->data['settings']['product_name'] === '2') ){
            $name_path = wa('shop')->getDataPath('plugins/xml/' . $this->data['profile_id'] . '/' . $this->data['settings']['source_type'] . '/', false, 'shop', true) . 'pnames.php';
            if ( file_exists($name_path) ){
                $names = include($name_path);
                if ( $names ){
                    $this->data['product_names'] = array_flip($names);
                }
            }
        }

    }

    private function initHelpers(){
        $this->product_model       = new shopProductModel();
        $this->feature_model       = new shopFeatureModel();
        $this->category_model      = new shopCategoryModel();
        $this->productImagesModel  = new shopProductImagesModel();
        $this->cat_prod_model      = new shopCategoryProductsModel();
    }

    protected function preExecute(){
        $this->getResponse()->addHeader('Content-type', 'application/json');
        $this->getResponse()->sendHeaders();
    }

    /**
     * @throws waException
     */
    protected function init() {
        if (!extension_loaded('xmlreader')) {
            throw new waException(_wp('PHP extension XMLReader required'));
        }

        if (!extension_loaded('simplexml')) {
            throw new waException(_wp('PHP extension SimpleXML required'));
        }

        $this->initHelpers();

        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        $settings   = shopXmlHelper::getProfileConfig($profile_id);

        if ( !$settings ){
            throw new waException(_wp('Profile configuration not found'));
        }

        if ( empty($settings['source_type']) ){
            throw new waException(_wp('Source type not specified'));
        }

        $map_path = shopXmlHelper::mapPath($profile_id, $settings['source_type']);
        if ( !file_exists($map_path) ){
            throw new waException(_wp('No matches specified'));
        }

        $map = include($map_path);

        $this->data['main'] = array();

        $settings['round'] = (int) (!empty($settings['round']) ? $settings['round'] : 0);
        if ( !empty($map) ){
            foreach ( $map as $key => &$data ){
                if ( !empty($data['type']) ){
                    if (strpos($data['type'], '#') !== false) {
                        $data['type'] = explode('#', $data['type']);
                    }

                    if ( is_array($data['type']) ){
                        foreach ( $data['type'] as $tid => $t ){
                            if (strpos($t, 'main:') !== false){
                                $main = explode(':', $t);

                                $this->data['main'][$main[1]][$key] = $key;

                                $this->data['nodes'][$main[1]][$key] = $main[1];
                                unset($data['type'][$tid]);
                            }
                        }
                    } elseif (strpos($data['type'], 'main:') !== false){
                        $main = explode(':', $data['type']);
                        $this->data['main'][$main[1]][$key] = $key;
                        $this->data['nodes'][$main[1]][$key] = $main[1];
                        unset($map[$key]);
                    }
                }
            }

            unset($data);
        }

        if ( empty($this->data['nodes']) ){
            throw new waException(_wp('Nothing to import'));
        }

        $stages = array();
        foreach ( array(self::STAGE_CATEGORY, self::STAGE_PRODUCT) as $s ){

            if ( ($s === self::STAGE_CATEGORY) && empty($settings['import_categories']) ){
                if ( isset($this->data['nodes'][self::STAGE_CATEGORY]) ){
                    unset($this->data['nodes'][self::STAGE_CATEGORY]);
                }

                if ( isset($this->data['main'][self::STAGE_CATEGORY]) ){
                    unset($this->data['main'][self::STAGE_CATEGORY]);
                }
                continue;
            }

            if ( isset($this->data['main'][$s]) ){
                $stages[] = $s;
            }
        }

        if ( empty($stages) ){
            throw new waException(_wp('Nothing to import'));
        }

        $this->data['map'] = $map;

        if ( empty($this->data['map']) ){
            throw new waException(_wp('No matches specified'));
        }

        $this->gc_collect = function_exists('gc_collect_cycles');

        $this->data['profile_id'] = $profile_id;

        if ( !empty($settings['limit_stream']) && !empty($settings['stream_value']) ){
            $stream = (int) $settings['stream_value'];

            if ( $stream >= 100 ){
                $stream = 1000;
            } elseif ($stream > 0) {
                $stream = $stream * 10;
            } else {
                $stream = null;
            }

            if ( !empty($stream) ){
                $this->data['limit_stream'] = $stream;
            }
        }

        $settings['price_up']     = (double) str_replace(',', '.', ifset($settings['price_up'],0));
        $this->data['settings']   = $settings;
        $this->data['img_k']      = 0;
        $this->data['timestamp']  = time();

        foreach (array('undefined_parents','features_map', 'categories_map', 'values_map','images', 'selectable') as $kk){
            $this->data[$kk] = array();
        }

        $this->data['currency']    = wa()->getSetting('currency', 'RUB', 'shop');
        $this->data['memory']      = memory_get_peak_usage();
        $this->data['memory_peak'] = memory_get_usage();

        if (!empty($this->data['settings']['duplicate_as_child'])){
            if ( !empty($this->data['settings']['parent_id']) ){
                $this->data['move'] = array();
            }
        }

        $restore = !empty($settings['restore']);
        $restore_path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', false, 'shop', true) . 'session.php';
        $init = true;

        if ( $restore && file_exists($restore_path) ){
            $session = include($restore_path);
            if ( !empty($session) ){
                foreach ( $session as $k => $v ){
                    $this->data[$k] = $v;
                }
                $this->data['filepath']     = shopXmlHelper::xmlPath($profile_id, $settings);
                $init = false;
            }
        }

        if ( $init ){
            if ( !$file_path = shopXmlHelper::xmlPath($profile_id, $settings) ){
                throw new waException(_wp('No file selected'));
            }

            if ( $settings['source_type'] === 'remote' ){
                $file_url = ifempty($settings['url']);

                if (empty($file_url)) {
                    throw new waException(_wp('Link to the xml file not specified'));
                }

                if ( file_exists($file_path) ){
                    waFiles::delete($file_path);
                }

                $this->download($file_url, $file_path, 1, true);
            }

            $this->data['p_index']      = 0;
            $this->data['product_pid'] = array();
            $this->data['filepath']     = $file_path;

            $this->data['stage']        = reset($stages); // current stage
            $this->data['stages']       = $stages;

            foreach ( $stages as $stage ) {
                $this->data['count'][$stage] = 0;
                $this->data['total_count'][$stage] = 0;
                $this->data['report'][$stage] = array(
                    'new'         => 0,
                    'update'      => 0
                );
                $this->data['offset'][$stage]  = 0;
            }

            $total_count = $this->count();

            if ( !$total_count ){
                throw new waException(_wp('Not found any data to import'));
            }

            if ( !empty($settings['link_separator']) ){
                switch ($settings['link_separator']){
                    case '1':
                        $this->data['separator'] = ',';
                        break;

                    case '2':
                        $this->data['separator'] = ';';
                        break;

                    case '3':
                        $this->data['separator'] = ' ';
                        break;

                    case '4':
                        $this->data['separator'] = '|';
                        break;
                }
            }

            $model = new waModel();

            $sql   = "UPDATE `shop_product` SET xml_updated = 0 WHERE `xml_profile_id` = i:profile_id";
            $model->exec($sql, array('profile_id' => $profile_id));

            $sql = "UPDATE `shop_product_skus` AS sps 
                      JOIN `shop_product` AS sp 
                        ON sps.`product_id` = sp.`id`
                    SET sps.`xml_up` = 0
                    WHERE (sp.`sku_type` = 1) AND (sps.`virtual` = 1) AND (sp.`xml_profile_id` = i:prof_id)";
            $model->exec($sql, array('prof_id' => $profile_id));
        }
    }

    public function count(){
        $total_count = 0;
        foreach ( $this->data['nodes'] as $stage  => $_d ) {
            $this->initReader(false);

            $path = array();
            $p = '';
            $d = 0;

            while ($this->reader->read()) {
                if ($this->reader->nodeType === XMLReader::ELEMENT) {
                    if ($this->reader->depth > $d) {
                        $path[$d] = $d . ':' . $p;
                    } elseif ($this->reader->depth < $d) {
                        end($path);

                        while (key($path) >= $this->reader->depth) {
                            array_pop($path);
                            end($path);
                        }
                    }

                    $node = implode("\\", $path) . (!empty($path) ? "\\" : '') . $this->reader->depth . ':' . $this->reader->localName;

                    if (isset($_d[$node])) {
                        ++$this->data['total_count'][$stage];
                    }

                    $p = $this->reader->localName;
                    $d = $this->reader->depth;
                }
            }

            $total_count += $this->data['total_count'][$stage];
        }

        $this->reader->close();
        return $total_count;
    }

    public function initReader($move = true){
        $filename = $this->data['filepath'];

        if ( $this->reader ){
            $this->reader->close();
        } else {
            $this->reader = new XMLReader();
        }

        if ( !file_exists($filename) ){
            throw new waException('XML file missed');
        }

        libxml_use_internal_errors(true);
        libxml_clear_errors();

        if (!$this->reader->open($filename, null, LIBXML_NONET)) {
            $this->error( 'Error while open XML ' . $filename );
            throw new waException( _wp('Cannot open the file ') . $filename );
        }

        $step = $this->data['stage'];

        if ( $move && $step ){
            $step_nodes = $this->data['main'][$step];

            $current = 0; $d = 0; $p = ''; $path = array();
            while ( $this->reader->read() ){
                if ( $this->reader->nodeType === XMLReader::ELEMENT ){
                    if ( $this->reader->depth > $d ){
                        $path[$d] = $d . ':' . $p;
                    } elseif ( $this->reader->depth < $d ) {
                        end($path);
                        while (key($path) >= $this->reader->depth) {
                            array_pop($path);
                            end($path);
                        }
                    }

                    $node = implode("\\", $path) . (!empty($path) ? "\\" : '') . $this->reader->depth . ':' . $this->reader->localName;

                    if ( isset($step_nodes[$node]) ){
                        if ( $current < $this->data['offset'][$step] ){
                            ++$current;
                        } else {
                            $this->_cache['path'] = $path;
                            $this->_cache['d'] = $d;
                            $this->_cache['p'] = $p;
                            break;
                        }
                    }

                    $p = $this->reader->localName;
                    $d = $this->reader->depth;
                }
            }
        }
    }

    protected function finish($filename) {
        $this->info();
        if ($this->getRequest()->post('cleanup')) {
            if ( $this->reader ){
                $this->reader->close();
            }

            return true;
        }
        return false;
    }

    public function resetCount(){
        $product_model = new shopProductModel();
        if ( isset($this->data['count'][self::STAGE_PRODUCT]) && $this->data['count'][self::STAGE_PRODUCT] > 0 ){
            $sql = "UPDATE `shop_product` AS sp
                        JOIN `shop_product_skus` AS sps
                            ON sp.id = sps.product_id
                    SET sp.count = 0, sps.count = 0, sps.available = 0
                    WHERE sp.xml_profile_id = i:profile_id AND sp.xml_updated = 0";
            $product_model->exec($sql, array('profile_id' => $this->data['profile_id']));
        }
    }

    protected function info(){
        $interval = 0;
        if (!empty($this->data['timestamp'])) {
            $interval = time() - $this->data['timestamp'];
        }

        $offset = array_sum($this->data['offset']);
        $total  = array_sum($this->data['total_count']);
        $stage  = $this->data['stage'];

        $response = array(
            'time'        => sprintf('%d:%02d:%02d', floor($interval / 3600), floor($interval / 60) % 60, $interval % 60),
            'processId'   => $this->processId,
            'progress'    => 0,
            'ready'       => $this->isDone(),
            'offset'      => $offset,
            'total'       => $total,
            'memory'      => sprintf('%0.2fMByte', $this->data['memory'] / 1048576),
            'memory_peak' => sprintf('%0.2fMByte', $this->data['memory_peak'] / 1048576),
        );

        if ( $response['ready'] ){
            $this->removeSession();
        }

        $response['progress']   = ($offset / $total) * 100;
        if ( $response['progress'] > 100 ){
            $response['progress'] = 100;
        }
        $response['progress']   =  sprintf('%0.3f%%', $response['progress']);
        $response['stage']      = $stage;
        $response['stageLabel'] = _wp(ifempty($this->stage_labels[$stage], 'Processing data'));

        if ($this->getRequest()->post('cleanup')) {
            $response['report'] = $this->report();
            if ( !empty($this->data['settings']['hide_excluded']) ){
                $this->resetCount();
            }

            if ( $this->data['offset'][self::STAGE_PRODUCT] >= $this->data['total_count'][self::STAGE_PRODUCT] ){
                $model = new waModel();

                $sql = "DELETE  sps,spf,pfs 
                          FROM `shop_product_skus` AS sps 
                        JOIN `shop_product` AS sp
                            ON sps.`product_id` = sp.`id`
                        JOIN `shop_product_features` AS spf
                           ON sps.`id` = spf.`sku_id`
                        JOIN `shop_product_features_selectable` AS pfs
                           ON spf.`product_id` = pfs.`product_id` AND spf.feature_id = pfs.feature_id AND spf.feature_value_id = pfs.value_id
                        WHERE (sp.`sku_type` = 1)
                          AND (sps.`virtual` = 1)
                            AND (sps.`xml_up` = 0) 
                              AND sp.`xml_profile_id` = i:prof_id";

                $model->exec($sql, array('prof_id' => $this->data['profile_id']));
            }
        }

        echo json_encode($response);
    }

    protected function report() {
        $report = '<div class="successmsg"><i class="icon16 yes"></i> ' . _wp('Synchronization completed successfully') . '</div>';
        $report .= '<div class="sync-report">';

        if ( !empty($this->data['settings']['import_categories']) && !empty($this->data['main'][self::STAGE_CATEGORY]) ) {
            $report .= '
                <div class="categories">
                    <span class="stage-title">' . _wp('Categories') . '</span>
                    
                    <ul class="menu-v">
                        <li>
                            <strong>' . _wp('Total processed') . ': </strong>' . $this->data['count'][self::STAGE_CATEGORY] . '
                        </li>
                        
                        <li>
                            <strong>' . _wp('Added') . ': </strong> ' . $this->data['report'][self::STAGE_CATEGORY]['new'] . '
                        </li>
                        
                        <li>
                            <strong>' . _wp('Updated') . ': </strong> ' . $this->data['report'][self::STAGE_CATEGORY]['update'] . '
                        </li>
                    </ul>
                </div>
            ';
        }

        if ( isset($this->data['count'][self::STAGE_PRODUCT]) ){
            $report .= '<div class="products">
                            <span class="stage-title">' . _wp('Products') . ':</span>

                            <ul class="menu-v">
                                <li><strong>' . _wp('Total processed') . ': </strong> '  . $this->data['count'][self::STAGE_PRODUCT]            . '</li>
                                <li><strong>' . _wp('Added') . ': </strong> '         . $this->data['report'][self::STAGE_PRODUCT]['new']    . '</li>
                                <li><strong>' . _wp('Updated') . ': </strong> '         . $this->data['report'][self::STAGE_PRODUCT]['update'] . '</li>
                            </ul>
                        </div>
                    </div>';
        }

        $interval = 0;
        if (!empty($this->data['timestamp'])) {
            $interval = time() - $this->data['timestamp'];
            $interval = sprintf(_w('%02d hr %02d min %02d sec'), floor($interval / 3600), floor($interval / 60) % 60, $interval % 60);
            $report   .= ' '.sprintf(_w('(total time: %s)'), $interval);
            //$report   .= '<br> <a href="#" class="dispatch-it reload-msync" data-action="" style="margin: 10px 0"><i class="icon16 update"></i> Сброс</a>';
        }

        return $report;
    }

    private function error($message) {
        waLog::log($message, '/shop/plugins/xml.log');
    }

    private function saveSession(){
        if ( !empty($this->data['settings']['restore']) ){
            $session = array(
                'stages'      => $this->data['stages'],
                'stage'       => $this->data['stage'],
                'count'       => $this->data['count'],
                'offset'      => $this->data['offset'],
                'report'      => $this->data['report'],
                'total_count' => $this->data['total_count'],
                'time_start'  => $this->data['timestamp'],
                'time_end'    => time()
            );

            $path = wa()->getDataPath('plugins/xml/' . $this->data['profile_id'] . '/', false, 'shop', true) . 'session.php';
            waUtils::varExportToFile($session,$path);
            unset($session);
        }
    }

    private function removeSession(){
        $path = wa()->getDataPath('plugins/xml/' . $this->data['profile_id'] . '/', false, 'shop', true) . 'session.php';
        if ( file_exists($path) ){
            waFiles::delete($path);
        }
    }

    protected function step(){
        $result = true;

        if ( empty($this->data['images']) ){
            $step      = $this->data['stage'];

            if ( $data = $this->collect(false, true) ) {
                $method = 'step' . ucfirst($step);
                $this->$method($data);

                if ( !empty($data['childs']) ){
                    $result = false;
                }
            }

            $this->saveSession();

            if ( $this->isDoneStage() && !$this->isLastStage() ){
                $this->nextStage();
            }

            if ( $this->gc_collect && (($this->data['count'][$step] % 15) === 0) ){
                gc_collect_cycles();
            }

            if ( !empty($this->data['limit_stream']) && (($this->data['offset'][$step] % $this->data['limit_stream']) === 0) ){
                $result = false;
            }
        } else {
            $result = $this->importImage();
        }

        return $result && !$this->isDone();
    }

    protected function stepCategory($category, $shop_parent_id = 0){

        $profile_id  = $this->data['profile_id'];
        $bind        = (int) $this->data['settings']['bind_to_profile'];

        if ( empty($category['category:xml_id']) || empty($category['category:name']) ){
            return false;
        }

        $id          = $category['category:xml_id'];

        $parent_id   = ifempty($category['category:xml_parent_id'],0);
        $value       = $category['category:name'];

        $holders = array('xml_id' => $id);
        if ( $bind ){
            $holders['profile_id'] = $profile_id;
        }

        $query   = "SELECT id FROM shop_category WHERE `xml_id` = s:xml_id" . ($bind ? " AND `xml_profile_id` = i:profile_id" : "") . ' LIMIT 1';
        $item    = $this->category_model->query($query, $holders)->fetchAssoc();

        if ( $item && !empty($this->data['settings']['no_update_categs']) ){
            return true;
        } elseif (!$item && !empty($this->data['settings']['no_new_categs'])) {
            return true;
        }

        $url    = shopHelper::transliterate($value);
        $categ  = array(
            'name'           => $value,
            'xml_id'         => $id,
            'url'            => $url,
            'xml_profile_id' => $profile_id
        );

        if ( !$shop_parent_id && $parent_id ){
            $query          = "SELECT id, depth, full_url FROM shop_category WHERE `xml_id` = s:xml_id " . ($bind ? "AND `xml_profile_id` = i:profile_id" : "");
            $holders        = array( 'xml_id' => $parent_id);

            if ( $bind ){
                $holders['profile_id'] = $profile_id;
            }

            $parent         = $this->category_model->query($query, $holders)->fetchAssoc();
            $shop_parent_id = ifempty($parent['id']);
        } elseif ( $shop_parent_id && empty($item['parent_id']) ) {
            $categ['parent_id'] = $shop_parent_id;
        }


        if ( $item ){
            $categ = array_merge($item, $categ);
        }

        $category_id = ifset($categ['id']);
        $new = false;

        $url = $this->category_model->suggestUniqueUrl($url, $category_id, $shop_parent_id);
        if ( $url ){
            $categ['url'] = $url;
        }

        if ( $category_id ){
            $this->data['report'][self::STAGE_CATEGORY]['update']++;
            $this->category_model->update($category_id, $categ);
        } else {
            $categ['include_sub_categories'] = 1;
            $category_id = $this->category_model->add($categ, $shop_parent_id);
            $this->data['report'][self::STAGE_CATEGORY]['new']++;
            $new = true;
        }

        if ( $new ){
            $categ = $this->category_model->getById($category_id);
        }

        wa()->event('category_save', $categ);

        if ( $category_id && $parent_id && !$shop_parent_id ){
            if ( empty($this->data['undefined_parents'][$parent_id]) ){
                $this->data['undefined_parents'][$parent_id] = array();
            }
            $this->data['undefined_parents'][$parent_id][] = $category_id;
        }

        if ( !empty($this->data['undefined_parents'][$id]) ){
            foreach ( $this->data['undefined_parents'][$id] as $c_id ){
                $this->category_model->move($c_id, null, $category_id);
                if ( !empty($this->data['move'][$c_id]) ){
                    unset($this->data['move'][$c_id]);
                }
            }
            unset($this->data['undefined_parents'][$id]);
        }

        if ( !$shop_parent_id && !empty($this->data['settings']['duplicate_as_child']) && !empty($this->data['settings']['parent_id'])){
            if ( !$parent_id ){
                $this->category_model->move($category_id, null, (int) $this->data['settings']['parent_id']);
            } else {
                $this->data['move'][$category_id] = $url;
            }
        } else {
            $this->category_model->move($category_id, null, $shop_parent_id);
        }

        if ( !empty($category['childs']) ){
            foreach ( $category['childs'] as $c ){
                $this->stepCategory($c, $category_id);
            }
        }

        if ( !empty($category['products']) ){
            foreach ( $category['products'] as $p ){
                $p['product:category_id'] = $id;
                $this->stepProduct($p);

                ++$this->data['count'][self::STAGE_PRODUCT];
                ++$this->data['offset'][self::STAGE_PRODUCT];
            }
        }
    }

    public function parseEntity($path, $control_depth, $control_node, $control_type){
        $data = array();
        $type = null;


        $p    = $control_node;
        $d    = $control_depth;

        do {
            $type = $this->reader->nodeType;
            if ( !isset(self::$types[$type]) ){
                continue;
            }

            if ( $type === XMLReader::ELEMENT ){
                if ( $this->reader->depth > $d ){
                    $path[$d] = $d . ':' . $p;
                } elseif ( $this->reader->depth < $d ) {
                    end($path);
                    while (key($path) >= $this->reader->depth) {
                        array_pop($path);
                        end($path);
                    }
                }

                $name = $this->reader->localName;
                $key  = implode("\\", $path) . (!empty($path) ? "\\" : '') . $this->reader->depth . ':' . $name;

                if ( isset($this->data['map'][$key]) ){
                    $data_types = ifset($this->data['map'][$key]['type']);

                    if ( !is_array($data_types) ){
                        $data_types = array($data_types);
                    }

                    $complex_structure = false;
                    foreach ( $data_types as $dt ){
                        if ( !empty(self::$complex_types[$dt]) && (self::$complex_types[$dt] !== $control_type) ){
                            $complex_structure = self::$complex_types[$dt];
                            break;
                        }
                    }

                    if ( $complex_structure){
                        if (empty($data[$complex_structure]) ){
                            $data[$complex_structure] = array();
                        }

                        if ( $_cd = $this->parseEntity($path, $this->reader->depth, $this->reader->localName, $complex_structure) ){
                            $data[$complex_structure][] = $_cd;
                        }

                        $data_types = null;
                        continue;
                    }
                }

                if ( $this->reader->hasAttributes ){
                    while ( $this->reader->moveToNextAttribute() ){
                        $attr_key = $key . ':a:' . $this->reader->localName;

                        if ( !empty($this->data['map'][$attr_key]['type']) ){
                            $types = $this->data['map'][$attr_key]['type'];
                            $v     = trim(html_entity_decode((string) $this->reader->value));

                            if ( !is_array($types) ){
                                $types = array($types);
                            }

                            foreach ( $types as $type ){
                                if ( !isset($data[$type]) ){
                                    $data[$type] = $v;
                                } else {
                                    if ( !is_array($data[$type]) ){
                                        $data[$type] = array($data[$type]);
                                    }
                                    $data[$type][] = $v;
                                }
                            }
                        }
                    }

                    $this->reader->moveToElement();
                }

                $d = $this->reader->depth;
                $p = $this->reader->localName;

                if ($this->reader->isEmptyElement && (($d === $control_depth) && ($p === $control_node))){
                    break;
                }
            } elseif ( isset($data_types) && isset(self::$text_types[$type]) ){
                foreach ( $data_types as $data_type ){
                    if ( isset(self::$complex_types[$data_type]) ){
                        continue;
                    }

                    if ( empty($data[$data_type]) ){
                        $data[$data_type] = $this->reader->value;
                    } else {
                        if ( !is_array($data[$data_type]) ){
                            $data[$data_type] = array($data[$data_type]);
                        }
                        $data[$data_type][] = $this->reader->value;
                    }
                }

                $data_types = null;
                continue;

            } elseif ( ($type === XMLReader::END_ELEMENT) && ($this->reader->depth === $control_depth) && ($this->reader->localName === $control_node) ){
                break;
            }

        } while ($this->reader->read());

        return $data;
    }

    protected function collect($is_child = false, $skip_sub_check = false, $depth = 1, $step = null){
        $data = array();
        $type = null;

        if ( !$step ){
            $step = $this->data['stage'];
        }

        ++$this->data['count'][$step];
        ++$this->data['offset'][$step];

        static $node_parts = array();

        if ( empty($node_parts[$step]) ){
            $node_parts[$this->data['stage']] = array();
            $node_paths  = $this->data['main'][$step];

            foreach ( $node_paths as $node_path ){
                $_node_parts = explode("\\", $node_path);
                $last       = end($_node_parts);
                $node_parts[$last] = true;
            }
        }

        $path = $this->_cache['path'];
        $p    = $this->_cache['p'];
        $d    = $this->_cache['d'];

        do {
            $type = $this->reader->nodeType;
            if ( !isset(self::$types[$type]) ){
                continue;
            }

            $k = $this->reader->depth . ':' . $this->reader->localName;

            if ( $type === XMLReader::ELEMENT ){
                if ( $this->reader->depth > $d ){
                    $path[$d] = $d . ':' . $p;
                } elseif ( $this->reader->depth < $d ) {
                    end($path);
                    while (key($path) >= $this->reader->depth) {
                        array_pop($path);
                        end($path);
                    }
                }

                $name = $this->reader->localName;
                $key  = implode("\\", $path) . (!empty($path) ? "\\" : '') . $this->reader->depth . ':' . $name;

                if ( isset($this->data['map'][$key]) ){
                    $data_types = ifset($this->data['map'][$key]['type']);

                    if ( !is_array($data_types) ){
                        $data_types = array($data_types);
                    }

                    $complex_structure = false;
                    foreach ( $data_types as $dt ){
                        if ( !empty(self::$complex_types[$dt]) ){
                            $complex_structure = self::$complex_types[$dt];
                            break;
                        }
                    }

                    if ( $complex_structure ){
                        if (empty($data[$complex_structure]) ){
                            $data[$complex_structure] = array();
                        }

                        if ( $_cd = $this->parseEntity($path, $this->reader->depth, $this->reader->localName, $complex_structure) ){
                            $data[$complex_structure][] = $_cd;
                        }

                        $data_types = null;
                        continue;
                    }

                    $update    = !empty($this->data['map'][$key]['up']);
                    foreach ( $data_types as $data_type ){
                        if ( !$update ){
                            $this->_cache['no_update'][$data_type] = 1;
                            continue;
                        }
                    }
                } elseif (isset($this->data['nodes'][$step][$key])){
                    if ( $step === self::STAGE_CATEGORY ){
                        if ( !$skip_sub_check ){
                            $this->_cache['path'] = $path;
                            $this->_cache['p']    = $p;
                            $this->_cache['d']    = $d;

                            if ( $_childs = $this->collect(true, true, $depth + 1) ){
                                if ( empty($data['childs']) ){
                                    $data['childs'] = array();
                                }

                                $data['childs'][] = $_childs;
                                unset($_childs);
                                continue;
                            }
                        } else {
                            $skip_sub_check = false;
                        }
                    }
                } elseif (isset($this->data['nodes'][self::STAGE_PRODUCT][$key]) && ($step === self::STAGE_CATEGORY) ){
                    $product = $this->parseEntity($path, $this->reader->depth, $this->reader->localName, 'main:product');
                    if ( $product ){
                        $data['products'][] = $product;
                    }
                    continue;
                }

                if ( $this->reader->hasAttributes ){
                    while ( $this->reader->moveToNextAttribute() ){
                        $attr_key = $key . ':a:' . $this->reader->localName;

                        if ( !empty($this->data['map'][$attr_key]['type']) ){
                            $types = $this->data['map'][$attr_key]['type'];
                            $v     = trim(html_entity_decode((string) $this->reader->value));

                            if ( !is_array($types) ){
                                $types = array($types);
                            }

                            foreach ( $types as $type ){
                                if ($type !== 'product:name' || empty($this->data['product_names']) ){
                                    if ( !isset($data[$type]) ){
                                        $data[$type] = $v;
                                    } else {
                                        if ( !is_array($data[$type]) ){
                                            $data[$type] = array($data[$type]);
                                        }
                                        $data[$type][] = $v;
                                    }
                                } elseif (($type === 'product:name') && !empty($this->data['product_names']) && isset($this->data['product_names'][$attr_key])){
                                    if ( !isset($data[$type]) ){
                                        $data[$type] = array();
                                    }

                                    $data[$type][$attr_key] = $v;
                                }
                            }
                        }
                    }

                    $this->reader->moveToElement();
                }

                $d = $this->reader->depth;
                $p = $this->reader->localName;

                if ($this->reader->isEmptyElement && !empty($this->data['nodes'][$step][$key])){
                    if ($is_child){
                        break;
                    } else {
                        while ($this->reader->read() && empty($node_parts[$this->reader->depth . ':' . $this->reader->localName]));
                        break;
                    }
                }
            } elseif ( isset($data_types) && isset(self::$text_types[$type]) ){
                foreach ( $data_types as $data_type ){
                    if ($data_type !== 'product:name' || empty($this->data['product_names']) ) {
                        if (empty($data[$data_type])) {
                            $data[$data_type] = $this->reader->value;
                        } else {
                            if (!is_array($data[$data_type])) {
                                $data[$data_type] = array($data[$data_type]);
                            }
                            $data[$data_type][] = $this->reader->value;
                        }
                    } elseif (($data_type === 'product:name') && !empty($this->data['product_names']) && isset($this->data['product_names'][$key])){
                        if ( empty($data[$data_type]) ){
                            $data[$data_type] = array();
                        }

                        $data[$data_type][$key] = $this->reader->value;
                    }
                }

                if ( isset($save) ){
                    $data[$save] = $this->reader->value;
                    unset($save);
                }
                $data_types = null;
                continue;

            } elseif (isset($save)){
                $data[$save] = $this->reader->value;
                unset($save);
            } elseif ( $type === XMLReader::END_ELEMENT && !empty($node_parts[$k]) ){
                if ( !$is_child ){
                    while ($this->reader->read() && empty($node_parts[$this->reader->depth . ':' . $this->reader->localName]));
                }
                break;
            }

        } while ($this->reader->read());

        $this->_cache['path'] = $path;
        $this->_cache['p'] = $p;
        $this->_cache['d'] = $d;

        return $data;
    }

    protected function stepProduct($data){
        if ( empty($data['product:xml_id']) ){
            waLog::log(_wp('External ID not found'), 'xml.log');
            return false;
        }

        if (empty($data['product:group_id'])){
            $xml_id    = $data['product:xml_id'];
            $sku_type  = shopProductModel::SKU_TYPE_FLAT;
        } else {
            $xml_id    = $data['product:group_id'];
            unset($data['product:group_id']);
            $sku_type  = shopProductModel::SKU_TYPE_SELECTABLE;
            $data['product:xml_id'] = $xml_id;
            $values_map = array();
            $stock  = array('stock_info' => array());
        }

        $category_id = array();
        if ( isset($data['product:category_id']) ){
            if ( !is_array($data['product:category_id']) ){
                $category_id[] = $data['product:category_id'];
            } else {
                $category_id = $data['product:category_id'];
            }
            unset($data['product:category_id']);
        }

        $_parent_id = !empty($this->data['settings']['duplicate_as_child']) && !empty($this->data['settings']['parent_id']) ? (int) $this->data['settings']['parent_id'] : 0; $lvls = array();
        for ( $i = 1; $i <= 3; ++$i ){
            $level = 'product:level_' . $i;

            if ( !empty($data[$level]) ){
                if ( !empty($this->data['settings']['import_categories']) ) {
                    if ( !is_array($data[$level]) ){
                        $data[$level] = array($data[$level]);
                    } else {
                        $data[$level] = array_unique($data[$level]);
                    }

                    foreach ($data[$level] as $lc ){
                        if ( (!$id = $this->getCategoryIdByName(trim($lc), $_parent_id)) && empty($this->data['settings']['no_new_categs']) ){
                            $url    = shopHelper::transliterate($lc);
                            $url    = $this->category_model->suggestUniqueUrl($url, null, $_parent_id);

                            $categ  = array(
                                'name'   => trim($lc),
                                'url'    => $url,
                                'include_sub_categories' => 1,
                                'status' => 1,
                                'type'   => 0
                            );

                            $id = $this->category_model->add($categ, $_parent_id);
                            $this->_cache['cats'][trim($lc) . ($_parent_id ? ':' . $_parent_id : '')] = $id;
                        }

                        if ( $id ){
                            $lvls[$i][] = $id;
                        }
                    }

                    $_parent_id = $id;
                }
                unset($data[$level]);
            }
        }

        if ( $lvls ){
            $lvls = end($lvls);
        }

        $bind         = (int) $this->data['settings']['bind_to_profile'];
        $profile_id   = $this->data['profile_id'];
        $sku_code     = ifempty($data['sku:sku']);

        $product_name = null;
        if ( array_key_exists('product:name', $data) ){
            if ( !empty($data['product:name']) ){
                $product_name = '';
                if ( is_array($data['product:name']) && !empty($this->data['product_names']) ){
                    foreach ( $this->data['product_names'] as $pn_key => $pn_v ){
                        if ( isset($data['product:name'][$pn_key]) ){
                            $product_name .= trim($data['product:name'][$pn_key]) . ' ';
                        }
                    }

                    $product_name = html_entity_decode(trim($product_name));
                    $data['product:name'] = $product_name;
                } elseif ( is_array($data['product:name']) ) {
                    $data['product:name'] = reset($data['product:name']);
                }

                if ( !$product_name ){
                    $data['product:name'] = html_entity_decode($data['product:name']);
                    $product_name = $data['product:name'];
                }
            } else {
                unset($data['product:name']);
            }
        }

        $product_id   = null;

        if ( ($sku_type === shopProductModel::SKU_TYPE_SELECTABLE) && !empty($this->_cache['pids'][$xml_id]) ){
            $product_id = $this->_cache['pids'][$xml_id];
        }

        if (!$product_id = shopXmlHelper::getProductId('xml_id', $xml_id, $bind ? $profile_id : null)) {
            if (!empty($this->data['settings']['searchbysku']) && $sku_code){
                $product_id = shopXmlHelper::getProductIdBySku($sku_code, $bind ? $profile_id : null);
            }

            if ( !$product_id && !empty($this->data['settings']['searchbyname']) && $product_name ){
                $product_id = shopXmlHelper::getProductId('name', $product_name, $bind ? $profile_id : null);
            }
        }

        $new = false;
        if ( !$product_id ){
            if ( !empty($this->data['settings']['no_new_products']) ){
                return true;
            }
            $this->data['report'][self::STAGE_PRODUCT]['new']++;
            $new = true;
        } elseif ( !empty($this->data['settings']['no_update_products']) ){
            $this->product_model->updateById($product_id, array('xml_updated' => 1));
            return true;
        } else {
            if ( !$new && !empty($this->_cache['no_update']) ){
                foreach ($this->_cache['no_update'] as $d_id => $d_v){
                    unset($data[$d_id]);
                }
            }

            if ( $sku_type === shopProductModel::SKU_TYPE_SELECTABLE ){
                $this->_cache['pids'][$xml_id] = $product_id;
            }

            $this->data['report'][self::STAGE_PRODUCT]['update']++;
        }

        $shop_product = new shopProduct($product_id);
        if ( !$shop_product->url && empty($data['product:url']) ){
            $_url = $product_name ? shopHelper::transliterate($product_name) : $xml_id;
            $shop_product->url  = self::suggestUniqueUrl($_url);
        }

        if ( !$shop_product->currency && empty($data['product:currency']) ) {
            $data['product:currency'] = $this->data['currency'];
        }

        if ( !empty($data['product:currency']) && ($data['product:currency'] === 'RUR') ){
            $data['product:currency'] = 'RUB';
        }

        if ( array_key_exists('product:type_id', $data) ){
            $data['product:type_id'] = $this->typeId($data['product:type_id']);
            $shop_product->type_id = $data['product:type_id'];
        }

        $shop_product->xml_updated    = 1;

        $shop_product->xml_id         = $xml_id;

        if ( !$shop_product->xml_profile_id ){
            $shop_product->xml_profile_id = $profile_id;
        }

        $shop_product->sku_type       = $sku_type;

        $update_prices = $this->processPrices($data);

        if ( !empty($update_prices['sku:rrc']) ){
            $update_prices['sku:price'] = $update_prices['sku:rrc'];
            unset($update_prices['sku:rrc']);
        }

        $features_selectable = array();

        static $features_model;
        if ( $product_id && !isset($features_model) ){
            $features_model = new shopProductFeaturesModel();
        }

        $features = !$product_id ? array() : $features_model->getValues($product_id);
        $sku_id   = $shop_product->sku_id ? $shop_product->sku_id : -1;

        static $sku_model;
        if ( $sku_id && !isset($sku_model) ){
            $sku_model = new shopProductSkusModel();
        }

        $sku = ($sku_id > 0) && ($sku_type !== shopProductModel::SKU_TYPE_SELECTABLE) ? $sku_model->getSku($sku_id) : array();
        if ( !is_array($sku) ){
            $sku = array();
        }

        $images = array();
        if ( !empty($data['product:images']) ){
            if ( $this->data['settings']['images'] !== self::IMAGES_UPLOAD_NONE ){
                $images = $data['product:images'];
            }
            unset($data['product:images']);
        }

        if ( !empty($data['product:description']) ){
            $data['product:description'] = htmlspecialchars_decode($data['product:description']);
        }

        if ( array_key_exists('features', $data) ){
            foreach ( $data['features'] as $df ){
                if ( !empty($df['features:name']) && !empty($df['features:value']) && ($f_code = $this->getFeature($df['features:name'], 0, 0, ifempty($df['features:code']))) ){
                    $features[$f_code] = $df['features:value'];
                }
            }

            unset($data['features']);
        }

        $skus = array(); $default_sku_data = array();
        if ( array_key_exists('skus', $data) ){
            if ( !empty($data['skus']) ){
            $skus = $data['skus'];
            }
            unset($data['skus']);
        }

        $available = 1; $stocks = self::$stocks;
        foreach ( $data as $key => $value ){
            $data_type = explode(':', $key);
            $item_type = $data_type[0];

            if ( $item_type === 'product' ){
                if ( is_array($value) ){
                    foreach ( $value as $_v ){
                        if ( $_v ){
                            $value = $_v;
                            break;
                        }
                    }

                    if ( is_array($value) || !$value ){
                        continue;
                    }
                }
                $prd_field = $data_type[1];
                $shop_product->$prd_field = $value;
            } elseif ( $item_type === 'sku' ){
                if ( ($data_type[1] === 'stock') ){
                    if ( is_array($value) ){
                        $value = array_sum(array_map('intval',$value));
                    }
                    $value = $value == 'true' ? null : ($value == 'false' ? 0 : $value);
                    if ( isset($data_type[2]) ){
                        $data_type[2] = (int) $data_type[2];

                        if ( !empty($this->data['settings']['reset_stocks']) ) {
                            foreach ($stocks as $sk_id => $s_id) {
                                $sku['stock'][$s_id] = 0;
                            }

                            $current_s_id = array_search($data_type[2], $stocks);
                            if ( $current_s_id !== false ){
                                unset($stocks[$current_s_id]);
                            }
                        }

                        $sku['stock'][$data_type[2]] = $value;
                        if ( $sku_type === shopProductModel::SKU_TYPE_SELECTABLE ){
                            $stock['stock_info'][$data_type[2]] = $value;
                        }
                    } else {
                        $sku['count'] = $value;
                        if ( $sku_type === shopProductModel::SKU_TYPE_SELECTABLE ){
                            $stock['count'] = $value;
                        }
                    }
                    $available = is_null($value) ? 1 : !!$value;
                } elseif ($data_type[1] === 'available'){
                    $value = !$value || ($value == 'false') ? 0 : 1;
                    if ( $sku_type === shopProductModel::SKU_TYPE_SELECTABLE ){
                        $stock['available'] = $value;
                    }

                    $sku[$data_type[1]] = $value;
                    $available = null;
                } else {
                    if ( is_array($value) ){
                        $value = reset($value);
                    }
                    $sku[$data_type[1]] = $value;
                }

                if ( $skus ){
                    $default_sku_data[$key] = $value;
                }
            } elseif ( $item_type === 'feature' ){
                if (($data_type[1] === 'exists') && ($feature = $this->featureById($data_type[2], $shop_product->type_id) )){
                    $feature_id = $feature['id'];

                    if ( is_array($value) ){
                        if ( $feature['multiple'] ){
                            $features[$feature['code']] = $value;
                        } else {
                            $features[$feature['code']] = implode(';', $value);
                        }
                    } else {
                        if ( $feature['type'] === 'dimension.weight' ){
                            $features[$feature['code']] = array(
                                'value' => $value,
                                'unit' => $this->data['settings']['weight_unit']
                            );
                        } else {
                            if ( $feature['multiple'] ){
                                $features[$feature['code']] = array($value);
                            } else {
                                $features[$feature['code']] = $value;
                            }
                        }
                    }

                    if ( (!empty($data_type[3]) && ($data_type[3] === '+')) && $feature['multiple'] && $feature['selectable'] ){
                        $_value = !is_array($value) ? array($value) : $value;

                        foreach ( $_value as $v ){
                            $v = str_replace(array("'",'"'),'', $v);

                            if ( empty($features_selectable[$feature['code']]) ){
                                $features_selectable[$feature['code']] = array('values' => array());
                            }

                            $values_map[$feature_id] = self::valueId($feature,$v);
                            $features_selectable[$feature['code']]['values'][$values_map[$feature_id]] = shopXmlHelper::fetchSelectable($v, ifset($update_prices['sku:price']));
                        }
                    }
                }
            }
        }

        if ( $skus ){
            $_skus = array();
            $psku_default_id = -1;

            foreach ( $skus as $psku ){
                $shop_sku = $product_id && !empty($psku['sku:sku']) ? $this->getSku($product_id, $psku['sku:sku']) : array();

                $shop_sku_id = ifempty($shop_sku['id'], $psku_default_id);
                unset($shop_sku['id']);

                if ( !$shop_sku ){
                    $shop_sku = array(
                        'sku_type'  => shopProductModel::SKU_TYPE_FLAT,
                        'available' => 1,
                        'count' => null,
                        'price' => 0
                    );
                }

                foreach ( $psku as $psku_field => $psku_val ){
                    $psf = explode(':', $psku_field);

                    if ( ($psf[1] === 'stock') && isset($psf[2]) ){
                        if ( !isset($shop_sku['stock']) ){
                            $shop_sku['stock'] = array();
                        }

                        $shop_sku['stock'][$psf[2]] = $psku_val;
                    } else {
                        $shop_sku[$psf[1]] = $psku_val;
                    }
                }

                if ( $default_sku_data ){
                    foreach ( $default_sku_data as $skey => $sval ){
                        if ( !array_key_exists($skey, $psku) ){
                            $eskey = explode(':', $skey);

                            if ( ($eskey[1] === 'stock') && !empty($eskey[2]) ){
                                if ( empty($shop_sku['stock']) ){
                                    $shop_sku['stock'] = array();
                                }

                                $shop_sku['stock'][$eskey[2]] = $sval;
                            } else {
                                $shop_sku[$eskey[1]] = $sval;
                            }
                        }
                    }
                }

                if ( !array_key_exists('price',$shop_sku) ){
                    $sku['price'] = 0;
                }

                if ( !array_key_exists('available', $shop_sku) ){
                    $sku['available'] = 1;
                }

                if ( !array_key_exists('count', $shop_sku)  ){
                    $shop_sku['count'] = null;
                }

                $_skus[$shop_sku_id] = $shop_sku;

                if ( $shop_sku_id < 0 ){
                    --$psku_default_id;
                }
            }

            if ( $_skus ){
                $shop_product->skus = $_skus;
            }
        }

        if ( !$shop_product->type_id && !empty($this->data['settings']['product_type']) ) {
            $shop_product->type_id = $this->data['settings']['product_type'];
        }

        $up_prices = false;
        if ( !empty($features_selectable) && !$sku_type ){
            $values_map = array();
            $up_prices  = true;
            $sku_type   = shopProductModel::SKU_TYPE_SELECTABLE;
            $shop_product->sku_type = $sku_type;
        } elseif ($sku_type && empty($features_selectable)){
            $values_map = array();
            $sku_type = shopProductModel::SKU_TYPE_FLAT;
            $shop_product->sku_type = $sku_type;
        }

        if ( !empty($this->data['settings']['mark_feature']) && !empty($this->data['settings']['mark_value']) ){
            $features[$this->data['settings']['mark_feature']] = $this->data['settings']['mark_value'];
        }

        if ( $features ) {
            $shop_product->features = $features;
        }

        if ( !empty($this->data['settings']['import_categories']) || ($new && !empty($this->data['settings']['new_parent_id'])) || $lvls ){
            $set = false;
            $product_categories = self::productCategories($shop_product);

            if (!empty($this->data['settings']['import_categories'])){
                switch( ifempty($this->data['settings']['category']) ){
                    case self::SET_CATEGORY_NEW:
                        if ( $new ){
                            $set = true;
                        }
                        break;
                    case self::SET_CATEGORY_ALL:
                        $set = true; $product_categories = array();
                        break;
                    case self::SET_CATEGORY_APPEND:
                        $set = true;
                        break;
                }

                if ( $set ){
                    foreach( $category_id as $c_id ){
                        if ( !empty($this->data['settings']['allow_categ_map']) ) {
                            if ( !empty($this->_cache['categs'][$c_id]) ){
                                $product_categories[] = $this->_cache['categs'][$c_id]['id'];
                            }
                        } else {
                            $product_categories[] = $this->getCategoryId($c_id);
                        }
                    }
                    unset($category_id);

                    if ( $lvls ){
                        foreach ($lvls as $lvl_id ){
                            $product_categories[] = $lvl_id;
                        }
                    }
                }
            }

            if ($new && !empty($this->data['settings']['new_parent_id'])){
                $product_categories[] = $this->data['settings']['new_parent_id'];
                $set = true;
            }

            if ( $set ){
                $shop_product->categories = array_unique($product_categories);
            }
        }

        if ( $sku_type === shopProductModel::SKU_TYPE_SELECTABLE ){
            foreach ( array('price', 'compare_price', 'purchase_price') as $pkey ){
                $ppkey = 'sku:' . $pkey;
                $pkeyp = ($pkey == 'price' ? 'base_price' : $pkey) . '_selectable';
                if ( array_key_exists($ppkey, $update_prices) ){
                    $shop_product->$pkeyp = $update_prices[$ppkey];
                }
            }

            if ( $features_selectable && empty($values_map)){
                $shop_product->features_selectable = $features_selectable;
            }

            $shop_product->save();

            $product_id = $shop_product->getId();
            if ( !empty($values_map) ){
                static $product_features_m;
                static $skus_model;

                if ( !isset($product_features_m) ){
                    $product_features_m = new shopProductFeaturesModel();
                }

                if ( !isset($skus_model) ){
                    $skus_model = new shopProductSkusModel();
                }

                if ( !($sku_id = $product_features_m->getSkuByFeatures($product_id, $values_map)) ){
                    $sku_data = array(
                        'name'       => '',
                        'sku'        => '',
                        'virtual'    => 1,
                        'product_id' => $product_id,
                        'available'  => 1,
                        'count'      => null,
                        'price'          => $shop_product->base_price_selectable,
                        'compare_price'  => $shop_product->compare_price_selectable,
                        'purchase_price' => $shop_product->purchase_price_selectable
                    );

                    $sku_name = array();
                    if ( $features_selectable ){
                        foreach ( $features_selectable as $fcode => $fdata ){
                            foreach ( $fdata['values'] as $vid => $v ){
                                $sku_name[] = ifempty($v['value'],'');
                            }
                        }
                    }

                    if ( !empty($sku_name) ) {
                        $sku_data['name'] = implode(', ', $sku_name);
                    }

                    if ( $new ){
                        $sku_id = $shop_product->sku_id;
                    } else {
                        $sku_data = $skus_model->add($sku_data);
                        $sku_id = $sku_data['id'];
                    }

                    static $selectable_model;
                    if ( !$selectable_model ){
                        $selectable_model = new shopProductFeaturesSelectableModel();
                    }

                    foreach ( $values_map as $f_id => $v_id ){
                        $ins = array(
                            'product_id' => $product_id,
                            'feature_id' => $f_id,
                            'value_id'   => $v_id
                        );

                        $selectable_model->insert($ins,2);

                        unset($ins['value_id']);
                        $ins['feature_value_id'] = $v_id;

                        $ins['sku_id'] = $sku_id;
                        $product_features_m->insert($ins, 1);
                    }

                    $new = true;
                } else {
                    $sku_data = $skus_model->getSku($sku_id);
                }

                if ( !empty($update_prices) ){
                    foreach ( $update_prices as $price_key => $price_value){
                        $sv = explode(':',$price_key);
                        $sku_data[$sv[1]] = $price_value;
                    }
                }

                if ( !empty($stock) ){
                    if ( isset($stock['stock_info']) ){
                        $sku_data['stock'] = array();

                        if ( !empty($this->data['settings']['reset_stocks']) ){
                            foreach ( self::$stocks as $s_id ){
                                $sku_data['stock'][$s_id] = 0;
                            }
                        }

                        foreach ( $stock['stock_info'] as $stock_id => $in_stock ){
                            $sku_data['stock'][$stock_id] = $in_stock;
                        }
                        unset($stock['stock_info']);
                    } elseif ( array_key_exists('stock', $sku_data) && array_key_exists('count', $stock) ) {
                        unset($sku_data['stock']);
                    }

                    if ( !empty($stock) ){
                        foreach ( $stock as $s_key => $s_val ){
                            $sku_data[$s_key] = $s_val;
                        }
                    }
                }

                $sku_data['xml_up'] = 1;

                if ( !empty($data['sku:sku']) ){
                    $sku_data['sku'] = is_array($data['sku:sku']) ? reset($data['sku:sku']) : $data['sku:sku'];
                }

                $sku_data['product_id'] = $product_id;

                $sku_data['virtual'] = 1;

                if ( array_key_exists('id', $sku_data) ){
                    unset($sku_data['id']);
                }

                $skus_model->update($sku_id, $sku_data);
            } elseif ( $up_prices ){
                $skus = $shop_product->skus;
                foreach ( $skus as &$s ){
                    $s['yml_up'] = 1;
                    foreach ( array('price', 'compare_price', 'purchase_price') as $pkey ){
                        $ppkey = 'sku:' . $pkey;
                        if ( array_key_exists($ppkey, $update_prices) ){
                            $s[$pkey] = $update_prices[$ppkey];
                        }
                    }
                }
                unset($s);
                $shop_product->skus = $skus;
                $shop_product->save();
            }

        } else {
            if ( empty($skus) ){
                if ( !is_null($available) ){
                    $sku['available'] = $available;
                }

                if ( !array_key_exists('price',$sku) ){
                    $sku['price'] = 0;
                }

                if ( !array_key_exists('available', $sku) ){
                    $sku['available'] = 1;
                }
                if (!$product_id){
                    $shop_product->skus = array($sku_id => $sku);
                    $shop_product->save();
                    $product_id = $shop_product->getId();
                } else {
                    $shop_product->save();
                    $sku['product_id'] = $shop_product->getId();
                    $sku_model->update($shop_product->sku_id, $sku);
                }
            } else {
                $shop_product->save();
            }
        }

        if ( !empty($images) && !(($this->data['settings']['images'] === self::IMAGES_UPLOAD_NEWPROD) && !$new) ) {
            if ($this->data['settings']['images'] === self::IMAGES_UPLOAD_DELOLD) {
                $this->productImagesModel->deleteByProducts(array($product_id), true);
            }

            if ( !is_array($images) ){
                $images = array((string) $images);
            }

            $img_index = 0;
            $separate  = array_key_exists('separator', $this->data);
            foreach ($images as $picture){
                if ( $separate ){
                    $picture = explode($this->data['separator'], $picture);
                    foreach ( $picture as $pic ){
                        $this->data['images'][] = $img_index . '{x}' . $product_id . '{x}' . trim($pic) . (($sku_type === shopProductModel::SKU_TYPE_SELECTABLE) && $sku_id ? '{x}' . $sku_id : '');
                        ++$img_index;
                    }
                } else {
                    $this->data['images'][] = $img_index . '{x}' . $product_id . '{x}' . trim($picture) . (($sku_type === shopProductModel::SKU_TYPE_SELECTABLE) && $sku_id ? '{x}' . $sku_id : '');
                    ++$img_index;
                }
            }
        }

        return true;
    }

    public function getSku($product_id, $sku_code){
        $sql    = "SELECT `id` FROM `shop_product_skus` WHERE `product_id` = i:pid AND `sku` = s:sku LIMIT 1";
        $sku_id = $this->product_model->query($sql, array('pid' => $product_id, 'sku' => $sku_code))->fetchField('id');

        static $sku_model;
        if ( !isset($sku_model) ){
            $sku_model = new shopProductSkusModel();
        }

        return $sku_id ? $sku_model->getSku($sku_id) : array();
    }

    public function processPrices(&$data, $check_skus = true){
        $update_prices = array();

        foreach (array('sku:rrc', 'sku:price', 'sku:compare_price', 'sku:purchase_price') as $price_key) {
            if (array_key_exists($price_key, $data)) {
                if (is_array($data[$price_key])) {
                    $data[$price_key] = reset($data[$price_key]);
                }

                $data[$price_key] = (double)str_replace(',', '.', $data[$price_key]);

                if ($price_key !== 'sku:purchase_price') {
                    if ($price_key !== 'sku:rrc') {
                        if (!empty($this->data['settings']['markup_type'])) {
                            if ($this->data['settings']['markup_type'] === '1') {
                                if ($this->data['settings']['type_of_markup'] === '1') {
                                    $data[$price_key] += ($data[$price_key] / 100) * $this->data['settings']['price_up'];
                                } else {
                                    $data[$price_key] += (double)$this->data['settings']['price_up'];
                                }
                            } elseif ($this->data['settings']['markup_type'] === '2') {
                                $data[$price_key] = $this->markUp($data[$price_key]);
                            }
                        }
                    }

                    if (!empty($this->data['settings']['round'])) {
                        switch ($this->data['settings']['round']) {
                            case 1:
                                $data[$price_key] = ceil($data[$price_key]);
                                break;

                            case 5:
                            case 10:
                            case 100:
                                $data[$price_key] = ceil($data[$price_key] / $this->data['settings']['round']) * $this->data['settings']['round'];
                                break;
                        }
                    }
                }

                $update_prices[$price_key] = $data[$price_key];
            }
        }

        if ( $check_skus && !empty($data['skus']) ){
            foreach ( $data['skus'] as &$sku ){
                $this->processPrices($sku, false);
            }
        }

        return $update_prices;
    }

    public function typeId($type_name){

        if ( empty($this->_cache['ptypes'][$type_name]) ){
            static $type_model;

            if ( !isset($type_model) ){
                $type_model = new shopTypeModel();
            }


            if ( !($type = $type_model->getByField('name', $type_name)) ){
                $data = array(
                    'name' => $type_name,
                    'icon' => 'box',
                    'cross_selling' => 'alsobought'
                );

                $this->_cache['ptypes'][$type_name] = $type_model->insert($data);
            } else {
                $this->_cache['ptypes'][$type_name] = $type['id'];
            }
        }

        return $this->_cache['ptypes'][$type_name];
    }

    public function markUp($price){
        if ( !empty($this->markup) ){
            foreach ( $this->markup as $m ){
                if ( $price <= $m['limit'] ){
                    if ( $m['type'] === '0' ){
                        $price += $m['rate'];break;
                    } else {
                        $price += ($price/100) * $m['rate'];break;
                    }
                }
            }
        }
        return $price;
    }

    public function featureById($id, $type_id  = null){
        if ( !isset($this->_cache['features'][$id]) ){
            $this->_cache['features'][$id] = $this->feature_model->select('id,code,multiple,selectable,type')->where('id = ' . $id)->fetchAssoc();

            if ( $type_id && !empty($this->_cache['features'][$id]) ){
                $this->addToType($this->_cache['features'][$id]['id'], $type_id);
            }
        }
        return $this->_cache['features'][$id];
    }

    public static function suggestUniqueUrl($url, $try_steps = null){
        $in_use = '';
        $try_steps = !$try_steps ? 20 : $try_steps;
        for ($try = 0; $try <= $try_steps; ++$try) {
            $new_url = $url . ($try > 0 ? ('_' . $try) : '');
            $in_use = self::isProductUrlInUse(array('url' => $new_url, 'id' => 0));
            if (!$in_use) {
                break;
            }
        }

        if ($try <= $try_steps) {
            return $new_url;
        } else {
            return $url;
        }
    }

    public static function isProductUrlInUse($product)
    {
        $col = new shopProductsCollection("search/url={$product['url']}&id!={$product['id']}");
        $count = $col->count();
        if ($count <= 0) {
            return '';
        }
        $found_products = $col->getProducts('id,name', 0, 1);
        $found_product = reset($found_products);
        $template = _w('The URL <strong>:url</strong> is already in use by another product (<a href="?action=products#/product/:another_product_id/" target="_blank" class="bold">:another_product_name</a>). You may still save this product with the same URL, but the storefront will display only one (any) product by this URL.');
        return str_replace(
            array(':url', ':another_product_id', ':another_product_name'),
            array($product['url'], $found_product['id'], htmlspecialchars($found_product['name'])),
            $template
        );
    }

    public function importImage(){
        $result = true;

        if ( $link = reset($this->data['images']) ){
            $parts = explode('{x}', $link);

            if ( !empty($this->data['settings']['enforce_protocol']) && !empty($this->data['settings']['enforce_protocol_option']) ){
                if ( $this->data['settings']['enforce_protocol_option'] == '1' ){
                    $parts[2] = str_replace('http://', 'https://', $parts[2]);
                } elseif ($this->data['settings']['enforce_protocol_option'] == '2') {
                    $parts[2] = str_replace('https://', 'http://', $parts[2]);
                }
            }

            $result = $this->setImage((int) $parts[0], (int) $parts[1], $parts[2], ifempty($this->data['settings']['images']) == 2, ifset($parts[3]));
            array_shift($this->data['images']);
        }

        return $result;
    }

    public function getCategoryId($external_id){
        $bind        = (int) $this->data['settings']['bind_to_profile'];
        $_holders    = array('external_id' => $external_id);

        if ( $bind ){
            $_holders['profile_id'] = $this->data['profile_id'];
        }

        $c_key = $bind ? $external_id . ':' . $this->data['profile_id'] : $external_id;

        if ( empty($this->_cache['categories_map'][$c_key]) ){
            $sql     = "SELECT `id` FROM `shop_category` WHERE `xml_id` = s:external_id" . ($bind ? " AND `xml_profile_id` = i:profile_id" : "") . " LIMIT 1";
            $this->_cache['categories_map'][$c_key] = $this->category_model->query($sql, $_holders)->fetchField('id');
        }

        return $this->_cache['categories_map'][$c_key];
    }

    public function getCategoryIdByName( $name, $parent_id = null ){
        $key      = $name . ($parent_id ? ':' . $parent_id : '');
        if ( !isset($this->_cache['cats'][$key]) ){
            $_holders = array('name' => $name);

            if ($parent_id){
                $_holders['parent_id'] = $parent_id;
            }

            $sql     = "SELECT `id` FROM `shop_category` WHERE `name` = s:name " . ($parent_id ? " AND `parent_id` = i:parent_id " : "") . "LIMIT 1";
            $this->_cache['cats'][$key] = (int) $this->cat_prod_model->query($sql,$_holders)->fetchField('id');
        }

        return $this->_cache['cats'][$key];
    }

    public static function productCategories($product){
        static $model;
        if ( !isset($model) ){
            $model = new waModel();
        }

        $result = array();
        if ( $product->getId() ){
            $sql = "SELECT c.id FROM `shop_category_products` cp JOIN shop_category c ON cp.category_id = c.id
            WHERE cp.product_id = i:id ORDER BY c.left_key";
            $data = $model->query($sql, array('id' => $product['id']))->fetchAll('id');

            if ($data) {
                foreach ( $data as $d ){
                    $result[$d['id']] = $d['id'];
                }

                if ($product['category_id'] && !empty($result[$product['category_id']]) ){
                    $first = $result[$product['category_id']];
                    unset($result[$product['category_id']]);
                    $result = array($first => $first) + $result;
                }
            }
        }

        return !empty($result) ? $result : array();
    }


    public function valueId($feature, $value){
        if ( !$value ) return false;

        $value_id = null;
        if ( empty($this->_cache['values'][$value]) ){
            $this->_cache['values'][$value] = shopFeatureModel::getValuesModel($feature['type'])->getId($feature['id'], $value, $feature['type']);
        }

        return $this->_cache['values'][$value];
    }

    public function getFeature( $name, $multiple = 0, $selectable = 0, $code = null ){
        $name = ucfirst(trim(strtolower($name)));

        if ( !isset($this->_cache['f_names'][$name]) ){
            $feature = $this->feature_model->getByField('name' , $name);
            if ( !$feature ){
                $feature = array(
                    'name' =>  $name,
                    'code' =>  !$code ? strtolower(shopHelper::transliterate($name)) : $code,
                    'type' =>  shopFeatureModel::TYPE_VARCHAR,
                    'selectable' => $selectable,
                    'multiple' => $multiple
                );

                $feature_id = $this->feature_model->save($feature);
                $feature['id'] = $feature_id;

                if ($feature_id){
                    $this->addToType($feature_id);
                }
            }

            $this->_cache['f_names'][$name] = $feature['code'];
        }

        return $this->_cache['f_names'][$name];
    }

    public function addToType($feature_id, $type_id = null){
        if ( empty($type_id) ){
            $type_id = ifset($this->data['settings']['product_type']);
        }

        if ( $feature_id && $type_id ){
            static $model;
            if ( !isset($model) ){
                $model = new shopTypeFeaturesModel();
            }
            $type_data = array('type_id' => $type_id,'feature_id' => $feature_id);
            $model->insert($type_data, 2);
        }
    }

    public static function makeName($file, $ext='', $index, $is_url = false) {
        if ($is_url){
            $_file = explode('?', $file);
            $file  = reset($_file);
        }

        $name       = preg_replace('@[^a-zA-Zа-яА-Я0-9\._\-]+@', '', strtolower(basename(urldecode($file))));
        if ( !$ext ){
            $name_parts = explode(".", $name);
            $ext        = end($name_parts);
        }

        $ext = strtolower($ext);

        if (empty($ext) || !in_array($ext, array('jpeg', 'jpg', 'png', 'gif', 'webp'))) {
            $img_type = exif_imagetype($file);
            switch ($img_type){
                case IMAGETYPE_JPEG:
                    $ext = 'jpg';
                    break;

                case IMAGETYPE_PNG:
                    $ext = 'png';
                    break;

                case IMAGETYPE_GIF:
                    $ext = 'gif';
                    break;

                case IMAGETYPE_WEBP:
                    $ext = 'webp';
                break;

                default:
                    $ext = 'jpeg';
            }

            $name .= '.' . $ext;
        }

        $name = $index . $name;

        return $name;
    }

    public function setImage($index, $product_id, $file, $only_new = true, $sku_id = null){
        static $model;

        $res = true;

        if ($file && $product_id) {
            if (!$model) {
                $model = new shopProductImagesModel();
            }

            $safe_url = shopXmlHelper::secureUrl($file);
            $_is_url = filter_var($safe_url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED) !== false;

            $extension = strtolower(pathinfo(urldecode($file), PATHINFO_EXTENSION));
            $search = array(
                'product_id' => $product_id,
                'ext'		 => $extension
            );

            try {
                $name = self::makeName($file, $search['ext'], $index, $_is_url);
                if ($_is_url) {
                    $pattern = sprintf('@/(%d)/images/(\\d+)/\\2\\.(\\d+(x\\d+)?)\\.([^\\.]+)$@', $search['product_id']);
                    if (preg_match($pattern, $file, $matches)) {
                        $image = array(
                            'product_id' => $matches[1],
                            'id'         => $matches[2],
                            'ext'        => $matches[5],
                        );
                        if ((strpos($file, shopImage::getUrl($image, $matches[3])) !== false) && $model->countByField($image)) {
                            $file = null;
                        }
                    }
                }

                $search['original_filename'] = $name;
                if ( $file && $only_new && $model->countByField($search) ){
                    $file = null;
                }

                if ($file) {
                    if ($_is_url) {
                        $upload_file = wa()->getTempPath('csv/upload/images/');
                        $upload_file .= waLocale::transliterate($name, 'en_US');
                        $upload_file = strtolower($upload_file);
                        $this->download($safe_url, $upload_file);
                        $file = $upload_file;
                    }

                    $config = wa()->getConfig();
                    if (file_exists($file) && ($image = waImage::factory($file))) {
                        $image_changed = false;
                        $event = wa()->event('image_upload', $image);
                        if ($event) {
                            foreach ($event as $result) {
                                if ($result) {
                                    $image_changed = true;
                                    break;
                                }
                            }
                        }

                        $data = array(
                            'product_id'        => $product_id,
                            'upload_datetime'   => date('Y-m-d H:i:s'),
                            'width'             => $image->width,
                            'height'            => $image->height,
                            'size'              => filesize($file),
                            'original_filename' => $name,
                            'filename'          => '',
                            'ext'               => $extension,
                        );

                        if ( !$only_new && ($exists = $model->getByField($search)) ) {
                            $data = array_merge($exists, $data);
                            $thumb_dir = shopImage::getThumbsPath($data);
                            $back_thumb_dir = preg_replace('@(/$|$)@', '.back$1', $thumb_dir, 1);
                            $paths[] = $back_thumb_dir;
                            waFiles::delete($back_thumb_dir); // old backups
                            if (file_exists($thumb_dir)) {
                                if (!(waFiles::move($thumb_dir, $back_thumb_dir) || waFiles::delete($back_thumb_dir)) && !waFiles::delete($thumb_dir)){
                                    throw new waException(_wp("Error while rebuild thumbnails"));
                                }
                            }
                        }

                        if (empty($data['id'])) {
                            $image_id = $data['id'] = $model->add($data);
                        } else {
                            $image_id = $data['id'];
                            $model->updateById($image_id, $data);
                        }

                        if (!$image_id) {
                            $this->error("Database error " . $product_id . ' - ' . $file);
                            return $res;
                        }

                        if ( (++$this->data['img_k'] % 4) === 0 ){
                            $res = false;
                        }

                        if ( $sku_id && $image_id && ($index === 0) ){
                            static $skus_model;
                            if ( !isset($skus_model) ){
                                $skus_model = new shopProductSkusModel();
                            }

                            $skus_model->updateById($sku_id, array('image_id' => $image_id));
                        }

                        $image_path = shopImage::getPath($data);
                        if ((file_exists($image_path) && !is_writable($image_path)) || (!file_exists($image_path) && !waFiles::create($image_path))) {
                            $model->deleteById($image_id);
                            throw new waException(
                                sprintf("The insufficient file write permissions for the %s folder.", substr($image_path, strlen($config->getConfig()->getRootPath())))
                            );
                        }

                        if ($image_changed) {
                            $image->save($image_path);
                            if ($config->getOption('image_save_original') && ($original_file = shopImage::getOriginalPath($data))) {
                                waFiles::copy($file, $original_file);
                            }
                        } else {
                            waFiles::copy($file, $image_path);
                        }
                        shopImage::generateThumbs($data, $config->getImageSizes());
                    } else {
                        $this->error(sprintf('Invalid image file', $file));
                    }
                } elseif ($file) {
                    $this->error(sprintf('File %s not found', $file));
                }

            } catch (waException $e) {
                $this->error($e->getMessage());
            }
            if ($_is_url && $file) {
                waFiles::delete($file);
            }
        }

        return $res;
    }



    protected function dget( $index ){
        $return  = null;

        if ( isset($this->data[$index]) ) {
            if ( is_array($this->data[$index]) ) {
                return isset($this->data[$index][$this->data['stage']]) ? $this->data[$index][$this->data['stage']] : $this->data[$index];
            } else {
                return $this->data[$index];
            }
        } else {
            throw new waException('Cannot get value from data. Undefined offset: ' . $index);
        }
    }

    protected function set( $key , $value , $stage = false ) {
        if ( $stage ) {
            $this->data[$key][$this->data['stage']] = $value;
        } else {
            $this->data[$key] = $value;
        }
    }


    protected function isLastStage(){
        $stages     = $this->dget('stages');
        $stage      = $this->dget('stage');
        $last_key   = sizeof($stages) - 1;

        if ( ($key = array_search( $stage , $stages , true )) !== false ) {
            return $key === $last_key;
        } else {
            throw new waException('Undefined stage');
        }
    }


    protected function isDoneStage(){
        return $this->dget('offset') >= $this->dget('total_count');
    }

    protected function nextStage(){
        $stage      = $this->data['stage'];
        $stage_pos  = array_search( $stage , $this->data['stages'] , true );

        if ( $stage_pos === false ) {
            throw new waException('Cannot set next stage because current stage [' . $stage . '] was not found in stages list');
        }

        $next = $stage_pos + 1;
        if ( isset($this->data['stages'][$next]) ) {
            $this->onStageEnd($stage);
            $this->data['stage'] = $this->data['stages'][$next];
            $this->initReader();
        } else {
            throw new waException('Cannot set next stage. Undefined index: ' . ($stage_pos + 1));
        }
    }

    public function onStageEnd($stage){
        switch ($stage){
            case self::STAGE_CATEGORY:
                if ( !empty($this->data['settings']['duplicate_as_child']) && !empty($this->data['move']) ){
                    $parent_id = $this->data['settings']['parent_id'];
                    foreach ( $this->data['move'] as $id => $url ){
                        $this->category_model->move($id, null, $parent_id);
                    }
                    unset($this->data['move']);
                }

                if ( !empty($this->data['undefined_parents']) ){
                    unset($this->data['undefined_parents']);
                }
                break;
        }
    }

    public function quietExecute($profile_id) {
        $result = null;
        try {
            ob_start();
            $this->_processId = $profile_id;
            $this->cli = true;
            $this->init();
            $this->restore();

            $is_done = $this->isDone();
            while (!$is_done) {
                $this->step();
                $is_done = $this->isDone();
            }
            $this->removeSession();
            $_POST['cleanup'] = true;
            $this->finish(null);

            $out = ob_get_clean();
            $result = array(
                'success' => $this->exchangeReport(),
            );

            if ( $this->reader ){
                $this->reader->close();
            }

        } catch (waException $ex) {
            if ($ex->getCode() == '302') {
                $result = array(
                    'warning' => $ex->getMessage(),
                );
            } else {
                $result = array(
                    'error' => $ex->getMessage(),
                );
            }
        }
        return $result;
    }

    public function exchangeReport(){
        $interval = '—';
        if (!empty($this->data['timestamp'])) {
            $interval = time() - $this->data['timestamp'];
            $interval = sprintf('%02d h %02d min %02d s', floor($interval / 3600), floor($interval / 60) % 60, $interval % 60);
        }

        $template = _wp('Import from XML') . "; " . _wp('Profile') . " - %s. \n" . _wp('Execution time') . ":\t%s";
        $report = sprintf($template, $this->processId, $interval);
        if (!empty($this->data['memory'])) {
            $memory = $this->data['memory'] / 1048576;
            $report .= sprintf("\n" . _wp('Memory consumption') . ":\t%0.3f Mb", $memory);
        }

        if ( isset($this->data['count'][self::STAGE_PRODUCT]) ){
            $report .= sprintf("\n" . _wp('Processed products') . ": %s", $this->data['count'][self::STAGE_PRODUCT]);
        }

        if ( isset($this->data['count'][self::STAGE_CATEGORY]) ){
            $report .= sprintf("\\" . _wp('Processed categories') . ": %s", $this->data['count'][self::STAGE_CATEGORY]);
        }

        $profile_id = $this->data['profile_id'];
        $time = time();
        if ( !$profile_id ){
            $settings_model = new waAppSettingsModel();
            $settings_model->set(array('shop','xml'), 'last_cli_time', $time);
        } else {
            $settings = shopXmlHelper::getProfileConfig($profile_id);
            $settings['last_cli_time'] = $time;
            $profiler  = new shopImportexportHelper('xml');
            $profiler->setConfig($settings,$profile_id);
        }

        return $report;
    }

    private function download($url, $file, $n = 1, $auth = false){
        $ch = curl_init();
        $file;
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

        if ( $auth && !empty($this->data['settings']['http_auth']) && ($this->data['settings']['source_type'] === 'remote') && !empty($this->data['settings']['http_login']) && !empty($this->data['settings']['http_pass']) ){
            $headers[] = 'Authorization: Basic '. base64_encode($this->data['settings']['http_login'] . ':' . $this->data['settings']['http_pass']);
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

    protected function isDone() {
        return (array_sum($this->data['offset']) >= array_sum($this->data['total_count'])) && empty($this->data['images']);
    }

}
