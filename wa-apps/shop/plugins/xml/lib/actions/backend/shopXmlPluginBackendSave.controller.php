<?php
class shopXmlPluginBackendSaveController extends waJsonController{
    public function execute(){
        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        
        $settings   = waRequest::post('settings', array() , waRequest::TYPE_ARRAY);
        $checkboxes = array(
            'no_update_products',
            'no_new_products',
            'no_new_categs',
            'no_update_categs',
            'searchbyname',
            'searchbysku',
            'reset_stock',
            'duplicate_as_child',
            'import_categories',
            'automatization',
            'bind_to_profile',
            'automatization',
            'http_auth'
        );
        
        foreach ( $checkboxes as $field ){
            $settings[$field] = ifempty($settings[$field], 0);
        }
        
        if ( empty($profile_id) ){
            $model      = new waAppSettingsModel();
            $token      = array('shop', 'xml');
            foreach ( $settings as $key => $value ) {
                $model->set($token, $key , $value );
            }
        } else {
            $_settings = shopXmlHelper::getProfileConfig($profile_id);
            if ( !$_settings){
                $_settings = array();
            }

            if ( $settings ){
                foreach ($settings as $k => $v){
                    $_settings[$k] = $v;
                }
            }

            if ( $_settings ){
                $profiler  = new shopImportexportHelper('xml');
                $profiler->setConfig($_settings,$profile_id);
            }
            
            if ( !empty($settings['name']) ){
                $importexport_model = new shopImportexportModel();
                $data = array( 'name' => $settings['name'] );
                
                $search_by = array(
                    'id'     => $profile_id,
                    'plugin' => 'xml',
                );
                
                $importexport_model->updateByField($search_by, $data );
            }
        }

        if ( ($settings['markup_type'] == '2') && ($markup = waRequest::post('stepped_markup', array(),waRequest::TYPE_ARRAY)) ){
            $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', true, 'shop') . '/markup.php';

            $m = array(
                'steps'   => $markup,
                'default' => waRequest::post('stepped_default', array(), waRequest::TYPE_ARRAY)
            );

            waUtils::varExportToFile($m,$path);
        }

        $pnames = waRequest::post('pnames', array(), waRequest::TYPE_ARRAY_TRIM);
        $name_path = wa('shop')->getDataPath('plugins/xml/' . $profile_id . '/' . $settings['source_type'] . '/', false, 'shop', true) . 'pnames.php';
        waUtils::varExportToFile($pnames, $name_path);
    }
}