<?php
class shopXmlPluginSetConfigController extends waJsonController{
    public function execute(){

        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        $name  = waRequest::post('config_key', null, waRequest::TYPE_STRING_TRIM);
        $value = waRequest::post('config_value', null, waRequest::TYPE_STRING_TRIM);

        $settings = shopXmlHelper::getProfileConfig($profile_id);
        $settings[$name] = $value;
        shopXmlHelper::saveProfileConfig($profile_id, $settings);
    }
}