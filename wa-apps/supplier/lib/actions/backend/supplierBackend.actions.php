<?php

class supplierBackendActions extends waViewActions
{
    public function defaultAction()
    {

        // создаем экземпляр модели для получения данных из БД
        $model = new supplierSettingsModel();
        // получаем записи гостевой книги из БД
        //$records = $model->order('datetime DESC')->fetchAll();
        // передаем записи в шаблон
        //$this->view->assign('records', $records);
        // передаём URL фронтенда в шаблон
        //$this->view->assign('url', wa()->getRouting()->getUrl('guestbook'));
        /*
        * передаём в шаблон права пользователя на удаление записей из гостевой книги
        * права описаны в файле lib/config/guestbookRightConfig.class.php
        */
        //$this->view->assign('rights_delete', $this->getRights('delete'));

        $profile_id    = waRequest::request('profile', 0, waRequest::TYPE_INT);

//        wa('shop');
//        $config      = new shopImportexportHelper('supplier.yml');
//        $profiles      =  $config->getConfig();

        //$profiles      =  $model->getList();
        $profiles = $model->order('name ASC')->fetchAll();

        $array = array();

        //echo $profile_id; die;
        $settings = $this->getProfileConfig($profile_id);

        if(count($profiles)) {
            foreach ($profiles as $k=>$v) {
                $array[$profiles[$k]['id']] = $profiles[$k];
            }
        }

        $settings      = $this->getProfileConfig($profile_id);

  //      $model = new waAppSettingsModel();

//        echo "<pre>";
//        print_r($settings); die;

        $root_path     =  wa()->getConfig()->getPath('root');

//        echo "<pre>";
//        print_r($profiles); die;

        $version= 1;
        $this->view->assign('version', $version);
        $this->view->assign( 'profile_id'    , $profile_id    );
        $this->view->assign( 'profiles'      , $array      );
        $this->view->assign( 'root_path'     , $root_path     );
        $this->view->assign( 'settings'     , $settings     );
    }

    public function getProfileConfig ($profile_id) {

        $row = array();
        if($profile_id) {
            $model = new supplierSettingsModel();
            $row = $model->getById($profile_id);
        }

        return $row;
    }

    public function deleteAction()
    {
        //реализация экшена удаления записи
    }


//    public function saveAction() {
//
//        $profile_id = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
//        $settings   = waRequest::post('settings', array() , waRequest::TYPE_ARRAY);
//
//        if ( empty($profile_id) ){
//
//            $model      = new waAppSettingsModel();
//
//            $token      = array('supplier', 'yml');
//            foreach ( $settings as $key => $value ) {
//                $model->set($token, $key , $value );
//            }
//        } else {
//            $profiler  = new shopImportexportHelper('yml');
//            $profiler->setConfig($settings,$profile_id);
//
//            if ( !empty($settings['name']) ){
//                $importexport_model = new shopImportexportModel();
//                $data = array( 'name' => $settings['name'] );
//
//                $search_by = array(
//                    'id'     => $profile_id,
//                    'plugin' => 'yml',
//                );
//
//                $importexport_model->updateByField($search_by, $data );
//            }
//        }
//
////        echo "<pre>";
////        print_r($_REQUEST); die;
//    }
}
