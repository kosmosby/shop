<?php
class shopXmlPluginSnapshotSaveController extends waJsonController {
    public function execute(){
        $reset      = waRequest::post('reset', 0, waRequest::TYPE_INT);
        $profile_id = waRequest::post('profile_id' , 0, waRequest::TYPE_INT);
        $map        = waRequest::post('map', array(), waRequest::TYPE_ARRAY);

        $settings   = shopXmlHelper::getProfileConfig($profile_id);

        //$map_path       = wa()->getDataPath('plugins/xml/' . $profile_id, true, 'shop') . '/' . $profile_id . '.' . $settings['source_type'] . '.map.php';
        $map_path   = shopXmlHelper::mapPath($profile_id, $settings['source_type']);

        if ( $reset ){
            waFiles::delete($map_path, true);
        } elseif( waRequest::post('preserve') ){
            $_map = include ($map_path);

            if ( !empty($_map) ){
                $map = $_map + $map;
                unset($_map);
            }
        }

        waUtils::varExportToFile($map, $map_path);
    }

    public function process(&$map){
        if ( $map ){
            foreach ( $map as &$v ){
                if ( !empty($v['attrs']) ) {
                    $this->process($v['attrs']);
                }

                if ( !empty($v['type']) ){
                    $v['up'] = 1;
                    if (strpos($v['type'], '|1') !== false){
                        $v['up']   = 0;
                        $v['type'] = str_replace('|1', '', $v['type']);
                    }
                }
            }
        }
    }
}