<?php

class shopListfeaturesPluginSettingsSetOptionsCopyController extends waController
{
    public function execute()
    {
        try {
            $target_settlement_hashes = waRequest::post('settlements', array(), waRequest::TYPE_ARRAY_TRIM);

            if (!$target_settlement_hashes) {
                throw new Exception(_wp('Select settlements.'));
            }

            $target_sets = waRequest::post('sets', array(), waRequest::TYPE_ARRAY_INT);

            if (!$target_sets) {
                throw new Exception(_wp('Select sets.'));
            }

            $source_settlement_hash = waRequest::post('settlement_hash', '', waRequest::TYPE_STRING_TRIM);
            $source_set_id = waRequest::post('set', 0, waRequest::TYPE_INT);

            if (array_values($target_settlement_hashes) == array($source_settlement_hash)
                && array_values($target_sets) == array($source_set_id)
            ) {
                throw new Exception(_wp('You have selected to copy the settings of a set to itself. Select other sets or settlements to copy settings to.'));
            }

            $configs = shopListfeaturesPluginHelper::getAllSettlementsConfig();

            if (!isset($configs[$source_settlement_hash][$source_set_id])) {
                $settlement_name = waRequest::post('settlement_name', '', waRequest::TYPE_STRING_TRIM);
                throw new Exception(sprintf(_wp('Source settlement %s or set %u do not exist. Reload this page and try again.'), $settlement_name, $source_set_id));
            }

            $source_set_config = $configs[$source_settlement_hash][$source_set_id];
            $settlement_hashes = shopListfeaturesPluginHelper::getHashSettlements('hash');

            $first_config = reset($configs);
            $sets_count = count($first_config);

            $settings = array();
            foreach ($settlement_hashes as $hash) {
                if (!in_array($hash, $target_settlement_hashes)) {
                    continue;
                }

                if (!isset($configs[$hash])) {
                    $configs[$hash] = array_fill(1, $sets_count, array(
                        'features' => array(),
                    ));
                }

                $setting = array();

                foreach ($configs[$hash] as $set => $set_options) {
                    if (in_array($set, $target_sets)) {
                        $setting[$set] = $source_set_config;
                    } else {
                        $setting[$set] = $set_options;
                    }
                }

                $settings[$hash] = json_encode($setting);
            }

            wa('shop')->getPlugin('listfeatures')->saveSettings($settings);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
