<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendDeletesliderController extends waJsonController {

    public function execute() {
        try {
            $slider_id = waRequest::post('slider_id');

            $slider_model = new shopRevolutionsliderPluginModel();
            $slider_model->deleteSlider($slider_id);

        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
