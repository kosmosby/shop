<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendDeletegroupController extends waJsonController {

    public function execute() {
        try {

            $group_id = waRequest::post('group_id');

            if(is_null($group_id) || $group_id == 0) {
                $this->setError("Error: Empty group_id");
                return;
            }

            $slider_model = new shopRevolutionsliderPluginModel();

            $slider_model->deleteGroup($group_id);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
