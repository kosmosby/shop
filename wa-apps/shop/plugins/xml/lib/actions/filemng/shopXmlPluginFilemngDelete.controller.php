<?php
class shopXmlPluginFilemngDeleteController extends waJsonController {
    public function execute(){
        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        $type       = waRequest::post('type');

        if ( !$type ){
            die;
        }

        $settings = shopXmlHelper::getProfileConfig($profile_id);

        $changed = false;
        if ( $type === 'server' ){
            $settings['server.file'] = null;
            $changed = true;
        } elseif ( $type === 'local' ){
            $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', true, 'shop', true) . $profile_id . '.local.xml';
            waFiles::delete($path);
            $settings['local.file'] = null;
            $settings['local.file.size'] = null;
            $changed = true;
        }

        if ( $changed ){
            shopXmlHelper::saveProfileConfig($profile_id, $settings);
        }
    }
}