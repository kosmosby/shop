<?php
class supplierProfileDeleteController extends waJsonController {
    public function execute(){
        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);

        if ( $profile_id ){
            $profiler = new supplierSettingsModel();
            $profiler->deleteById($profile_id);

//            foreach ( array(true,false) as $bool ){
//                $path = wa()->getDataPath('plugins/yml/' . $profile_id . '/', $bool, 'shop', false);
//                if ( file_exists($path) ){
//                    waFiles::delete($path, true);
//                }
//            }


        }
    }
}
