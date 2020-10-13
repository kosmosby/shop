<?php
$model          = new waModel();
$settings_model = new waAppSettingsModel();

$sync_id        = array( 'shop' , 'xml' );

$profile_name   = wa('shop')->getConfig()->getGeneralSettings('name');
if ( !$profile_name ){
    $profile_name = 'Профиль 1';
}

$data = array(
    'name'                    => $profile_name,
    'price_up'                => 0,
    'category'                => 3,
    'allow_categ_map'         => 0,
    'link_separator'          => 0,
    'images'                  => 3,
    'import_categories'       => 1,
    'automatization'          => 1,
    'searchbyname'            => 0,
    'bind_to_profile'         => 0,
    'source_type'             => 'remote',
    'product_names'           => 1,
    'duplicate_as_child'      => 0,
    'no_update_products'      => 0,
    'no_new_products'         => 0,
    'no_new_categs'           => 0,
    'no_update_categs'        => 0,
    'http_auth'               => 0
);

foreach ( $data as $key => $value ){
    $settings_model->set( $sync_id , $key , $value );
}

foreach ( array( 'shop_product', 'shop_category' ) as $table ) {
    foreach ( array('xml_id', 'xml_profile_id', 'xml_updated') as $field ){
        try {
            $model->query("SELECT `{$field}` FROM `{$table}` WHERE 0");
        } catch(waDbException $e) {
            $model->exec("ALTER TABLE `{$table}` ADD `{$field}` " . ($field == 'xml_id' ? "VARCHAR(255)" : "INT NULL") .  " DEFAULT NULL");
        }
    }
}

try {
    $model->query("SELECT `xml_up` FROM `shop_product_skus` WHERE 0");
} catch(waDbException $e) {
    $model->exec("ALTER TABLE `shop_product_skus` ADD `xml_up` INT NULL DEFAULT 0");
}