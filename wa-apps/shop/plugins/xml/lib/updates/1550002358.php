<?php
$model = new waModel();
try {
    $model->query("SELECT `xml_up` FROM `shop_product_skus` WHERE 0");
} catch(waDbException $e) {
    $model->exec("ALTER TABLE `shop_product_skus` ADD `xml_up` INT NULL DEFAULT 0");
}