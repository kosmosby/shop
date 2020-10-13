<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendSliderpreviewController extends waJsonController {

    public function execute() {
        try {
            $slider_id = waRequest::post('slider_id');

            if(is_null($slider_id)) {
                $this->setError("Error: Empty slider_id");
                return;
            }

            $slide_num = waRequest::post('slide_num');

            if(!is_null($slide_num)) {
                $html = shopRevolutionsliderPlugin::display($slider_id, $slide_num);
            } else {
                $html = shopRevolutionsliderPlugin::display($slider_id);
            }


            $this->response['html'] = $html;

        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
