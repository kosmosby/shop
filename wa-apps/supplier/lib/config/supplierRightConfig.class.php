<?php

class supplierRightConfig extends waRightConfig
{
    public function init()
    {
        // объявляем элементы настройки прав доступа
        $this->addItem('delete', 'Can delete posts', 'checkbox');
    }
}