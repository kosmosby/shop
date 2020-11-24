<?php
class supplierFilemngSaveController extends waJsonController {
    public function execute() {

        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        $path  = waRequest::post("file", '', waRequest::TYPE_STRING_TRIM);

        //echo $profile_id; die;

        if ( !$profile_id ){
            $model      = new waAppSettingsModel();
            $token      = array('shop', 'yml');
            $model->set($token, 'server.file', $path);
        } else {
            //$settings = supplierHelper::getProfileConfig($profile_id);

            $settings['local.file'] = $path;

            $model  = new supplierSettingsModel();
            $model->updateById($profile_id, $settings);
            //$profiler->setConfig($settings,$profile_id);
        }
    }
}
