<?php
return array(
    'supplier_settings' => array(
        'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'name' => array('varchar', 255, 'null' => 0),
        'value' => array('text', 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'id'
        ),
    ),
);
