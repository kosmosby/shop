<?php
$model = new waModel();

foreach ( array( 'shop_product', 'shop_category' ) as $table ) {
    try {
        $model->exec("ALTER TABLE `{$table}` DROP COLUMN `xml_id`");
    } catch(waDbException $e) {
        //
    }
}

foreach ( array(true,false) as $t ){
    try {
        $path = wa()->getDataPath('plugins/xml', $t, 'shop', false);
        if ( file_exists($path) ) {
            waFiles::delete($path);
        }
    } catch(waException $e){

    }
}