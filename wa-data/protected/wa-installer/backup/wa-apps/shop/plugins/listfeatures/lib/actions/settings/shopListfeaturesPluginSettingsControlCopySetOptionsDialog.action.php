<?php

class shopListfeaturesPluginSettingsControlCopySetOptionsDialogAction extends waViewAction
{
    public function execute()
    {
        $set_id = waRequest::get('set_id', 0, waRequest::TYPE_INT);
        $settlement_hash = waRequest::get('settlement_hash', '', waRequest::TYPE_STRING_TRIM);
        $settlement_name = waRequest::get('settlement_name', '', waRequest::TYPE_STRING_TRIM);

        $settlement_config = shopListfeaturesPluginHelper::getSettlementConfig($settlement_hash);
        $empty_set_config = empty($settlement_config[$set_id]['features']);

        $sets = array_keys(array_fill(1, count($settlement_config), null));
        $sets_control = waHtmlControl::getControl(waHtmlControl::GROUPBOX, 'sets', array(
            'options' => array_combine($sets, $sets),
            'class' => 'set-options-copy-dialog-set',
            'value' => array(),
        ));

        $settlements = shopListfeaturesPluginHelper::getHashSettlements();
        $apps = array(
            '0' => array(
                'title' => _wp('All apps'),
                'icon_class' => 'icon16 apps',
            )
        );

        foreach ($settlements as $hash => &$settlement) {
            $app = $settlement['app_id'];

            if (!isset($apps[$app])) {
                wa($app);
                $app_info = wa()->getAppInfo($app);
                $apps[$app] = array(
                    'title' => _w($app_info['name']),
                    'icon_url' => ifset($app_info['icon'][16], reset($app_info['icon'])),
                );
            }

            $settlement = array(
                'name' => $hash,
                'value' => $settlement['url'],
                'title' => $settlement['name'],
                'app_id' => $settlement['app_id'],
                'description' => mb_strtolower($apps[$app]['title']),
            );
        }
        unset($settlement);

        $this->view->assign('set_id', $set_id);
        $this->view->assign('settlement_name', $settlement_name);
        $this->view->assign('settlement_hash', $settlement_hash);
        $this->view->assign('empty_set_config', $empty_set_config);

        $this->view->assign('apps', $apps);
        $this->view->assign('sets', $sets_control);
        $this->view->assign('settlements', $settlements);
    }
}
