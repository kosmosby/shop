<?php
class supplierProfileAddController extends waJsonController {
    public function execute(){

        $profiles = new supplierSettingsModel();

        //$name  = wa('shop')->getConfig()->getGeneralSettings('name');

//        echo "<pre>";
//        print_r($_REQUEST); die;


        $profile_id = waRequest::request('profile_id');
        $settings = waRequest::request('settings');

        //echo $name; die;

        $name = $settings['name'];

        if($profile_id) {
            $inserted_id = $profiles->updateById($profile_id,array(
                'name' => $name
            ));
        }
        else {
            $inserted_id = $profiles->insert(array(
                'name' => $name
            ));
        }

        $this->response['profile_id']= $inserted_id;
        $this->response['name']       = $name;

    }
}
