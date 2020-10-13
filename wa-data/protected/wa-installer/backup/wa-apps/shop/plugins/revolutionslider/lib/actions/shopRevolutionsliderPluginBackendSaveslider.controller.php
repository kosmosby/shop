<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendSavesliderController extends waJsonController {

    public function execute() {
        try {
            $slider_data = json_decode(waRequest::post('slider_data'), true);

            $slider_model = new shopRevolutionsliderPluginModel();

            $slider_id = waRequest::post('slider_id');

            $slider_model->saveById($slider_id, $slider_data);


            $this->response['message'] = "Сохранено";
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
