<?php
class shopXmlPluginSessionUnsetController extends waJsonController {
    public function execute(){
        $profile_id = waRequest::post('profile_id', null, waRequest::TYPE_INT);
        
        if ( !is_null($profile_id) && ($profile_id >= 0) ) {
            $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', false, 'shop', true) . 'session.php';
            if ( file_exists($path) ){
                waFiles::delete($path);
            }
        }
    }
}