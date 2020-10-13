<?php
return array(
    'prod_both_pattern' => array (
        'id' => 'product/id/prod/id',  // ''
        'sku' => 'product/sku/prod/sku',
        'name' => 'product/name/prod/name',
        'available' => 'product/available/prod/available',
        'url' => 'product/url/prod/url',
        'price' => 'product/price/prod/price',
        'currency' => 'product/currency/prod/currency',
        'vat' => 'product/vat/prod/vat',
        'images' => 'product/images/prod/images',
        'category_id' => 'product/category_id/prod/category_id',
        'description' => 'product/description/prod/description',
        'meta_title' =>'product//meta_title/value/{name} оптом', // продумать, как мы будем обрабатывать такие строки
        'meta_keywords' =>'product//meta_keywords/value/{name} оптом',
        'meta_description' =>'product//meta_description/value/{name} оптом',
        'contact_id' => 'product//contact_id/value/1',
        'create_datetime' => 'product//create_datetime/func/{dateTime}',
        'image_id' => 'product//image_id/func/{firstImage}',
        'video_url' => 'product//video_url/value/NULL',
        'weight' => 'product/weight/prod/weightSup/feature',
        'vendor' => 'product/vendor/prod/vendorSup/feature',
        'myseizes' => 'product/seize/prod/myseizes/feature',
        'seizes' => 'product/sizes/prod/sizes/feature',
    ),
    'cat_both_pattern' => array (
        'id' => 'category/id/prod/id',
        'name' => 'category/name/prod/name',
        'parent_id' => 'category/parent_id/prod/parent_id',
    ),
    'multiplicity' => array(        // показывает одиночный или множественный элемент
        'product/id/prod/id' => 'single',
        'product/sku/prod/sku' => 'single',
        'product/name/prod/name' => 'single',
        'product/available/prod/available' => 'single',
        'product/url/prod/url' => 'single',
        'product/price/prod/price' => 'single',
        'product/currency/prod/currency' => 'single',
        'product/vat/prod/vat' => 'single',
        'product/images/prod/images' => 'multi',
        'product/category_id/prod/category_id' => 'multi',
        'product/description/prod/description' => 'single',
        'product/weight/prod/weightSup/feature' => 'single', //здесь будет вида: 'product/weight/color|3/feature'
        'product/vendor/prod/vendorSup/feature' => 'single',
        'product/seize/prod/myseizes/feature' => 'multi',
        'product/sizes/prod/sizes/feature' => 'multi',
        'category/id/cat/id' => 'single',
        'category/name/cat/name' => 'single',
        'category/parent_id/cat/parent_id' => 'single',

    ),
    'key_pattern' => array (    // берем из Settings - поля для отслеживания изменений (их нежелательно впоследствии менять)
        'product/id/prod/id' => 1,
        'product/name/prod/name' => 2,
        'product/price/prod/price' => 3,
        'product/currency/prod/currency' => 4,
        'category/id/cat/id' => 1,
        'category/name/cat/name' => 2,
        'category/parent_id/cat/parent_id' => 3,
    ),
);