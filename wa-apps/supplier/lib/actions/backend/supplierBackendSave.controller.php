<?php
class supplierBackendSaveController extends waJsonController {

    public function execute()
    {
        //$profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        $settings = waRequest::post('settings', array(), waRequest::TYPE_ARRAY);

        $model = new supplierSettingsModel();

//        echo "<pre>";
//        print_r($_REQUEST);die;

        if (empty($profile_id)) {

            $name = $settings['name'];
            $result = $model->insert(array(
                'name' => $name
            ));

//            $model = new waAppSettingsModel();
//
//            $token = array('supplier', 'yml');
//            foreach ($settings as $key => $value) {
//                $model->set($token, $key, $value);
//            }
        } else {
            $profiler = new shopImportexportHelper('supplier');
            $profiler->setConfig($settings, $profile_id);

            if (!empty($settings['name'])) {
                $importexport_model = new shopImportexportModel();
                $data = array('name' => $settings['name']);

                $search_by = array(
                    'id' => $profile_id,
                    'plugin' => 'yml',
                );

                $importexport_model->updateByField($search_by, $data);
            }
        }
    }
}
