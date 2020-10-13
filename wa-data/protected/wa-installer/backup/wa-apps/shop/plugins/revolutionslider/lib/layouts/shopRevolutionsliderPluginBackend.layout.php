<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendLayout extends shopBackendLayout {

    public function __construct() {
        parent::__construct();

        $slider_id = waRequest::get('slider');

        $slider_model = new shopRevolutionsliderPluginModel();

        $show_slider = false;
        if(!is_null($slider_id)) {
            $show_slider = true;
            $sliders = $slider_model->getById($slider_id);
        } else {
            $sliders = $slider_model->getAll();

            $slides_demo = $slider_model->getDemo();
            $this->view->assign('slides_demo', $slides_demo);
        }

        $groups = $slider_model->getAllGroups();
        $this->view->assign('groups', $groups);

        $this->view->assign('slides', $sliders);

        $this->view->assign('show_slider', $show_slider);
    }

    public function execute() {
        parent::execute();
    }
}
