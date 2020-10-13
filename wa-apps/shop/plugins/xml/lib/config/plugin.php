<?php
return array(
    'name'          => _wp('Import products from XML'),
    'version'       => '1.6.4',
    'importexport'  => true,
    'img'           => 'img/xml_icon.png',
    'vendor'        => '1052040',
    'handlers' => array(
        'backend_product'         => 'external_id',
        'backend_category_dialog' => 'category_external_id',
        'category_save'           => 'categorySave',
        'products_collection'     => 'productsCollection',
        'backend_products'        => 'backendProducts'
    )
);
