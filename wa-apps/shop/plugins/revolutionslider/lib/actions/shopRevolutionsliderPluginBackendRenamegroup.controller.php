<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendRenamegroupController extends waJsonController {

    public function execute() {
        try {

            $group_id = waRequest::post('group_id');

            if(is_null($group_id) || $group_id == 0) {
                $this->setError("Error: Empty group_id");
                return;
            }

            $name = waRequest::post('newgroupname');
            if(is_null($name)) {
                $name = _wp("New Group");;
            }

            $slider_model = new shopRevolutionsliderPluginModel();

            $new_name = $slider_model->renameGroup($group_id, $name);
            
            $this->response['new_name'] = $new_name;
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
