<?php
class shopXmlPluginMatchingLocalTreeController extends waJsonController {
    public function execute(){
        $local_id    = waRequest::post("local_id", null, waRequest::TYPE_INT);
        $depth       = waRequest::post('depth', 0, waRequest::TYPE_INT);
        $foreign_cat = waRequest::post("foreign_category", array(), waRequest::TYPE_ARRAY);
        $profile_id  = waRequest::post('profile_id', 0, waRequest::TYPE_INT);
        
        $selected_id = 0;
        $view        = wa()->getView();
        $map = array();
        
        $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', false, 'shop' ) . '/categ_map.php';
            
        if ( file_exists($path) ){
            $map = include($path);
        }

        if ( !empty($foreign_cat) ){
            if ( !empty($map) && isset($map[$foreign_cat['id']]) ){
                $selected_id = $map[$foreign_cat['id']]['id'];
                $foreign_cat['mode'] = $map[$foreign_cat['id']]['mode'];
            }

            if ( !waRequest::post('no_foreign', 0, waRequest::TYPE_INT) ){
                $view->assign('foreign_cat', $foreign_cat);
            }
        }

        $view->assign('selected_id', $selected_id);
        $path  = wa()->getAppPath('plugins/xml/templates/actions/matching/', 'shop') . 'LocalTree.html';
        $model = new shopCategoryModel();
        $list  = $model->getTree($local_id, $depth);
        
        if ( $local_id && isset($list[$local_id]) ){
            unset($list[$local_id]);
        }

        foreach ( $list as &$l ){
            $l['children_count'] = (int) $model->query('SELECT COUNT(*) AS k FROM `shop_category` WHERE `parent_id` = i:pid', array('pid' => $l['id']))->fetchField('k');
        }
        unset($l);

        $view->assign('categories', $list);        
        $this->response['html'] = $view->fetch($path);        
    }
}