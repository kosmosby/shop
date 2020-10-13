<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendAction extends waViewAction {

    public function execute() {
        $this->setLayout(new shopRevolutionsliderPluginBackendLayout());

        parent::execute();
    }

}
