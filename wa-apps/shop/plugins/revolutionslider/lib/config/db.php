<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
return array(
    'shop_revolutionslider' => array(
        'slider_id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'group_id' => array('int', 11, 'null' => 0),
        'demo_slider' => array('int', 1, 'null' => 0),
        'properties' => array('mediumtext', 'null' => 0),
        'layers' => array('longtext', 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'slider_id',
            'slider_id' => 'slider_id',
        ),
    ),

    'shop_revolutionslider_groups' => array(
        'group_id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'group_title' => array('varchar', 255, 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'group_id',
            'group_id' => 'group_id',
        ),
    ),
);