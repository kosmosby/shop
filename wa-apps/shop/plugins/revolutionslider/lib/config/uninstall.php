<?php
$model = new waModel();
try {
    $sql = "DROP TABLE IF EXISTS `shop_revolutionslider`";

    $model->query($sql);
} catch (waDbException $e) {

}