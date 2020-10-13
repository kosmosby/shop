<?php
class shopXmlPluginProductNamesController extends waJsonController {
    public function execute(){
        $profile_id = waRequest::get('profile_id', 0, waRequest::TYPE_INT);

        $settings   = shopXmlHelper::getProfileConfig($profile_id);

        $map_path   = shopXmlHelper::mapPath($profile_id, $settings['source_type']);

        $html = '';
        if ( file_exists($map_path) ){
            $map = include($map_path);
            if ( $map_path ){

                $i = 0;
                foreach ( $map as $key => $info ){

                    if ( is_array($info) && !empty($info['type']) ){
                        $type = $info['type'];

                        $type = explode('#', $type);

                        foreach ( $type as $t ){
                            if ( $t === 'product:name' ){
                                $path_items = $_node_parts = explode("\\", $key);

                                $last       = end($path_items);
                                $last       = explode(':', $last);

                                $html .= '<div class="xml-pname-item">
                                            <span class="sort">
                                                <i class="icon16 sort"></i>
                                            </span>
                    
                                            <span class="xml-pname-tag" data-full-path="' . $key . '">
                                                ' . $last[1] . '
                                                <input type="hidden" name="pnames[]" value="' . $key . '">
                                            </span>
                                        </div>';
                            }
                        }
                    }

                    ++$i;
                }
            }
        }

        $this->response['html'] = $html;
    }
}