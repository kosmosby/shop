<?php

class shopProductsAddToCategoriesController extends waJsonController
{
    /**
     * @var shopCategoryModel
     */
    private $category_model;
    /**
     * @var shopCategoryProductsModel
     */
    private $category_products_model;

    public function __construct()
    {
        $this->category_model = new shopCategoryModel();
        $this->category_products_model = new shopCategoryProductsModel();
    }

    public function execute()
    {
        if (!$this->getUser()->getRights('shop', 'setscategories')) {
            throw new waRightsException(_w('Access denied'));
        }

        $category_ids = waRequest::post('category_id', array(), waRequest::TYPE_ARRAY_INT);
        $all_product_ids = null;

        // create new category
        $new_category_id = null;
        if (waRequest::post('new_category')) {
            $new_category_id = $this->createCategory(
                waRequest::post('new_category_name')
            );
            $category_ids[] = $new_category_id;
        }

        if (!$category_ids) {
            return;
        }

        // add products to categories
        $hash = $this->getHash();
        if (!$hash) {
            $all_product_ids = waRequest::post('product_id', array(), waRequest::TYPE_ARRAY_INT);
            $hash = 'id/'.join(',', $all_product_ids);
        }
        
        /**
         * Adds a product to the category. Get data before changes
         *
         * @param int $new_category_id
         * @param array $category_ids with $new_category_id
         * @param string $hash
         * @param array|string products_id
         *
         * @event products_set_categories.before
         */
        $params = array(
            'new_category_id' => $new_category_id,
            'category_ids'    => $category_ids,
            'hash'            => $hash,
            'products_id'     => $all_product_ids,
        );
        wa('shop')->event('products_set_categories.before', $params);

        // add all products of collection with this hash
        $collection = new shopProductsCollection($hash);
        $offset = 0;
        $count = 100;
        $total_count = $collection->count();
        while ($offset < $total_count) {
            $product_ids = array_keys($collection->getProducts('*', $offset, $count));
            $this->category_products_model->add($product_ids, $category_ids);
            $offset += count($product_ids);
        }

        /**
         * Adds a product to the category
         *
         * @param int $new_category_id
         * @param array $category_ids with $new_category_id
         * @param string $hash
         * @param array|string products_id
         *
         * @event products_set_categories.after
         */
        $params = array(
            'new_category_id' => $new_category_id,
            'category_ids'    => $category_ids,
            'hash'            => $hash,
            'products_id'     => $all_product_ids,
        );
        wa('shop')->event('products_set_categories.after', $params);

        // form a response
        $categories = $this->category_model->getByField('id', $category_ids, 'id');
        if (isset($categories[$new_category_id])) {
            $this->response['new_category'] = $categories[$new_category_id];
            unset($categories[$new_category_id]);
        }
        $this->response['categories'] = $categories;
    }

    public function createCategory($name)
    {
        $url = shopHelper::transliterate($name, false);
        $url = $this->category_model->suggestUniqueUrl($url);
        if (empty($name)) {
            $name = _w('(no-name)');
        }
        return $this->category_model->add(array(
            'name' => $name,
            'url'  => $url
        ));
    }

    public function getHash()
    {
        $hash = waRequest::post('hash', '');
        $hash_decoded = urldecode($hash);
        if ($hash_decoded) {
            $hash = $hash_decoded;
        }
        return $hash;
    }
}