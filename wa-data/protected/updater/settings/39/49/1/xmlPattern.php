<?php
return array(
    '/yml_catalog/shop/offers/offer'=> array (
        'dbArrKeyPath' =>'NONE',  // "NONE" - значит не забираем содержимое тега
        'pathAttrRead' => 'YES',  // забираем аттрибуты. Если аттрибуты не берем, то этот элемент массива не вставляем
        'id'=>'product/id/prod/id',    // 'attributeName' => 'serverTableName/serverColumnName/clientTableName/clientColumnName'
        'available' => 'product/available/prod/available',
    ),
    '/yml_catalog/shop/offers/offer/vendorCode' => array (
        'dbArrKeyPath' => 'product/sku/prod/sku',
    ),
    '/yml_catalog/shop/offers/offer/myseizes' => array (
        'dbArrKeyPath' => 'KEY',                     //KEY для массива базы данных
        'KEY'  => 'product/seize/prod/myseizes/feature', // если характеристика, то идет последним 5-м элементом 'feature'
    ),
    '/yml_catalog/shop/offers/offer/myseizes/value' => array (
        'dbArrKeyPath' => 'VALUE',                     //VALUE для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/sizes' => array (
        'dbArrKeyPath' => 'KEY',                     //KEY для массива базы данных - мульти features
        'KEY'  => 'product/sizes/prod/sizes/feature',
    ),
    '/yml_catalog/shop/offers/offer/sizes/size' => array (
        'dbArrKeyPath' => 'VALUE',                     //VALUE для массива базы данных - мульти features
    ),
    '/yml_catalog/shop/offers/offer/url' => array (
        'dbArrKeyPath' => 'product/url/prod/url',                     //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/price'=> array (
        'dbArrKeyPath' => 'product/price/prod/price',                    //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/currencyId' => array (
        'dbArrKeyPath' => 'product/currency/prod/currency',                     //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/vat'=> array (
        'dbArrKeyPath' => 'product/vat/prod/vat',
    ),
    '/yml_catalog/shop/offers/offer/categoryId'=> array (
        'dbArrKeyPath' => 'product/category_id/prod/category_id',
    ),
    '/yml_catalog/shop/offers/offer/picture' => array (
        'dbArrKeyPath' => 'product/images/prod/images',                     //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/name' => array (
        'dbArrKeyPath' => 'product/name/prod/name',                     //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/description' => array (
        'dbArrKeyPath' => 'product/description/prod/description',                     //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/vendor' => array (
        'dbArrKeyPath' => 'product/vendor/prod/vendorSup/feature',                     //ключ для массива базы данных
    ),
    '/yml_catalog/shop/offers/offer/weight' => array (
        'dbArrKeyPath' => 'product/weight/prod/weightSup/feature',                     //стандартный feature
    ),
    '/yml_catalog/shop/categories/category'=> array (
        'dbArrKeyPath' => 'category/name/cat/name', //!!!ВОТ ЭТУ ХРЕНЬ ВСТАВЛЯЕМ ДЛЯ ФОРМИРОВАНИЯ КАТАЛОГА!!!
        'pathAttrRead' => 'YES',
        'id'=>'category/id/cat/id',
        'parentId' => 'category/parent_id/cat/parent_id',
    ),
);