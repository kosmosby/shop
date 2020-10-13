<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendClonesliderController extends waJsonController {

    public function execute() {
        try {

            $slider_id = waRequest::post('slider_id');

            if(is_null($slider_id)) {
                $this->setError("Error: Empty slider_id");
                return;
            }

            $group_id = waRequest::post('group_id');
            if(is_null($group_id)) {
                $group_id = 0;
            }

            $slider_model = new shopRevolutionsliderPluginModel();

            $new_id = $slider_model->cloneById($slider_id, $group_id);


            $this->response['slider_id'] = $new_id;
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
