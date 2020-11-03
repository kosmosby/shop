<?php /* Smarty version Smarty-3.1.14, created on 2020-10-29 13:04:25
         compiled from "/Users/kosmos/Documents/sites/shop/wa-data/public/site/themes/default/index.html" */ ?>
<?php /*%%SmartyHeaderCode:17158136865f9a93a9c597a2-68900551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c127e4154883586e310a217a5b788ef05662d965' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-data/public/site/themes/default/index.html',
      1 => 1603270277,
      2 => 'file',
    ),
    '1962a890de473f48fa1fffb3b60b8f9c3895b719' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-data/public/site/themes/default/admin-sidebar.html',
      1 => 1603270277,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17158136865f9a93a9c597a2-68900551',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_settings' => 0,
    '_color_scheme_class' => 0,
    'wa' => 0,
    '_is_order_page' => 0,
    'html_class_array' => 0,
    '_head_prefix' => 0,
    'canonical' => 0,
    'rss' => 0,
    'wa_theme_url' => 0,
    'wa_theme_version' => 0,
    'wa_url' => 0,
    '_real_font_name' => 0,
    'wa_static_url' => 0,
    'wa_active_theme_path' => 0,
    '_links' => 0,
    'a' => 0,
    'wa_app_url' => 0,
    '_hide_cart' => 0,
    'cart_total' => 0,
    '_cart_url' => 0,
    '_loading_template' => 0,
    'blogs' => 0,
    'b' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f9a93aa8af188_17070760',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9a93aa8af188_17070760')) {function content_5f9a93aa8af188_17070760($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?><!DOCTYPE html>
<?php $_smarty_tpl->tpl_vars['html_class_array'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['_color_scheme_class'] = new Smarty_variable(('color_scheme_').(str_replace('img/themesettings/','',str_replace('.png','',$_smarty_tpl->tpl_vars['theme_settings']->value['color_scheme']))), null, 0);?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_scheme']){?><?php $_smarty_tpl->createLocalArrayVariable('html_class_array', null, 0);
$_smarty_tpl->tpl_vars['html_class_array']->value[] = $_smarty_tpl->tpl_vars['_color_scheme_class']->value;?><?php }?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['font_size']){?><?php $_smarty_tpl->createLocalArrayVariable('html_class_array', null, 0);
$_smarty_tpl->tpl_vars['html_class_array']->value[] = $_smarty_tpl->tpl_vars['theme_settings']->value['font_size'];?><?php }?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['font_family']){?><?php $_smarty_tpl->createLocalArrayVariable('html_class_array', null, 0);
$_smarty_tpl->tpl_vars['html_class_array']->value[] = $_smarty_tpl->tpl_vars['theme_settings']->value['font_family'];?><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->globals('isMyAccount')){?><?php $_smarty_tpl->createLocalArrayVariable('html_class_array', null, 0);
$_smarty_tpl->tpl_vars['html_class_array']->value[] = 'my';?><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->shop){?><?php if (method_exists($_smarty_tpl->tpl_vars['wa']->value->shop,'checkout')){?><?php $_smarty_tpl->tpl_vars['_cart_url'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->checkout()->cartUrl(), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['_cart_url'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/cart'), null, 0);?><?php }?><?php }?><?php $_smarty_tpl->tpl_vars['_is_order_page'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->globals("isOrderPage"), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['_is_order_page']->value)){?><?php $_smarty_tpl->createLocalArrayVariable('html_class_array', null, 0);
$_smarty_tpl->tpl_vars['html_class_array']->value[] = "is-order-page";?><?php }?>
<html<?php if (!empty($_smarty_tpl->tpl_vars['html_class_array']->value)){?> class="<?php echo join(' ',$_smarty_tpl->tpl_vars['html_class_array']->value);?>
"<?php }?>>

<?php $_smarty_tpl->tpl_vars['_head_prefix'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->globals("headPrefix"), null, 0);?>

<head <?php if (!empty($_smarty_tpl->tpl_vars['_head_prefix']->value)){?>prefix="<?php echo $_smarty_tpl->tpl_vars['_head_prefix']->value;?>
"<?php }?>>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1<?php if ($_smarty_tpl->tpl_vars['wa']->value->isMobile()){?>, maximum-scale=1, user-scalable=0<?php }?>" />
    <meta http-equiv="x-ua-compatible" content="IE=edge">

    <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->title(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <meta name="keywords" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->meta('keywords'), ENT_QUOTES, 'UTF-8', true);?>
" />
    <meta name="description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->meta('description'), ENT_QUOTES, 'UTF-8', true);?>
" />

    <?php if (!empty($_smarty_tpl->tpl_vars['canonical']->value)){?><link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['canonical']->value;?>
"/><?php }?>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <?php if ($_smarty_tpl->tpl_vars['wa']->value->blog){?>
        <!-- rss -->
        <?php $_smarty_tpl->tpl_vars['rss'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->rssUrl(), null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['rss']->value){?><link rel="alternate" type="application/rss+xml" title="<?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['rss']->value;?>
"><?php }?>
    <?php }?>

    <!-- css -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
default.css?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
" rel="stylesheet" type="text/css"/>
    <?php if ($_smarty_tpl->tpl_vars['wa']->value->shop&&$_smarty_tpl->tpl_vars['wa']->value->shop->currency()=='RUB'){?><link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/font/ruble/arial/fontface.css" rel="stylesheet" type="text/css"><?php }?>
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>
 
    <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'_google_')){?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'fira')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('Fira+Sans:400,500,700,400italic,500italic,700italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'opensans')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('Open+Sans:400,700,700italic,400italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'ptsans')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('PT+Sans:400,700,700italic,400italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'ptserif')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('PT+Serif:400,700,700italic,400italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'ptsansandserif')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('PT+Sans+Caption:400,700|PT+Serif:400,700,700italic,400italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'roboto')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('Roboto:400,700,700italic,400italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'lora')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('Lora:400,700,700italic,400italic', null, 0);?><?php }?>
        <?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['font_family'],'ubuntu')){?><?php $_smarty_tpl->tpl_vars['_real_font_name'] = new Smarty_variable('Ubuntu:400,700,700italic,400italic', null, 0);?><?php }?>
        <link href='https://fonts.googleapis.com/css?family=<?php echo $_smarty_tpl->tpl_vars['_real_font_name']->value;?>
&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?php }?>

    <!-- js -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_static_url']->value;?>
wa-content/js/jquery/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_static_url']->value;?>
wa-content/js/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
default.js?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
"></script>

    <?php echo $_smarty_tpl->tpl_vars['wa']->value->js();?>
 

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wa_active_theme_path']->value)."/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <?php echo $_smarty_tpl->tpl_vars['wa']->value->head();?>
 

    <!-- custom colors -->
    <style>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_text']){?> html, body { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_text'];?>
; } <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_links']){?> a { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_links'];?>
; } <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_links_visited']){?> a:visited { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_links_visited'];?>
; } <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_links_hover']){?> a:hover { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_links_hover'];?>
; } <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_hint']){?>
            .hint,
            .breadcrumbs,
            .breadcrumbs a,
            .breadcrumbs span.rarr,
            table.features tr.divider td,
            .bestsellers .bestsellers-header,
            ul.thumbs li span.summary,
            .review .summary,
            .review .summary .date,
            ul.albums li .count,
            .album-note,
            .credentials .username, .credentials .username a { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_hint'];?>
; }
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['header_customcolor_links']){?>
            header h2 a, header h2 a:hover,
            header .apps li a, header .apps li a:hover,
            header .auth li a, header .auth li a:hover,
            header .auth li a strong, header .auth li a:hover strong,
            header #globalnav.light .apps li a, header #globalnav.light .apps li a:hover,
            header #globalnav.light .apps li.selected a,
            header #globalnav.light .apps li.selected a:hover { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['header_customcolor_links'];?>
 !important; }
            header #globalnav.light .apps li.selected a { font-weight: bold; }
            header #globalnav.light h2 a,
            header #globalnav.light h2 a:hover { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['header_customcolor_links'];?>
 !important; }
            header .apps li.selected a { background: transparent; }
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_custom_links']){?>
            header .pages li a, header .pages li a:hover,
            .color_scheme_white header .pages li a,
            .color_scheme_white header .pages li a:hover { color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_custom_links'];?>
 !important; }
        <?php }?>
        <?php if (trim($_smarty_tpl->tpl_vars['theme_settings']->value['style_custom'])){?><?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['style_custom'];?>
<?php }?>
    </style>

    <!--[if lt IE 9]>
    <script>
    document.createElement('header');
    document.createElement('nav');
    document.createElement('section');
    document.createElement('article');
    document.createElement('aside');
    document.createElement('footer');
    document.createElement('figure');
    document.createElement('hgroup');
    document.createElement('menu');
    </script>
    <![endif]-->

</head>
<body>
    <header class="globalheader" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_custom']){?>background-color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['color_custom'];?>
;<?php }?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['header_custom_image']){?>background-image: url('<?php echo ($_smarty_tpl->tpl_vars['wa_theme_url']->value).($_smarty_tpl->tpl_vars['theme_settings']->value['header_custom_image']);?>
');<?php }?>">

        <?php if (count($_smarty_tpl->tpl_vars['wa']->value->apps())>0||$_smarty_tpl->tpl_vars['wa']->value->isAuthEnabled()){?>

            <!-- GLOBAL NAVIGATION -->
            <div id="globalnav" class="<?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['header_scheme'],'white')){?>light<?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['header_scheme'],'andgray')){?> andgray<?php }?><?php }?>"<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['header_customcolor']){?> style="background-color: <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['header_customcolor'];?>
;"<?php }?>>
                <div class="container">

                    <div class="wa-flex-box full-line">
                        <nav class="column wa-flex-box middle" style="flex: 1;">
                            <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['header_sitename']||$_smarty_tpl->tpl_vars['theme_settings']->value['logo']){?>
                                <h2>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['logo']){?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['logo'];?>
?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
" id="logo" />
                                            <span><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</span>
                                        <?php }else{ ?>
                                            <?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>

                                        <?php }?>
                                    </a>
                                </h2>
                            <?php }?>

                            <ul class="apps"><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable(array(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']=='site-pages'){?><?php if ($_smarty_tpl->tpl_vars['wa']->value->site){?><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->site->pages(), null, 0);?><?php }?><?php }elseif($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']=='shop-pages'){?><?php if ($_smarty_tpl->tpl_vars['wa']->value->shop){?><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->pages(), null, 0);?><?php }?><?php }elseif($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']=='blog-pages'){?><?php if ($_smarty_tpl->tpl_vars['wa']->value->blog){?><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->pages(), null, 0);?><?php }?><?php }elseif($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']=='photos-pages'){?><?php if ($_smarty_tpl->tpl_vars['wa']->value->photos){?><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->photos->pages(), null, 0);?><?php }?><?php }elseif($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']=='hub-pages'){?><?php if ($_smarty_tpl->tpl_vars['wa']->value->hub){?><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->hub->pages(), null, 0);?><?php }?><?php }elseif($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']!='none'){?><?php $_smarty_tpl->tpl_vars['_links'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->apps(), null, 0);?><?php }?><?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
$_smarty_tpl->tpl_vars['a']->_loop = true;
?><?php if (!($_smarty_tpl->tpl_vars['a']->value['url']==$_smarty_tpl->tpl_vars['wa_url']->value&&$_smarty_tpl->tpl_vars['a']->value['name']==$_smarty_tpl->tpl_vars['wa']->value->accountName())){?><li<?php if ($_smarty_tpl->tpl_vars['a']->value['url']==$_smarty_tpl->tpl_vars['wa_app_url']->value&&!$_smarty_tpl->tpl_vars['wa']->value->globals('isMyAccount')||strlen($_smarty_tpl->tpl_vars['a']->value['url'])>1&&strstr($_smarty_tpl->tpl_vars['wa']->value->currentUrl(),$_smarty_tpl->tpl_vars['a']->value['url'])){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</a></li><?php }?><?php } ?></ul>

                            <div class="clear-both"></div>
                        </nav>

                        <div class="column wa-flex-box middle">
                            <?php $_smarty_tpl->tpl_vars['_hide_cart'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->globals("hideCart"), null, 0);?>
                            <?php if ($_smarty_tpl->tpl_vars['wa']->value->shop&&empty($_smarty_tpl->tpl_vars['_hide_cart']->value)){?>
                                <!-- cart -->
                                <?php $_smarty_tpl->tpl_vars['cart_total'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->cart->total(), null, 0);?>
                                <div id="cart" class="cart<?php if (!$_smarty_tpl->tpl_vars['cart_total']->value){?> empty<?php }?>">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_cart_url']->value;?>
" class="cart-summary">
                                        <i class="cart-icon"></i>
                                        <strong class="cart-total"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['cart_total']->value,$_smarty_tpl->tpl_vars['wa']->value->shop->currency());?>
</strong>
                                    </a>
                                    <div id="cart-content">
                                        
                                    </div>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_cart_url']->value;?>
" class="cart-to-checkout" style="display: none;">
                                        Посмотреть корзину
                                    </a>
                                </div>

                                <?php $_smarty_tpl->_capture_stack[0][] = array('default', "_loading_template", null); ob_start(); ?><div class="s-loading-section"><div class="s-loading-content"><i class="icon16 loading"></i></div></div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                                <script>
                                    ( function($) {
                                        var is_loading = false;
                                        $("#cart").on("click", function() {
                                            if (!is_loading) {
                                                is_loading = true;
                                                $("body").append(<?php echo json_encode($_smarty_tpl->tpl_vars['_loading_template']->value);?>
);
                                            }
                                        });
                                    })(jQuery);
                                </script>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['wa']->value->isAuthEnabled()){?>
                                <!-- user auth -->
                                <ul class="auth" id="js-header-auth-wrapper"><?php if ($_smarty_tpl->tpl_vars['wa']->value->user()->isAuth()){?><?php if ($_smarty_tpl->tpl_vars['wa']->value->myUrl()){?><li<?php if ($_smarty_tpl->tpl_vars['wa']->value->globals('isMyAccount')){?> class="bold"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->myUrl();?>
" class="not-visited"><i class="icon16 userpic20 float-left" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['wa']->value->user()->getPhoto2x(20);?>
');"></i> <strong><?php echo (($tmp = @$_smarty_tpl->tpl_vars['wa']->value->user('firstname'))===null||$tmp==='' ? 'Личный кабинет' : $tmp);?>
</strong></a></li><?php }else{ ?><li><strong><?php echo (($tmp = @$_smarty_tpl->tpl_vars['wa']->value->user('firstname'))===null||$tmp==='' ? 'Личный кабинет' : $tmp);?>
</strong></li><?php }?><li><a href="?logout" class="not-visited">Выйти</a></li><?php }else{ ?><li><a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->loginUrl();?>
" class="not-visited">Вход</a></li><li><a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->signupUrl();?>
" class="not-visited">Регистрация</a></li><?php }?></ul>
                            <?php }?>

                            <button id="mobile-nav-toggle"></button>

                            <div class="clear-both"></div>
                        </div>
                    </div>

                </div>
            </div>

        <?php }?>

        <!-- APP NAVIGATION -->
        <div class="container appnav" id="header-container"<?php if (strstr($_smarty_tpl->tpl_vars['theme_settings']->value['header_scheme'],'andgray')){?> style="border-top: 1px solid transparent;"<?php }?>>
            <?php if ($_smarty_tpl->tpl_vars['wa']->value->globals('isMyAccount')){?>

                
                <?php echo $_smarty_tpl->tpl_vars['wa']->value->myNav('pages');?>


            <?php }else{ ?>

                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wa_active_theme_path']->value)."/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


            <?php }?>
            <div class="clear-both"></div>
        </div>

    </header>

    <!-- APP CONTENT -->
    <main class="maincontent">
        <div class="container">
            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wa_active_theme_path']->value)."/main.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="globalfooter">
        <div class="container">

            <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['footer_links'])){?>

                <div class="footer-block contact-us">

                    <div class="social">
                        <?php if ($_smarty_tpl->tpl_vars['wa']->value->blog&&$_smarty_tpl->tpl_vars['rss']->value){?><a href="<?php echo $_smarty_tpl->tpl_vars['rss']->value;?>
" title="RSS"><i class="icon24 rss"></i></a><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['facebook'])){?><a href="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['facebook'];?>
" title="Фейсбук"><i class="icon24 facebook"></i></a><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['twitter'])){?><a href="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['twitter'];?>
" title="Твиттер"><i class="icon24 twitter"></i></a><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['vk'])){?><a href="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['vk'];?>
" title="ВКонтакте"><i class="icon24 vk"></i></a><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['instagram'])){?><a href="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['instagram'];?>
" title="Инстаграм"><i class="icon24 instagram"></i></a><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['youtube'])){?><a href="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['youtube'];?>
" title="Youtube"><i class="icon24 youtube"></i></a><?php }?>
                    </div>

                    <?php if ($_smarty_tpl->tpl_vars['wa']->value->shop){?>
                        <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->settings('email');?>
"><?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->settings('email');?>
</a>
                        <strong><?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->settings('phone');?>
</strong>
                    <?php }?>

                </div>


                <?php if ($_smarty_tpl->tpl_vars['wa']->value->shop){?>
                    <div class="footer-block">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend');?>
" class="top">Магазин</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_cart_url']->value;?>
">Корзина</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/checkout');?>
">Оформить заказ</a>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['wa']->value->photos){?>
                    <div class="footer-block">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('photos/frontend');?>
" class="top">Фото</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('photos/frontend');?>
">Фотопоток</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('photos/frontend');?>
favorites/">Избранное</a>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['wa']->value->blog){?>
                    <div class="footer-block">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('blog/frontend');?>
" class="top">Блог</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->blog->rssUrl();?>
">RSS</a>
                        <?php $_smarty_tpl->tpl_vars['blogs'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->blogs(), null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blogs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value){
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['b']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['b']->value['name'];?>
</a>
                        <?php } ?>
                    </div>
                <?php }?>

                <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['footer_subscribe_form_use'])&&$_smarty_tpl->tpl_vars['wa']->value->mailer&&$_smarty_tpl->tpl_vars['wa']->value->getUrl('mailer/frontend/subscribe')){?>
                    <div class="footer-block mailer-subscribe">
                        <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['footer_subscribe_form_title'])){?>
                            <a href="javascript:void(0);" class="top"><?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['footer_subscribe_form_title'];?>
</a>
                        <?php }?>

                        <section class="s-subscribe-section" id="js-subscribe-section">
                            <form>
                                <div class="line">
                                    <input class="js-email-field" type="email" name="email" placeholder="your@email.here" required>
                                    <input class="small js-submit-button" type="submit" value="Подписаться">
                                </div>
                                <div class="s-hidden"><?php echo $_smarty_tpl->tpl_vars['wa']->value->captcha(array('app_id'=>'mailer'));?>
</div>
                            </form>

                            <p class="js-success-message" style="display:none">
                                <i>Спасибо! Будем держать вас в курсе.</i>
                            </p>

                            <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['footer_subscribe_personal_data'])){?>
                                <div class="s-form-desc"><?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['footer_subscribe_personal_data'];?>
</div>
                            <?php }?>

                            <script>
                                ( function($) {
                                    new SubscribeSection({
                                        $wrapper: $("#js-subscribe-section"),
                                        request_uri: "<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('mailer/frontend/subscribe');?>
"
                                    })
                                })(jQuery);
                            </script>
                        </section>

                    </div>
                <?php }?>
            <?php }?>

            <div class="clear-both"></div>

            <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['footer_note'])){?>
                <p class="hint footer-note">
                    <?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['footer_note'];?>

                </p>
            <?php }?>

        </div>

        <div class="container">
            <div class="appfooter">
                <div class="copyright">
                    &copy; <?php echo smarty_modifier_wa_datetime(time(),"Y");?>

                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</a>
                </div>
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wa_active_theme_path']->value)."/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


                <?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['footer_notice'])){?>
                    <div style="clear: both"></div>
                    <div class="s-footer-notice"><?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['footer_notice'];?>
</div>
                <?php }?>
            </div>
        </div>

    </footer>

    
    <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['admin_sidebar']){?>
        <?php if ($_smarty_tpl->tpl_vars['wa']->value->user()->isAdmin()){?><?php /*  Call merged included template "admin-sidebar.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("admin-sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '17158136865f9a93a9c597a2-68900551');
content_5f9a93aa443223_32132810($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "admin-sidebar.html" */?><?php }?>
    <?php }?>
</body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2020-10-29 13:04:26
         compiled from "/Users/kosmos/Documents/sites/shop/wa-data/public/site/themes/default/admin-sidebar.html" */ ?>
<?php if ($_valid && !is_callable('content_5f9a93aa443223_32132810')) {function content_5f9a93aa443223_32132810($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['settings'] = new Smarty_variable($_smarty_tpl->tpl_vars['theme_settings_config']->value, null, 0);?>
<?php $_smarty_tpl->tpl_vars['array_name'] = new Smarty_variable("parent_settings", null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['wa']->value->param('app')=="site"){?>
    <?php $_smarty_tpl->tpl_vars['array_name'] = new Smarty_variable("settings", null, 0);?>
<?php }?>


<?php $_smarty_tpl->tpl_vars['app'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->param('app'), null, 0);?>
<?php $_smarty_tpl->tpl_vars['action'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->param('action'), null, 0);?>
<?php $_smarty_tpl->tpl_vars['plugin'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->param('plugin'), null, 0);?>
<?php $_smarty_tpl->tpl_vars['quick_links'] = new Smarty_variable(array(), null, 0);?>
<?php if (empty($_smarty_tpl->tpl_vars['plugin']->value)){?>
    <?php if ($_smarty_tpl->tpl_vars['app']->value=='shop'&&$_smarty_tpl->tpl_vars['action']->value=='category'&&!empty($_smarty_tpl->tpl_vars['category']->value)){?>
        <?php $_smarty_tpl->createLocalArrayVariable('quick_links', null, 0);
$_smarty_tpl->tpl_vars['quick_links']->value[] = array("name"=>"Редактировать","href"=>((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value)."shop/?action=products#/products/category_id=".((string)$_smarty_tpl->tpl_vars['category']->value['id']));?>
    <?php }elseif($_smarty_tpl->tpl_vars['app']->value=='shop'&&$_smarty_tpl->tpl_vars['action']->value=='product'&&!empty($_smarty_tpl->tpl_vars['product']->value)){?>
        <?php $_smarty_tpl->createLocalArrayVariable('quick_links', null, 0);
$_smarty_tpl->tpl_vars['quick_links']->value[] = array("name"=>"Редактировать","href"=>((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value)."shop/?action=products#/product/".((string)$_smarty_tpl->tpl_vars['product']->value['id'])."/edit/");?>

    <?php }elseif($_smarty_tpl->tpl_vars['app']->value=='blog'&&$_smarty_tpl->tpl_vars['action']->value=='post'&&!empty($_smarty_tpl->tpl_vars['post']->value)){?>
        <?php $_smarty_tpl->createLocalArrayVariable('quick_links', null, 0);
$_smarty_tpl->tpl_vars['quick_links']->value[] = array("name"=>"Редактировать","href"=>((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value)."blog/?module=post&id=".((string)$_smarty_tpl->tpl_vars['post']->value['id'])."&action=edit");?>

    <?php }elseif($_smarty_tpl->tpl_vars['action']->value=='page'){?>
        <?php $_smarty_tpl->tpl_vars['href'] = new Smarty_variable(false, null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['app']->value=='shop'&&!empty($_smarty_tpl->tpl_vars['page']->value)){?>
            <?php $_smarty_tpl->tpl_vars['href'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value).((string)$_smarty_tpl->tpl_vars['app']->value)."/?action=storefronts#/pages/".((string)$_smarty_tpl->tpl_vars['page']->value['id']), null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['app']->value=='blog'&&!empty($_smarty_tpl->tpl_vars['page']->value)){?>
            <?php $_smarty_tpl->tpl_vars['href'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value).((string)$_smarty_tpl->tpl_vars['app']->value)."/?module=pages#/".((string)$_smarty_tpl->tpl_vars['page']->value['id']), null, 0);?>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['href']->value){?>
            <?php $_smarty_tpl->createLocalArrayVariable('quick_links', null, 0);
$_smarty_tpl->tpl_vars['quick_links']->value[] = array("name"=>"Редактировать","href"=>$_smarty_tpl->tpl_vars['href']->value);?>
        <?php }?>

    <?php }elseif($_smarty_tpl->tpl_vars['app']->value=='site'&&!empty($_smarty_tpl->tpl_vars['page']->value)){?>
        <?php $_smarty_tpl->createLocalArrayVariable('quick_links', null, 0);
$_smarty_tpl->tpl_vars['quick_links']->value[] = array("name"=>"Редактировать","href"=>((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value).((string)$_smarty_tpl->tpl_vars['app']->value)."/#/pages/".((string)$_smarty_tpl->tpl_vars['page']->value['id']));?>
    <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value){?>


<aside id="s-live-setting-wrapper" class="s-live-setting-wrapper">

    <style>
        .s-live-setting-wrapper {
            display: none;
            position: fixed;
            top: 0;
            left: -293px;
            width: 300px;
            height: 100%;
            z-index: 999;
            -webkit-transition: left 400ms ease-in-out;
            -moz-transition: left 400ms ease-in-out;
            -o-transition: left 400ms ease-in-out;
            transition: left 400ms ease-in-out;
            -webkit-box-shadow: 0 0 3px 0 rgba(88,88,88,0.1);
            box-shadow: 0 0 3px 0 rgba(88,88,88,0.1);
            background: rgba(42,42,42,0.95);
            font: normal 14px/1.25 "Helvetica Neue", Arial, "sans-serif" !important;
            color: #fff;
        }
        .s-live-setting-wrapper * { font-family: "Helvetica Neue", Arial, "sans-serif"; }
        .s-live-setting-wrapper.is-shown {
            left: 0;
        }
        .s-live-setting-wrapper.is-shown .s-live-setting-header {
            background: #555;
        }
        .s-live-setting-wrapper.is-shown .s-live-setting-block {
            overflow-y: auto;
        }
        .s-live-setting-wrapper .s-live-setting-block {
            position: relative;
            padding: 0;
            box-sizing: border-box;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 100%;
            z-index: 1;
        }
        .s-live-setting-wrapper .s-live-setting-block .s-live-setting-header {
            text-transform: uppercase;
            font-weight: bold !important;
            padding: 10px 15px;
            margin: 0;
            -webkit-transition: all 300ms ease-in-out;
            -moz-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
            line-height: 21px;
            color: #ccc;
            cursor: pointer;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper {

        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper {
            overflow: hidden;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper.is-active .header-block:after {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper.is-active .settings-list {
            padding: 10px;
            height: 100%;
            opacity: 1;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper .header-block {
            position: relative;
            padding: 10px 42px 10px 15px;
            color: #fff;
            -webkit-transition: all 300ms ease-in-out;
            -moz-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
            cursor: pointer;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper .header-block:hover {
            color: #ffa;
            background: rgba(0,0,0,0.2);
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper .header-block:after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            display: block;
            width: 42px;
            height: 100%;
            background: transparent url("<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icons/arrow-right.png") 50% no-repeat;
            background-size: 17px;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper .settings-list {
            height: 0;
            padding: 0 7px;
            opacity: 0;
            overflow: hidden;
            background: rgba(42,42,42,0.6);
            color: #999;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper .settings-list .set-item {
            padding: 4px;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper .settings-list .set-item:first-child {
            margin-top: 0;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#header_scheme .settings-list,
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#color_scheme .settings-list {
            line-height: 0;
            font-size: 0;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#header_scheme .settings-list .set-image-item,
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#color_scheme .settings-list .set-image-item {
            display: inline-block;
            vertical-align: top;
            width: 45px;
            border: 2px solid transparent;
            margin: 3px;
            overflow: hidden;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#header_scheme .settings-list .set-image-item.is-active,
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#color_scheme .settings-list .set-image-item.is-active {
            border-color: #fa0;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#header_scheme .settings-list .set-image-item img,
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#color_scheme .settings-list .set-image-item img {
            max-width: 100%;
            margin-bottom: -4px;
            cursor: pointer;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#header_scheme .settings-list .set-image-item input,
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .group-wrapper#color_scheme .settings-list .set-image-item input {
            display: none;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .buttons-wrapper {
            margin: 10px 13px;
        }
        .s-live-setting-wrapper .buttons-wrapper .loading {
            display: none;
            margin: 0 18px;
            vertical-align: baseline;
            height: 33px;
            background-position: 50% 50%;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .buttons-wrapper.is-loading {
            position: relative;
            overflow: hidden;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .buttons-wrapper.is-loading .submit-button {
            display: none;
        }
        .s-live-setting-wrapper .s-live-setting-block .theme-settings-wrapper .buttons-wrapper.is-loading .loading {
            display: inline-block;
        }
        .s-live-setting-wrapper .s-live-footer-wrapper {
            visibility: hidden;
            position: absolute;
            width: 100%;
            bottom: 0;
            left: -200%;
            padding: 1em;
            box-sizing: border-box;
            overflow: hidden;
            font-size: 0.9em !important;
            line-height: 1.3em !important;
            text-align: center;
            color: #777;
        }
        .s-live-setting-wrapper .s-live-footer-wrapper.is-shown {
            visibility: visible;
            left: 0;
        }
        .s-live-setting-wrapper .s-live-buttons-wrapper {
            position: absolute;
            left: 100%;
            top: 50%;
            margin: -45px 0 0;
        }
        .s-live-setting-wrapper .s-live-buttons-wrapper .link-item {
            display: block;
            width: 28px;
            height: 28px;
            margin: 6px 0 0;
            padding: 7px;
            background: rgba(42,42,42,0.95) 50% no-repeat;
            background-size: 20px;

            -webkit-border-radius: 0 7px 7px 0;
            -moz-border-radius: 0 7px 7px 0;
            border-radius: 0 7px 7px 0;
        }
        .s-live-setting-wrapper .s-live-buttons-wrapper .link-item:first-child {
            margin-top: 0
        }
        .s-live-setting-wrapper .s-live-buttons-wrapper .open-link {
            background-image: url("<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icons/settings.png");
        }
        .s-live-setting-wrapper .s-live-buttons-wrapper .edit-link {
            background-image: url("<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icons/edit.png");
            background-color: #fcd630;
        }
        .s-live-setting-wrapper .submit-button,
        .s-live-setting-wrapper button,
        .s-live-setting-wrapper input[type="text"],
        .s-live-setting-wrapper input[type="password"],
        .s-live-setting-wrapper input[type="button"],
        .s-live-setting-wrapper input[type="submit"],
        .s-live-setting-wrapper input[type="reset"],
        .s-live-setting-wrapper textarea {
            display: inline-block;
            vertical-align: top;
            margin: 0;
            padding: 10px 15px;
            box-sizing: border-box;
            outline: none;
            font-weight: normal;
            font-size: 14px;
            line-height: 1.5;
            text-decoration: none;
            color: #fff;
            border: 1px solid #ccc;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
        .s-live-setting-wrapper .submit-button {
            background: #fcd630; color: #000; outline: 0; padding: 5px 10px; border: 1px solid rgba(0,0,0,0.3); border-color: rgba(0,0,0,0.2) rgba(0,0,0,0.3) rgba(0,0,0,0.3) rgba(0,0,0,0.3); -webkit-appearance: none; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); border-radius: 3px; text-shadow: 0 1px 0px rgba(255,255,255,0.5);
            background: #fcd630 -moz-linear-gradient(top, rgba(255,255,255,0.5) 0%, rgba(255,255,255,0.0) 100%); /* FF3.6+ */
            background: #fcd630 -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.5)), color-stop(100%,rgba(255,255,255,0.0))); /* Chrome,Safari4+ */
            background: #fcd630 -webkit-linear-gradient(top, rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.0) 100%); /* Chrome10+,Safari5.1+ */
            background: #fcd630 -o-linear-gradient(top, rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.0) 100%); /* Opera 11.10+ */
            background: #fcd630 -ms-linear-gradient(top, rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.0) 100%); /* IE10+ */
            background: #fcd630 linear-gradient(to bottom, rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.0) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fde992', endColorstr='#fcd630',GradientType=0 ); /* IE6-9 */
        }
        .s-live-setting-wrapper .submit-button:hover {
            color: #000 !important;
            background: #fcd630 linear-gradient(to bottom, rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.3) 100%);
        }
        .s-live-setting-wrapper .submit-button:active { background: #f3cd27; text-shadow: none; box-shadow: none; }
        .s-save-message { display:none;color:#6db639;margin-top: 15px; margin-bottom: 15px; }
        .s-live-setting-wrapper select {
            width: 100%;
            padding: 10px 7px;
            box-sizing: border-box;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .s-live-setting-wrapper input[type="radio"],
        .s-live-setting-wrapper input[type="checkbox"] {
            position: relative;
            top: 1px;
        }

        @media (min-width: 1000px) {
            .s-live-setting-wrapper {
                display: block;
            }
        }
        @-moz-keyframes infinity-rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        @-webkit-keyframes infinity-rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        @-o-keyframes infinity-rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        @keyframes infinity-rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    
    <div class="s-live-setting-block">
        <div class="theme-settings-wrapper">
            <div class="s-live-setting-header">Оформление</div>
            <form action="" method="post">
                <?php echo $_smarty_tpl->tpl_vars['wa']->value->csrf();?>

                <?php  $_smarty_tpl->tpl_vars['setting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['setting']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['settings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['setting']->key => $_smarty_tpl->tpl_vars['setting']->value){
$_smarty_tpl->tpl_vars['setting']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['setting']->key;
?>
                    <?php $_smarty_tpl->tpl_vars['show_setting'] = new Smarty_variable(false, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['settings_array'] = new Smarty_variable(array("font_size"=>true,"font_family"=>true,"color_scheme"=>true,"header_scheme"=>true), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['setting']->value['control_type']=='radio'||$_smarty_tpl->tpl_vars['setting']->value['control_type']=='select'||$_smarty_tpl->tpl_vars['setting']->value['control_type']=='image_select'){?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['settings_array']->value[$_smarty_tpl->tpl_vars['name']->value])){?>
                            <?php $_smarty_tpl->tpl_vars['show_setting'] = new Smarty_variable(true, null, 0);?>
                        <?php }?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['show_setting']->value){?>
                        <div class="group-wrapper is-active" id="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
                            <div class="header-block"><?php echo $_smarty_tpl->tpl_vars['setting']->value['name'];?>
</div>
                            <div class="settings-list">
                                <?php if ($_smarty_tpl->tpl_vars['setting']->value['control_type']=='radio'){?>
                                    <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['setting']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                        <?php if (!strstr($_smarty_tpl->tpl_vars['key']->value,'_google_')){?>
                                        <div class="set-item">
                                            <label class="label">
                                                <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['array_name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value[$_smarty_tpl->tpl_vars['name']->value]==$_tmp1){?>checked<?php }?>>
                                                <span class="label-text"><?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
</span>
                                            </label>
                                        </div>
                                        <?php }?>
                                    <?php } ?>
                                <?php }elseif($_smarty_tpl->tpl_vars['setting']->value['control_type']=='select'){?>
                                    <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['setting']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                        <?php if (!strstr($_smarty_tpl->tpl_vars['key']->value,'_google_')){?>
                                        <div class="set-item">
                                            <label class="label">
                                                <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['array_name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value[$_smarty_tpl->tpl_vars['name']->value]==$_tmp2){?>checked<?php }?>>
                                                <span class="label-text"><?php echo $_smarty_tpl->tpl_vars['option']->value;?>
</span>
                                            </label>
                                        </div>
                                        <?php }?>
                                    <?php } ?>
                                <?php }elseif($_smarty_tpl->tpl_vars['setting']->value['control_type']=='image_select'){?>
                                    <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['setting']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['option']->key;
?>

                                        <?php $_smarty_tpl->tpl_vars['is_active'] = new Smarty_variable(($_smarty_tpl->tpl_vars['theme_settings']->value[$_smarty_tpl->tpl_vars['name']->value]==$_smarty_tpl->tpl_vars['key']->value), null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['_prefix'] = new Smarty_variable('', null, 0);?>
                                        <?php if (($_smarty_tpl->tpl_vars['name']->value=="header_scheme")){?>
                                            <?php $_smarty_tpl->tpl_vars['_prefix'] = new Smarty_variable("header_scheme_", null, 0);?>
                                        <?php }?>
                                        <?php if (($_smarty_tpl->tpl_vars['name']->value=="color_scheme")){?>
                                            <?php $_smarty_tpl->tpl_vars['_prefix'] = new Smarty_variable("color_scheme_", null, 0);?>
                                        <?php }?>

                                        <?php $_smarty_tpl->tpl_vars['html_class'] = new Smarty_variable(($_smarty_tpl->tpl_vars['_prefix']->value).(str_replace('img/themesettings/','',str_replace('.png','',$_smarty_tpl->tpl_vars['key']->value))), null, 0);?>

                                        <div class="set-image-item <?php if (!empty($_smarty_tpl->tpl_vars['is_active']->value)){?>is-active<?php }?>" data-value="<?php echo $_smarty_tpl->tpl_vars['html_class']->value;?>
">
                                            <label class="label">
                                                <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['array_name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['is_active']->value)){?>checked<?php }?>>
                                                <img class="image-item" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" alt="">
                                            </label>
                                        </div>

                                    <?php } ?>
                                <?php }?>
                            </div>
                        </div>
                    <?php }?>
                <?php } ?>

                <div class="buttons-wrapper">
                    <div class="s-save-message">Настройки сохранены</div>
                    <a class="submit-button" href="javascript:void(0);" id="save-config-settings-button">Сохранить</a>
                    <i id="submit-animation" class="icon16 loading"></i>
                </div>
            </form>
        </div>
    </div>

    <footer class="s-live-footer-wrapper">Полный список настроек темы дизайна доступен в бекенде Webasyst > <i>приложение</i> > Дизайн.</footer>

    
    <div class="s-live-buttons-wrapper">
        <a id="show-settings-link" class="link-item open-link" href="javascript:void(0);"></a>
        <?php if (!empty($_smarty_tpl->tpl_vars['quick_links']->value)&&count($_smarty_tpl->tpl_vars['quick_links']->value)){?>
            <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quick_links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
                <a class="link-item edit-link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value['href'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['link']->value['name'];?>
"></a>
            <?php } ?>
        <?php }?>
    </div>

    
    <script>
        ( function($) {

            
            var ThemeSettingsHref = "<?php echo $_smarty_tpl->tpl_vars['wa_backend_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['wa_app']->value;?>
/?module=design&theme=default&action=themeSettings",
                current_color_scheme = ( "<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['color_scheme']){?><?php echo $_smarty_tpl->tpl_vars['_color_scheme_class']->value;?>
<?php }?>" || false),
                current_font_family = ( "<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['font_family']){?><?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['font_family'];?>
<?php }?>" || false),
                current_font_size = ( "<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['font_size']){?><?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['font_size'];?>
<?php }?>" || false);

            var storage = {
                activeWrapperClass: "is-shown",
                activeGroupClass: "is-active",
                activeClass: "is-active",
                showClass: "is-shown",
                $activeColor: $("#color_scheme .set-image-item.is-active"),
                $activeHeader: $("#header_scheme .set-image-item.is-active"),
                settings: {
                    "color-scheme": current_color_scheme,
                    "font-family": current_font_family,
                    "font-size" : current_font_size
                },
                getWrapper: function() {
                    return $("#s-live-setting-wrapper");
                },
                getSettingsBlock: function() {
                    return this.getWrapper().find(".s-live-setting-block");
                },
                getFooter: function() {
                    return this.getWrapper().find(".s-live-footer-wrapper");
                }
            };

            var bindEvents = function() {
                var $wrapper = storage.getWrapper(),
                    $showLink = $("#show-settings-link");

                $showLink.on("click", function() {
                    toggleWrapper( $wrapper );
                });

                $wrapper.find(".s-live-setting-block").on("click", ".header-block", function() {
                    var $group = $(this).closest(".group-wrapper");
                    //
                    toggleGroup( $group );
                    //
                    footerToggle();
                });

                $wrapper.find(".s-live-setting-header").on("click", function() {
                    $showLink.trigger("click");
                });

                $("#font_size").on("click", "input[type=\"radio\"]", function() {
                    onSettingChange( $(this), "font-size" );
                });

                $("#font_family").on("click", "input[type=\"radio\"]", function() {
                    onSettingChange( $(this), "font-family" );
                });

                $("#color_scheme").on("click", "label", function(event) {
                    var $input = $(this).find("input[type=\"radio\"]");
                    $input.attr("checked",true);
                    onColorSchemeChange( $input, "color-scheme" );
                    event.preventDefault();
                });

                $("#header_scheme").on("click", "label", function(event) {
                    var $input = $(this).find("input[type=\"radio\"]");
                    $input.attr("checked",true);
                    onHeaderSchemeChange( $input );
                    event.preventDefault();
                });

                $("#save-config-settings-button").on("click", function() {
                    saveConfigSettings( $(this).closest("form") , ThemeSettingsHref);
                });
            };

            var footerToggle = function() {
                var $wrapper = storage.getWrapper(),
                    $settings = storage.getSettingsBlock(),
                    $footer = storage.getFooter(),
                    wrapper_height = $wrapper.outerHeight(),
                    settings_height = $settings.outerHeight(),
                    footer_height = $footer.outerHeight();

                var show_footer = (wrapper_height - settings_height > footer_height);

                if (show_footer) {
                    $footer.addClass(storage.showClass);
                } else {
                    $footer.removeClass(storage.showClass);
                }
            };

            var onColorSchemeChange = function( $input, widget_name ) {
                var $html = $("html"),
                    $imageItem = $input.closest(".set-image-item"),
                    new_html_class = $imageItem.data("value"),
                    current_body_class = storage.settings[widget_name];

                // Remove old Class
                if (current_body_class) {
                    $html.removeClass(current_body_class);
                }

                // Add New Class
                $html.addClass(new_html_class);

                // Clear Old Item
                var $activeColor = storage.$activeColor;
                if ($activeColor && $activeColor.length) {
                    $activeColor.removeClass(storage.activeClass);
                }

                // Marking Item
                $imageItem.addClass(storage.activeClass);
                storage.$activeColor = $imageItem;

                // Update widget settings
                storage.settings[widget_name] = new_html_class;
            };

            var onHeaderSchemeChange = function( $input ) {
                var $imageItem = $input.closest(".set-image-item"),
                    new_html_class = $imageItem.data("value"),
                    $header = $("#globalnav"),
                    activeClass = "light";

                if (new_html_class == "header_scheme_white") {
                    $header.addClass(activeClass);

                } else if (new_html_class == "header_scheme_black") {
                    $header.removeClass(activeClass);
                }

                // Clear Old Item
                var $activeColor = storage.$activeHeader;
                if ($activeColor && $activeColor.length) {
                    $activeColor.removeClass(storage.activeClass);
                }

                // Marking Item
                $imageItem.addClass(storage.activeClass);
                storage.$activeHeader = $imageItem;
            };

            var onSettingChange = function($element, widget_name) {
                var $html = $("html"),
                    old_class = storage.settings[widget_name],
                    new_class = $element.val();

                if (old_class) {
                    $html.removeClass(old_class);
                }
                // Add New Class
                $html.addClass(new_class);

                // Update widget settings
                storage.settings[widget_name] = new_class;
            };

            var saveConfigSettings = function( $form, href ) {
                var $deferred = $.Deferred(),
                    $button_wrapper = $form.find(".buttons-wrapper"),
                    $save_message = $form.find(".s-save-message");

                // Loading Animation
                animationIconToggle($button_wrapper);

                $.post( href, $form.serializeArray(), function(request) {
                    $deferred.resolve(request);
                });

                $deferred.done( function(request) {
                    // Remove animation
                    animationIconToggle($button_wrapper);

                    $save_message.show();
                    setTimeout( function() {
                        $save_message.hide();
                        // Hide
                        $("#show-settings-link").trigger("click");
                    }, 3000);

                });

            };

            // Loading Animation
            var animationIconToggle = function( $button_wrapper ) {
                var loading_class = "is-loading";
                $button_wrapper.toggleClass(loading_class);
            };

            var toggleWrapper = function( $wrapper ) {
                $wrapper.toggleClass(storage.activeWrapperClass);
            };

            var toggleGroup = function( $group ) {
                $group.toggleClass(storage.activeGroupClass);
            };

            $(document).ready( function() {
                //
                footerToggle();
                //
                bindEvents();
            });

        })(jQuery);
    </script>
</aside>

<?php }?>
<?php }} ?>