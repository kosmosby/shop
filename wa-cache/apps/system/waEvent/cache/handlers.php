<?php
return array (
  'plugins' => 
  array (
    'shop' => 
    array (
      'redirect' => 
      array (
        'name' => '301 Redirect',
        'description' => 'Helps you migrate to Shop-Script from third-party ecommerce platforms keeping all your product and storefront pages redirected and indexed properly.',
        'vendor' => 'webasyst',
        'version' => '1.1',
        'img' => 'wa-apps/shop/plugins/redirect/img/redirect.png',
        'icons' => 
        array (
          16 => 'img/redirect.png',
        ),
        'shop_settings' => true,
        'handlers' => 
        array (
          'frontend_error' => 'frontendError',
          'frontend_search' => 'frontendSearch',
        ),
        'id' => 'redirect',
        'app_id' => 'shop',
        'custom_settings' => true,
      ),
      'revolutionslider' => 
      array (
        'name' => 'Revolutionslider',
        'description' => 'Слайдер #1 для Shop-script',
        'img' => 'wa-apps/shop/plugins/revolutionslider/img/revolutionslider.png',
        'vendor' => '1058493',
        'version' => '1.2.0',
        'rights' => false,
        'frontend' => true,
        'handlers' => 
        array (
          'backend_menu' => 'backendMenu',
          'frontend_head' => 'frontendHead',
          'frontend_footer' => 'frontendFooter',
          'routing' => 'routing',
        ),
        'id' => 'revolutionslider',
        'app_id' => 'shop',
      ),
      'listfeatures' => 
      array (
        'name' => 'Product features in lists',
        'description' => 'Helps display product features in product lists and categories.',
        'vendor' => 817747,
        'version' => '2.4.1',
        'img' => 'wa-apps/shop/plugins/listfeatures/img/listfeatures16.png',
        'shop_settings' => true,
        'frontend' => true,
        'handlers' => 
        array (
          'frontend_head' => 'frontendHead',
          'routing' => 'routing',
        ),
        'id' => 'listfeatures',
        'app_id' => 'shop',
        'custom_settings' => true,
      ),
      'wholesale' => 
      array (
        'name' => 'Минимальный заказ',
        'description' => 'Ограничение минимального заказа',
        'img' => 'wa-apps/shop/plugins/wholesale/img/wholesale.png',
        'vendor' => '985310',
        'version' => '3.7.4',
        'rights' => false,
        'frontend' => true,
        'shop_settings' => true,
        'handlers' => 
        array (
          'frontend_cart' => 'frontendCart',
          'frontend_order' => 'frontendCart',
          'frontend_checkout' => 'frontendCheckout',
          'backend_product_edit' => 'backendProductEdit',
          'backend_category_dialog' => 'backendCategoryDialog',
          'backend_product_sku_settings' => 'backendProductSkuSettings',
          'frontend_product' => 'frontendProduct',
          'category_save' => 'categorySave',
          'routing' => 'routing',
        ),
        'id' => 'wholesale',
        'app_id' => 'shop',
        'custom_settings' => true,
      ),
      'xml' => 
      array (
        'name' => 'Import products from XML',
        'version' => '1.6.4',
        'importexport' => true,
        'img' => 'wa-apps/shop/plugins/xml/img/xml_icon.png',
        'vendor' => '1052040',
        'handlers' => 
        array (
          'backend_product' => 'external_id',
          'backend_category_dialog' => 'category_external_id',
          'category_save' => 'categorySave',
          'products_collection' => 'productsCollection',
          'backend_products' => 'backendProducts',
        ),
        'id' => 'xml',
        'app_id' => 'shop',
      ),
      'apiserver' => 
      array (
        'name' => 'Api server',
        'description' => 'API для мобильного приложения.',
        'version' => '1.0',
        'img' => 'wa-apps/shop/plugins/apiserver/img/logo.16x16.png',
        'icon' => 'img/icon.200x110.png',
        'frontend' => true,
        'id' => 'apiserver',
        'app_id' => 'shop',
        'handlers' => 
        array (
          'routing' => 'routing',
        ),
      ),
      'yml' => 
      array (
        'name' => 'Импорт товаров из YML',
        'version' => '3.2.1',
        'importexport' => true,
        'img' => 'wa-apps/shop/plugins/yml/img/yml_icon.png',
        'vendor' => '1052040',
        'handlers' => 
        array (
          'backend_product' => 'external_id',
          'backend_products' => 'backendProducts',
          'backend_category_dialog' => 'category_external_id',
          'products_collection' => 'productsCollection',
          'category_save' => 'categorySave',
        ),
        'id' => 'yml',
        'app_id' => 'shop',
      ),
      'imageupload' => 
      array (
        'name' => 'Загрузка изображений',
        'description' => 'Загрузка изображений по url',
        'vendor' => '985310',
        'version' => '1.1.3',
        'img' => 'wa-apps/shop/plugins/imageupload/img/imageupload.png',
        'shop_settings' => false,
        'frontend' => false,
        'handlers' => 
        array (
          'backend_product_edit' => 'backendProductEdit',
          'backend_product' => 'backendProduct',
        ),
        'id' => 'imageupload',
        'app_id' => 'shop',
      ),
      'yandexmarket' => 
      array (
        'name' => 'Яндекс.Маркет',
        'description' => 'Экспорт каталога товаров в формате YML, прием заказов (CPA)',
        'img' => 'wa-apps/shop/plugins/yandexmarket/img/yandexmarket.png',
        'vendor' => 'webasyst',
        'version' => '2.3.11',
        'importexport' => 'profiles',
        'export_profile' => true,
        'custom_settings' => true,
        'frontend' => true,
        'handlers' => 
        array (
          'backend_products' => 'backendProductsEvent',
          'backend_reports' => 'backendReportsEvent',
          'backend_reports_channels' => 'backendReportsChannelsEvent',
          'backend_category_dialog' => 'backendCategoryDialog',
          'backend_order' => 'backendOrderEvent',
          'category_save' => 'categorySaveHandler',
          'order_action.ship' => 'orderActionHandler',
          'order_action.complete' => 'orderActionHandler',
          'order_action.delete' => 'orderActionHandler',
          'order_action.*' => 'orderActionHandler',
          'order_action_form.delete' => 'orderDeleteFormHandler',
          'order_action_form.*' => 'orderDeleteFormHandler',
          'currency_delete' => 'currencyDeleteHandler',
          'routing' => 'routing',
        ),
        'id' => 'yandexmarket',
        'app_id' => 'shop',
      ),
    ),
  ),
  'handlers' => 
  array (
    'contacts' => 
    array (
      'delete' => 
      array (
        0 => 
        array (
          'app_id' => 'blog',
          'regex' => '/delete/',
          'file' => 'contacts.delete.handler.php',
          'class' => 'blogContactsDeleteHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        1 => 
        array (
          'app_id' => 'contacts',
          'regex' => '/delete/',
          'file' => 'contacts.delete.handler.php',
          'class' => 'contactsContactsDeleteHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        2 => 
        array (
          'app_id' => 'team',
          'regex' => '/delete/',
          'file' => 'contacts.delete.handler.php',
          'class' => 'teamContactsDeleteHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        3 => 
        array (
          'app_id' => 'shop',
          'regex' => '/delete/',
          'file' => 'contacts.delete.handler.php',
          'class' => 'shopContactsDeleteHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'links' => 
      array (
        0 => 
        array (
          'app_id' => 'blog',
          'regex' => '/links/',
          'file' => 'contacts.links.handler.php',
          'class' => 'blogContactsLinksHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'regex' => '/links/',
          'file' => 'contacts.links.handler.php',
          'class' => 'shopContactsLinksHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'merge' => 
      array (
        0 => 
        array (
          'app_id' => 'blog',
          'regex' => '/merge/',
          'file' => 'contacts.merge.handler.php',
          'class' => 'blogContactsMergeHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'regex' => '/merge/',
          'file' => 'contacts.merge.handler.php',
          'class' => 'shopContactsMergeHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'contacts_collection' => 
      array (
        0 => 
        array (
          'app_id' => 'contacts',
          'regex' => '/contacts_collection/',
          'file' => 'contacts.contacts_collection.handler.php',
          'class' => 'contactsContactsContacts_collectionHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        1 => 
        array (
          'app_id' => 'team',
          'regex' => '/contacts_collection/',
          'file' => 'contacts.contacts_collection.handler.php',
          'class' => 'teamContactsContacts_collectionHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        2 => 
        array (
          'app_id' => 'shop',
          'regex' => '/contacts_collection/',
          'file' => 'contacts.contacts_collection.handler.php',
          'class' => 'shopContactsContacts_collectionHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'profile.tab' => 
      array (
        0 => 
        array (
          'app_id' => 'team',
          'regex' => '/profile\\.tab/',
          'file' => 'contacts.profile.tab.handler.php',
          'class' => 'teamContactsProfileTabHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'regex' => '/profile\\.tab/',
          'file' => 'contacts.profile.tab.handler.php',
          'class' => 'shopContactsProfileTabHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'explore' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'regex' => '/explore/',
          'file' => 'contacts.explore.handler.php',
          'class' => 'shopContactsExploreHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
    ),
    'mailer' => 
    array (
      'recipients.form' => 
      array (
        0 => 
        array (
          'app_id' => 'contacts',
          'regex' => '/recipients\\.form/',
          'file' => 'mailer.recipients.form.handler.php',
          'class' => 'contactsMailerRecipientsFormHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
    ),
    'shop' => 
    array (
      'backend_customers_list' => 
      array (
        0 => 
        array (
          'app_id' => 'contacts',
          'regex' => '/backend_customers_list/',
          'file' => 'shop.backend_customers_list.handler.php',
          'class' => 'contactsShopBackend_customers_listHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'frontend_error' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'redirect',
          'regex' => '/frontend_error/',
          'class' => 'shopRedirectPlugin',
          'method' => 
          array (
            0 => 'frontendError',
          ),
        ),
      ),
      'frontend_search' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'redirect',
          'regex' => '/frontend_search/',
          'class' => 'shopRedirectPlugin',
          'method' => 
          array (
            0 => 'frontendSearch',
          ),
        ),
      ),
      'backend_menu' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'revolutionslider',
          'regex' => '/backend_menu/',
          'class' => 'shopRevolutionsliderPlugin',
          'method' => 
          array (
            0 => 'backendMenu',
          ),
        ),
      ),
      'frontend_head' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'revolutionslider',
          'regex' => '/frontend_head/',
          'class' => 'shopRevolutionsliderPlugin',
          'method' => 
          array (
            0 => 'frontendHead',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'listfeatures',
          'regex' => '/frontend_head/',
          'class' => 'shopListfeaturesPlugin',
          'method' => 
          array (
            0 => 'frontendHead',
          ),
        ),
      ),
      'frontend_footer' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'revolutionslider',
          'regex' => '/frontend_footer/',
          'class' => 'shopRevolutionsliderPlugin',
          'method' => 
          array (
            0 => 'frontendFooter',
          ),
        ),
      ),
      'routing' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'revolutionslider',
          'regex' => '/routing/',
          'class' => 'shopRevolutionsliderPlugin',
          'method' => 
          array (
            0 => 'routing',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'listfeatures',
          'regex' => '/routing/',
          'class' => 'shopListfeaturesPlugin',
          'method' => 
          array (
            0 => 'routing',
          ),
        ),
        2 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/routing/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'routing',
          ),
        ),
        3 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'apiserver',
          'regex' => '/routing/',
          'class' => 'shopApiserverPlugin',
          'method' => 
          array (
            0 => 'routing',
          ),
        ),
        4 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/routing/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'routing',
          ),
        ),
      ),
      'frontend_cart' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/frontend_cart/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'frontendCart',
          ),
        ),
      ),
      'frontend_order' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/frontend_order/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'frontendCart',
          ),
        ),
      ),
      'frontend_checkout' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/frontend_checkout/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'frontendCheckout',
          ),
        ),
      ),
      'backend_product_edit' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/backend_product_edit/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'backendProductEdit',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'imageupload',
          'regex' => '/backend_product_edit/',
          'class' => 'shopImageuploadPlugin',
          'method' => 
          array (
            0 => 'backendProductEdit',
          ),
        ),
      ),
      'backend_category_dialog' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/backend_category_dialog/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'backendCategoryDialog',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'xml',
          'regex' => '/backend_category_dialog/',
          'class' => 'shopXmlPlugin',
          'method' => 
          array (
            0 => 'category_external_id',
          ),
        ),
        2 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yml',
          'regex' => '/backend_category_dialog/',
          'class' => 'shopYmlPlugin',
          'method' => 
          array (
            0 => 'category_external_id',
          ),
        ),
        3 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/backend_category_dialog/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'backendCategoryDialog',
          ),
        ),
      ),
      'backend_product_sku_settings' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/backend_product_sku_settings/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'backendProductSkuSettings',
          ),
        ),
      ),
      'frontend_product' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/frontend_product/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'frontendProduct',
          ),
        ),
      ),
      'category_save' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'wholesale',
          'regex' => '/category_save/',
          'class' => 'shopWholesalePlugin',
          'method' => 
          array (
            0 => 'categorySave',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'xml',
          'regex' => '/category_save/',
          'class' => 'shopXmlPlugin',
          'method' => 
          array (
            0 => 'categorySave',
          ),
        ),
        2 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yml',
          'regex' => '/category_save/',
          'class' => 'shopYmlPlugin',
          'method' => 
          array (
            0 => 'categorySave',
          ),
        ),
        3 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/category_save/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'categorySaveHandler',
          ),
        ),
      ),
      'backend_product' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'xml',
          'regex' => '/backend_product/',
          'class' => 'shopXmlPlugin',
          'method' => 
          array (
            0 => 'external_id',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yml',
          'regex' => '/backend_product/',
          'class' => 'shopYmlPlugin',
          'method' => 
          array (
            0 => 'external_id',
          ),
        ),
        2 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'imageupload',
          'regex' => '/backend_product/',
          'class' => 'shopImageuploadPlugin',
          'method' => 
          array (
            0 => 'backendProduct',
          ),
        ),
      ),
      'products_collection' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'xml',
          'regex' => '/products_collection/',
          'class' => 'shopXmlPlugin',
          'method' => 
          array (
            0 => 'productsCollection',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yml',
          'regex' => '/products_collection/',
          'class' => 'shopYmlPlugin',
          'method' => 
          array (
            0 => 'productsCollection',
          ),
        ),
      ),
      'backend_products' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'xml',
          'regex' => '/backend_products/',
          'class' => 'shopXmlPlugin',
          'method' => 
          array (
            0 => 'backendProducts',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yml',
          'regex' => '/backend_products/',
          'class' => 'shopYmlPlugin',
          'method' => 
          array (
            0 => 'backendProducts',
          ),
        ),
        2 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/backend_products/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'backendProductsEvent',
          ),
        ),
      ),
      'backend_reports' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/backend_reports/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'backendReportsEvent',
          ),
        ),
      ),
      'backend_reports_channels' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/backend_reports_channels/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'backendReportsChannelsEvent',
          ),
        ),
      ),
      'backend_order' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/backend_order/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'backendOrderEvent',
          ),
        ),
      ),
      'order_action.ship' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/order_action\\.ship/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'orderActionHandler',
          ),
        ),
      ),
      'order_action.complete' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/order_action\\.complete/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'orderActionHandler',
          ),
        ),
      ),
      'order_action.delete' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/order_action\\.delete/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'orderActionHandler',
          ),
        ),
      ),
      '*' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/order_action\\..*/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'orderActionHandler',
          ),
        ),
        1 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/order_action_form\\..*/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'orderDeleteFormHandler',
          ),
        ),
      ),
      'order_action_form.delete' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/order_action_form\\.delete/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'orderDeleteFormHandler',
          ),
        ),
      ),
      'currency_delete' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'plugin_id' => 'yandexmarket',
          'regex' => '/currency_delete/',
          'class' => 'shopYandexmarketPlugin',
          'method' => 
          array (
            0 => 'currencyDeleteHandler',
          ),
        ),
      ),
    ),
    'webasyst' => 
    array (
      'backend_header' => 
      array (
        0 => 
        array (
          'app_id' => 'installer',
          'regex' => '/backend_header/',
          'file' => 'webasyst.backend_header.handler.php',
          'class' => 'installerWebasystBackend_headerHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'backend_personal_profile' => 
      array (
        0 => 
        array (
          'app_id' => 'team',
          'regex' => '/backend_personal_profile/',
          'file' => 'webasyst.backend_personal_profile.handler.php',
          'class' => 'teamWebasystBackend_personal_profileHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'backend_dispatch_miss' => 
      array (
        0 => 
        array (
          'app_id' => 'team',
          'regex' => '/backend_dispatch_miss/',
          'file' => 'webasyst.backend_dispatch_miss.handler.php',
          'class' => 'teamWebasystBackend_dispatch_missHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'backend_push' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'regex' => '/backend_push/',
          'file' => 'webasyst.backend_push.handler.php',
          'class' => 'shopWebasystBackend_pushHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
    ),
    'site' => 
    array (
      'route_delete.after' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'regex' => '/route_delete\\.after/',
          'file' => 'site.route_delete.after.handler.php',
          'class' => 'shopSiteRoute_deleteAfterHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'route_save.before' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'regex' => '/route_save\\.before/',
          'file' => 'site.route_save.before.handler.php',
          'class' => 'shopSiteRoute_saveBeforeHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'route_save.after' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'regex' => '/route_save\\.after/',
          'file' => 'site.route_save.after.handler.php',
          'class' => 'shopSiteRoute_saveAfterHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
      'update.route' => 
      array (
        0 => 
        array (
          'app_id' => 'shop',
          'regex' => '/update\\.route/',
          'file' => 'site.update.route.handler.php',
          'class' => 'shopSiteUpdateRouteHandler',
          'method' => 
          array (
            0 => 'execute',
          ),
        ),
      ),
    ),
  ),
);
