<?php
class shopXmlPlugin extends shopPlugin {
    
    protected $params;

    public static function translate($key = null){
        $translates = array();
        $translates['main'] = _wp('Main');
        $translates['product'] = _wp('Product fields');
        $translates['category'] = _wp('Category fields');
        $translates['product_custom_fields'] = _w("Custom product fields");
        $translates['sku'] = _w('SKU fields');
        $translates['sku_custom_fields'] = _w("Custom sku fields");
        $translates['feature'] = _wp('Product features');
        $translates['features'] = _wp('Characteristic fields');
        //$translates['feature+'] = _w('Add as new feature');
        
        return $key ? ifempty($translates[$key],'') : $translates;
    }
    
    public function external_id($params){
        $this->params = $params;
        return array('title_suffix' => $this->generate_html());
    }
    
    public function category_external_id(){
        $id     = waRequest::get('category_id');
        $extid  = $this->getExtId($id);
            
        return waHtmlControl::getControl(waHtmlControl::INPUT, 'xml_id', array(
            'value' => $extid,
            'title' => 'XML ID',
            'title_wrapper' => '%s',
            'control_wrapper' => '<div class="field"><div class="name">%s</div><div class="value no-shift">%s%s</div></div>',
        ));
    }
    
    public function categorySave(){
        $id    = waRequest::request('category_id');
        $extid = waRequest::post('xml_id');
        $model = new shopCategoryModel();

        if ( isset($id) && isset($extid) ) {
            $holders = array(
                'xml_id' => $extid,
                'id'     => $id
            );
              
            $sql = "UPDATE `shop_category` SET xml_id = s:xml_id WHERE `id` = s:id";
            $model->exec($sql, $holders);
        }
    }
                                     
    protected function generate_html(){
        
        $path = wa('shop')->getAppStaticUrl('shop/plugins/xml');
        
        $html  = '<link href="'. $path .'css/products.css" rel="stylesheet" type="text/css" />';
        $html .= '<script src="'. $path .'js/products.js"></script>'; 
        $html .= '<div class="hint float-right">';
        $html .= $this->create_input();
        $html .= '</div>';
        
        return $html;
    }
                                    
    protected function create_input(){
        $value = $this->isexist();
        if ($value === false){
            return false;
        } else{
            $html = 'XML ID: <input type="text" name="externid" id="extern_optom" value="'.$value.'"/> <input type="hidden" name="internid"  value="'.$this->params['id'].'"/>';
            $html .= '<div id="extern_optom_save_button"><i class="icon16 disk"></i></div>';
        }
        return $html;
    }
    
    protected function getExtId($id){
        $model = new shopCategoryModel();
        $result = $model->getById($id);
        return ifempty($result['xml_id']);
    }
    
    protected function isexist(){
        $product    = new shopProductModel();
        $product_id = $this->params['id'];
        $value      = $product->getById($product_id);
        return ifempty($value['xml_id']);
    }
    
    public static function cutMetaFields(&$shot_data){
        $result = false;
        if ( $shot_data ){
            foreach ( shopXmlPlugin::$xml_meta_fields as $k => $d){
                if (!empty($shot_data[$k])){
                    if ( empty($shot_data[$k]['currencies']) ){
                        $result[$k] = $shot_data[$k]['value'];
                    } elseif (!empty($shot_data[$k]['currencies']) ){
                        $_v = array();
                        foreach ($shot_data[$k]['currencies'] as $currency){
                            if ( !empty($currency['id']) ){
                                $_v[] = $currency['id'] . (!empty($currency['rate']) ? ' (' . $currency['rate'] . ')' : '');
                            }
                        }
                        
                        $result[$k] = $_v ? implode('; ', $_v) : null;
                    }
                }
                
                if ( array_key_exists($k, $shot_data) ){
                    unset($shot_data[$k]);
                }
            }
        }
        unset($shot_data);
        return $result;
    }

    public static function formatSize($size) {

        if ( !is_numeric($size) && is_string($size) && file_exists($size) ){
            $size = filesize($size);
        }

        if ($size >= 1073741824){
            $size = number_format($size / 1073741824, 2) . ' GB';
        }elseif ($size >= 1048576){
            $size = number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            $size = number_format($size / 1024, 2) . ' KB';
        } elseif ($size > 1){
            $size = $size . ' bytes';
        } elseif ($size == 1) {
            $size = $size . ' bytes';
        } else {
            $size = '0 bytes';
        }

        return $size;
    }

    public static function pathInfo($path){
        return $path ? pathinfo($path) : array();
    }

    public function backendProducts(){
        $main = wa()->getPlugin('xml')->getSettings('name');

        $profiles = array();
        if ( $main ){
            $profiles[0] = array(
                'name' => $main
            );
        }

        $profiler      = new shopImportexportHelper('xml');
        $_profiles     =  $profiler->getList();

        if ( $_profiles ){
            $profiles += $_profiles;
        }

        $list          = '';

        if ( $profiles ){
            $list = '<ul class="menu-v with-icons">';
            foreach ( $profiles as $p_id => $p ){
                $list .= '
                        <li data-type="xml_id" id="xml_id-' . $p_id . '">
                            <a href="#/products/hash=xml_id/' . $p_id . '/">
                                <i class="icon16 zone"></i>
                                ' . $p['name'] . '
                            </a>
                        </li>
                    ';
            }
            $list .= '</ul>';
        }

        return array(
            'sidebar_section' => '
                <div class="block drop-target" id="s-xml-profiles-block">
                    <h5 class="heading">
                        <i class="icon16 collapse-handler darr" id="s-xml-profiles-handler"></i>
                        ' . _wp('XML profiles') . '
                    </h5>
                    
                    <div class="s-collection-list" id="s-xml-profiles-list">
                        ' . $list . '
                    </div>
                </div>

                <script type="text/javascript">
                    $.products.xmlAction = function(){
                        var params = Array.prototype.join.call(arguments, \'/\');
                        params = $.shop.helper.parseParams(params || \'\');
                        
                        this.load(\'?module=products&\' + this.buildProductsUrlComponent(params), this.checkAlerts);
                    };
                </script>');
    }

    public function productsCollection($params){
        $collection = $params['collection'];

        $hash   = $collection->getHash();

        if (is_array($hash) && (count($hash) === 2) && ($hash[0] === 'xml_id')) {
            $params['auto_title'] = false;

            $profile_id = (int) $hash[1];

            $config = shopXmlHelper::getProfileConfig($profile_id);

            $collection->addTitle($config['name']);

            $collection->addWhere('xml_profile_id = ' . $profile_id);
            return true;
        } else {
            return false;
        }
    }

    public static function dateDiff($date2){
        $date1 = new DateTime();
        $date2 = new DateTime(date('Y-m-d H:i:s', $date2));
        return (int) $date2->diff($date1)->format('%a');
    }
    
}
