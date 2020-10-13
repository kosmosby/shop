<?php
class shopXmlPluginProfileAddController extends waJsonController {
    public function execute(){
        $profiles = new shopImportexportHelper('xml');
        
        $config   = array(
            'price_up'                => 0,
            'category'                => 3,
            'images'                  => 3,
            'import_categories'       => 1,
            'automatization'          => 1,
            'searchbyname'            => 0,
            'bind_to_profile'         => 0,
            'source_type'             => 'remote',
            'allow_categ_map'         => 0,
            'link_separator'          => 0,
            'product_names'           => 1,
            'duplicate_as_child'      => 0,
            'no_update_products'      => 0,
            'no_new_products'         => 0,
            'no_new_categs'           => 0,
            'no_update_categs'        => 0
        );
        
        $name                         = wa('shop')->getConfig()->getGeneralSettings('name');
        
        $this->response['profile_id'] = $profiles->addConfig($name, null, $config);
        $this->response['name']       = $name;
    }
}