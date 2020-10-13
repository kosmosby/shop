<?php
return array(
    'prod_both_pattern' => array (
        'id' => 'product/id/prod/id',
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
);