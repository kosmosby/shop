<?php
class shopXmlPluginBackendSetupAction extends waViewAction {
    public function execute(){
        $profile_id    = waRequest::request('profile', 0, waRequest::TYPE_INT);
        $profiler      = new shopImportexportHelper('xml');
        $settings      = shopXmlHelper::getProfileConfig($profile_id);
        $default_title = wa('shop')->getPlugin('xml')->getSettings('name');

        $type          =  new shopTypeModel();
        $types         =  $type->getAll();
        $profiles      =  $profiler->getList();
        $root_path     =  wa()->getConfig()->getPath('root');

        $version = wa()->getPlugin('xml')->getVersion();
        $this->view->assign('version', $version);

        $category_model = new shopCategoryModel();
        $categories     = $category_model->getFullTree( 'id, name, depth' , true );

        $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', true, 'shop') . 'markup.php';
        if ( file_exists($path) ){
            $markup = include($path);
            $this->view->assign('markup', $markup);
        }

        $sql      = "SELECT `code`,`name`, `multiple` FROM `shop_feature` WHERE `type` = 'varchar'";
        $features = $type->query($sql)->fetchAll();

        $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', false, 'shop', true) . 'session.php';
        if ( file_exists($path) ){
            $session = include($path);
            $this->view->assign('session', $session);
        }

        $name_path = wa('shop')->getDataPath('plugins/xml/' . $profile_id . '/' . $settings['source_type'] . '/', false, 'shop', true) . 'pnames.php';

        $names = array();
        if ( file_exists($name_path) ){
            $_names = include($name_path);

            if ( $_names ){
                foreach ( $_names as $n ){
                    $elems = explode("\\", $n);
                    $last = end($elems);
                    $last = explode(":", $last);

                    $names[] = array('key' => $n, 'name' => $last[1]);
                }
            }
        }

        $csrf = waRequest::cookie('_csrf');
        $this->view->assign('csrf', $csrf);

        $this->view->assign( 'product_name_tags', $names      );
        $this->view->assign( 'features'      , $features      );
        $this->view->assign( 'categories'    , $categories    );
        $this->view->assign( 'default_title' , $default_title );
        $this->view->assign( 'profiles'      , $profiles      );
        $this->view->assign( 'profile_id'    , $profile_id    );
        $this->view->assign( 'root_path'     , $root_path     );
        $this->view->assign( 'types'         , $types         );
        $this->view->assign( 'settings'      , $settings      );
    }
}