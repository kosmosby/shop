<?php
class supplierUploadSaveController extends waController {

    protected function execute() {

        $file = waRequest::file('yml_file');

        //$path = wa()->getAppPath('files', 'supplier');
        $path = wa('supplier')->getAppPath().'/files';
        //echo $path; die;

        //echo $file->uploaded(); die;

        $file->moveTo($path,$file->name);


        $profile_id = waRequest::request('profile_id', 0, waRequest::TYPE_INT);

        $this->updateProfile($profile_id, $file->name);

        //echo $profile_id; die;
        /*
        $settings = shopYmlHelper::getProfileConfig($profile_id);
        */

        //$path = wa('supplier')->getAppPath().'/files';
//        echo "<pre>";
//        print_r($path); die;

        /*
        $path = wa()->getDataPath('plugins/yml/' . $profile_id . '/' . $settings['source_type'] . '/', true, 'shop', true) . $profile_id . '.local.yml';
        $path = shopYmlHelper::ymlPath($profile_id, $settings);

        waFiles::delete($path);

        $file->moveTo($path);

        $settings['local.file'] = $file->name;
        $settings['local.file.size'] = waFiles::formatSize($file->size);

        shopYmlHelper::saveProfileConfig($profile_id, $settings);
        */

        return array(
            'name' => $file->name,
            'size' => waFiles::formatSize($file->size),
        );
    }

    public function updateProfile ($profile_id, $name) {
        if($profile_id) {
            $model = new supplierSettingsModel();
            $data['local.file'] = $name;
            $data['source_type'] = 'local';
            $model->updateById($profile_id, $data);
        }
    }

}
