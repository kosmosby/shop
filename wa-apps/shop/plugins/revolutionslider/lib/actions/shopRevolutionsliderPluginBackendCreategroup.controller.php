<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendCreategroupController extends waJsonController {

    public function execute() {
        try {
            $group_title = waRequest::post('group_title');

            if(is_null($group_title)) {
                $group_title = _wp("New Group");
            }

            $slider_model = new shopRevolutionsliderPluginModel();
            $group_id = $slider_model->createGroup($group_title);

            $this->response['group_id'] = $group_id;
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
