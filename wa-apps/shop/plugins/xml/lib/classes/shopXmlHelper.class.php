<?php
class shopXmlHelper {

    static $model;

    /**
     * Get product id by name or xml_id
     * @param string
     * @param string
     * @param mixed
     * @return int
     */
    public static function getProductId($field, $value, $profile_id = null){
        if ( !in_array($field, array('xml_id', 'name')) ){
            throw new waException(_wp('Undefined primary key'));
        }

        $sql = "SELECT `id` FROM `shop_product` WHERE `" . $field . "` = s:" . $field .
            (!is_null($profile_id) ? " AND `xml_profile_id` = s:profile_id" : "") . " LIMIT 1";

        $data = array($field => $value);
        if ( !is_null($profile_id) ){
            $data['profile_id'] = $profile_id;
        }

        if ( !self::$model ){
            self::$model = new waModel();
        }

        return (int) self::$model->query($sql, $data)->fetchField('id');
    }

    public static function getProductIdBySku($sku, $profile_id = null){
        $sql = "SELECT sps.`product_id` FROM `shop_product_skus` AS sps " .
            (!is_null($profile_id) ? " JOIN `shop_product` AS sp
                 ON sps.`product_id` = sp.`id`" : "") .
            "WHERE sps.`sku` = s:sku" . (!is_null($profile_id) ? " AND sp.`xml_profile_id` = i:profile_id" : "") .
            " LIMIT 1";

        if ( !self::$model ){
            self::$model = new waModel();
        }

        $params = array('sku' => $sku);
        if ( !is_null($profile_id) ){
            $params['profile_id'] = $profile_id;
        }

        return (int) self::$model->query($sql, $params)->fetchField('product_id');
    }

    public static function xmlPath($profile_id, $settings = array()){
        if ( empty($settings) ){
            $settings = self::getProfileConfig($profile_id);
        }

        if ( $settings['source_type'] === 'server' ){
            if ( !empty($settings['server.file']) && file_exists($settings['server.file']) ){
                return $settings['server.file'];
            }

            return false;
        }

        return self::path( 'plugins/xml/' . $profile_id, '/' . $profile_id . '.' . $settings['source_type'] . '.xml');
    }

    public static function snapshotPath($profile_id, $type = 'remote'){
        return self::path('plugins/xml/' . $profile_id, '/' . $profile_id . '.' . $type . '.snapshot.php' );
    }

    public static function mapPath($profile_id, $source_type){
        return self::path('plugins/xml/' . $profile_id,'/' . $profile_id . '.' . $source_type . '.map.php');
    }
/*PATHREADY*/
    private static function path($path, $suffix){
        return wa()->getDataPath($path, true, 'shop') . $suffix;
    }

    public static function fetchSelectable($value, $price = null, $value_id = null){
        $result = array('value' => $value);
        if ( !is_null($price) ) $result['price'] = (double) str_replace(',', '.', (string) $price);

        if ( $value_id ){
            $result['id'] = $value_id;
        }

        return $result;
    }

    public static function getProfileConfig($profile_id = null){
        if ( $profile_id ){
            $helper = new shopImportexportHelper('xml');
            $config = $helper->getConfig($profile_id);

            if ( empty($config['config']['name']) ){
                $config['config']['name'] = !empty($config['name']) ? $config['name'] : _wp('No name');
            }

            return ifempty($config['config'], array());
        }

        return wa()->getPlugin('xml')->getSettings();
    }

    public static function saveProfileConfig($profile_id = 0, $settings ){
        if ( !$profile_id ){
            $model      = new waAppSettingsModel();
            $token      = array('shop', 'xml');

            foreach ( $settings as $k => $v ){
                $model->set($token, $k, $v);
            }

        } else {
            $profiler  = new shopImportexportHelper('xml');
            $profiler->setConfig($settings,$profile_id);
        }
    }

    public static function getMapFields($flat = false, $extra_fields = false){
        $fields = array(
            'main' => array(
                'category' => _wp('Category'),
                'product'  => _wp('Product')
            ),

            'category' => array(
                'name'          => _wp('Name'),
                'xml_id'        => _wp('External ID'),
                'xml_parent_id' => _wp('Parent external ID'),
                'description'   => _wp('Description')
            ),

            'product' => array(
                'xml_id'            => _wp('External ID'),
                'name'              => _wp('Product name'),
                'currency'          => _wp('Currency'),
                'summary'           => _wp('Summary'),
                'description'       => _wp('Description'),
                'status'            => _wp('Status'),
                'type_id'           => _wp('Product type'),
                'meta_title'        => _wp('Title'),
                'meta_keywords'     => _wp('META Keyword'),
                'meta_description'  => _wp('META Description'),
                'url'               => _wp('Storefront link'),
                'images'            => _wp('Product images'),
                'video_url'         => _wp('Video URL on YouTube or Vimeo'),
                'category_id'       => _wp('Category ID'),
                'group_id'          => _wp('Group ID'),
                'level_1'           => _wp('Category level') . ' 1',
                'level_2'           => _wp('Category level') . ' 2',
                'level_3'           => _wp('Category level') . ' 3',
                'sku'               => _wp('Purchase option')
            ),

            //'product_custom_fields' => array(),
            'sku'                   => array(
                'name'           => _wp('SKU name'), //2
                'sku'            => _wp('SKU code'), //3
                'price'          => _wp('Price'),
                'available'      => _wp('Available for purchase'),
                'compare_price'  => _wp('Compare at price'),
                'purchase_price' => _wp('Purchase price'),
                'stock'          => _wp('In stock'),
                'rrc'            => _wp('Recommended price')
            ),

            //'sku_custom_fields'     => array(),
            'feature' => array(
                'exists'     => _wp('Upload to existing'),
                'template'   => _wp('Template')
            ),

            'features' => array(
                'name'  => _wp('Feature name'),
                'value' => _wp('Feature value'),
                'unit'  => _wp('Feature unit'),
                'code'  => _wp('Feature code')
            )
        );

        if ($extra_fields) {
            $product_model = new shopProductModel();
            $sku_model     = new shopProductSkusModel();

            $meta_fields = array(
                'product' => $product_model->getMetadata(),
                'sku'     => $sku_model->getMetadata(),
            );

            $black_list = array(
                'id',
                'contact_id',
                'create_datetime',
                'edit_datetime',
                'type_id',
                'image_id',
                'image_filename',
                'tax_id',
                'cross_selling',
                'badge',
                'currency',
                'upselling',
                'total_sales',
                'sku_type',
                'sku_count',
                'sku_id',
                'ext',
                'price',
                'compare_price',
                'min_price',
                'max_price',
                'count',
                'rating_count',
                'category_id',
                'base_price_selectable',
                'compare_price_selectable',
                'purchase_price_selectable',
                'rating',
                'xml_profile_id'
            );

            $white_list = array(
                'id_1c' => _wp('1C identifier')
            );

            foreach ($meta_fields['product'] as $field => $info) {
                if (!in_array($field, $black_list)) {
                    $name = ifset($white_list[$field], $field);
                    if (!empty($meta_fields['sku'][$field])) {
                        if (!isset($fields['sku'][$field])) {
                            $fields['sku'][$field] = $name;
                        }

                        if (!isset($fields['product'][$field])) {
                            $fields['product'][$field] = sprintf('%s: %s', _wp('Product'), $name);
                        }

                    } else {
                        if (!isset($fields['product'][$field])) {
                            $fields['product'][$field] = $name;
                        }
                    }
                }
            }
        }

        $stock_model = new shopStockModel();
        $stocks = $stock_model->getAll('id');
        if ($stocks) {
            foreach ($stocks as $stock_id => $stock) {
                $fields['sku']['stock:'.$stock_id] = _wp('In stock').' @'.$stock['name'];
            }
        }

        /**
         * @event product_custom_fields
         * @return array[string]string $return[%plugin_id%]['product'] array
         * @return array[string]string $return[%plugin_id%]['sku'] array
         */
        $custom_fields = wa('shop')->event('product_custom_fields');
        if ($custom_fields) {
            foreach ($custom_fields as $plugin_id => $custom_plugin_fields) {
                # %plugin_id%-plugin became %plugin_id%_plugin
                $plugin_id = preg_replace('@-plugin$@', '_plugin', $plugin_id);
                if (isset($custom_plugin_fields['product'])) {
                    foreach ($custom_plugin_fields['product'] as $field_id => $field_name) {
                        $fields['product_custom_fields'][$plugin_id.':'.$field_id] = $field_name;
                    }
                }
                if (isset($custom_plugin_fields['sku'])) {
                    foreach ($custom_plugin_fields['sku'] as $field_id => $field_name) {
                        $fields['sku_custom_fields'][$plugin_id.':'.$field_id] = $field_name;
                    }
                }
            }
        }


        if ($flat) {
            $fields_ = $fields;
            $fields = array();
            $flat_order = array(
                'product:name',
                'sku:skus:-1:name',
                'sku:skus:-1:sku',
                'product:currency'
            );

            foreach ($flat_order as $field) {
                list($type, $field) = explode(':', $field, 2);
                $fields[$field] = $fields_[$type][$field];
                unset($fields_[$type][$field]);
            }
            $fields += $fields_['sku'];
            $fields += $fields_['product'];
        }

        return $fields;
    }

    public static function merge_arrays( array &$array1, array &$array2 ){
        $merged = $array1;

        foreach ( $array2 as $key => &$value ){
            if ( is_array($value) && isset ($merged[$key]) && is_array ($merged[$key]) ){
                $merged[$key] = self::merge_arrays( $merged[$key], $value );
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }

    public static function makeTree($arr){
        $new = array();

        foreach ($arr as $a){
            $new[$a['parent_id']][] = $a;
        }

        function createTree(&$list, $parent){
            $tree = array();
            foreach ($parent as $k=>$l){
                if (isset($list[$l['id']])){
                    $l['children'] = createTree($list, $list[$l['id']]);
                }
                $tree[$l['id']] = $l;
            }
            return $tree;
        }

        return createTree($new, $new[0]);
    }

    public static function secureUrl($url){
        $d = parse_url(urldecode($url));
        return ifempty($d['scheme'], 'http') . '://' . (!empty($d['user']) || !empty($d['pass']) ? (!empty($d['user'])  ? $d['user'] : '') . ':' . (!empty($d['pass'])  ? $d['pass'] : '') . '@' : '') . $d['host'] . implode('/', array_map('rawurlencode', explode('/', $d['path']))) . (!empty($d['query']) ? '?' . $d['query'] : '');
    }
}