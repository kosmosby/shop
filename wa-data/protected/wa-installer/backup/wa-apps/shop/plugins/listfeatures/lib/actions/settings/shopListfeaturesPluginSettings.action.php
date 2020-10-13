<?php

class shopListfeaturesPluginSettingsAction extends waViewAction
{
    public function execute()
    {
        wa()->getResponse()->addJs(wa()->getConfig()->getBackendUrl(true).'shop/?plugin=listfeatures&action=loc');

        $hash_settlements = shopListfeaturesPluginHelper::getHashSettlements('name');

        $this->view->assign('settlements', $hash_settlements);
        $this->view->assign('version', wa()->getPlugin('listfeatures')->getVersion());
    }
}
