<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendCreatesliderController extends waJsonController {

    public function execute() {
        try {
            $group_id = waRequest::post('group_id');
            if(is_null($group_id)) {
                $group_id = 0;
            }

            $slider_model = new shopRevolutionsliderPluginModel();
            $slider_id = $slider_model->createSlider($group_id);

            $this->response['slider_id'] = $slider_id;
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
