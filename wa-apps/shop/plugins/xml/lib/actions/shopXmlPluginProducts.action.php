<?php
class shopXmlPluginProductsAction extends shopProductsAction {

    public function execute(){
        parent::execute();
        $tmpl = wa()->getAppPath('templates/actions/products/', 'shop') . 'Products.html';

        $this->setTemplate($tmpl);
    }

    protected function getHash(){
        $res = null;
        $category_id = waRequest::get('profile_id', null, waRequest::TYPE_INT);
        if (!is_null($category_id)) {
            $this->collection_param = 'xml_profile_id='.$category_id;
            $res = array('xml_profile_id', $category_id);
        }

        return $res;
    }

    protected function getCollection($hash) {
        $c      = parent::getCollection($hash);
        $xml_id = waRequest::get('profile_id');

        $c->addWhere('xml_profile_id = ' . $xml_id );
        return $c;
    }
}