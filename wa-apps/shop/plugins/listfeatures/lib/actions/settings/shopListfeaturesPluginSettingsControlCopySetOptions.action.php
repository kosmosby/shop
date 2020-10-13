<?php

class shopListfeaturesPluginSettingsControlCopySetOptionsAction extends waViewAction
{
    public function execute()
    {
        $this->view->assign('set_id', $this->params['set_id']);
    }
}
