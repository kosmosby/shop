<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:14
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/layouts/Backend.html" */ ?>
<?php /*%%SmartyHeaderCode:15818308975f98075a1cb372-75664935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aca8099cb15ceb51d341322e48aab20a012f6698' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/layouts/Backend.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15818308975f98075a1cb372-75664935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'title' => 0,
    'wa_url' => 0,
    'wa_app_static_url' => 0,
    'wa_app_url' => 0,
    'page' => 0,
    'no_level2' => 0,
    'embedded_version' => 0,
    'rightmost_li_margin' => 0,
    'backend_menu' => 0,
    '_' => 0,
    'tutorial_visible' => 0,
    'tutorial_progress' => 0,
    'new_orders_count' => 0,
    'frontend_url' => 0,
    'need_checkout_flow_section' => 0,
    'backend_reports' => 0,
    'backend_orders' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075a580315_37569653',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075a580315_37569653')) {function content_5f98075a580315_37569653($_smarty_tpl) {?><?php if (!is_callable('smarty_block_wa_js')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/block.wa_js.php';
?><!DOCTYPE html><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->title(), null, 0);?>
    <title><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['wa']->value->appName() : $tmp);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName(false);?>
<?php $_tmp2=ob_get_clean();?><?php echo htmlspecialchars(($_tmp1).(" — ").($_tmp2), ENT_QUOTES, 'UTF-8', true);?>
</title>

    <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>


    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/css/jquery-ui/base/jquery.ui.autocomplete.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/jquery.jqplot.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/ibutton/jquery.ibutton.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
css/shop.css?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
" rel="stylesheet" type="text/css" />
    <!-- link your CSS files here -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-1.11.1.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-migrate-1.2.1.min.js"></script>

    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/jquery.jqplot.min.js"></script>
    <!--[if lt IE 9]><script language="javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/excanvas.min.js"></script><![endif]-->
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array('file'=>"js/shop-jquery.min.js")); $_block_repeat=true; echo smarty_block_wa_js(array('file'=>"js/shop-jquery.min.js"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.core.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.dialog.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/ibutton/jquery.ibutton.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.history.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.store.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.core.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.widget.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.mouse.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.position.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.autocomplete.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.draggable.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.droppable.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.sortable.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.datepicker.min.js

        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.tmpl.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.retina.js

        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/plugins/jqplot.highlighter.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/plugins/jqplot.cursor.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/plugins/jqplot.dateAxisRenderer.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-plot/plugins/jqplot.pieRenderer.min.js
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array('file'=>"js/shop-jquery.min.js"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php if (is_readable("wa-content/js/jquery-ui/i18n/jquery.ui.datepicker-".((string)$_smarty_tpl->tpl_vars['wa']->value->locale()).".js")){?>
        <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/i18n/jquery.ui.datepicker-<?php echo $_smarty_tpl->tpl_vars['wa']->value->locale();?>
.js"></script>
    <?php }?>
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/shop.js?<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=loc&amp;v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
"></script>
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->js();?>

     

    <!-- link your JS files here -->
    <script>
        var menu_floating = true;
        <?php if (in_array($_smarty_tpl->tpl_vars['page']->value,array('settings','importexport','plugins','storefronts','tutorial:default'))){?>
            menu_floating = false;
        <?php }?>
        $(function() {
            $.shop.init({
                jquery_url: "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-1.11.1.min.js",
                debug: <?php echo var_export(waSystemConfig::isDebug(),true);?>
,
                menu_floating: menu_floating,
                page: '<?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
<?php }else{ ?>orders<?php }?>'
            });
        });
    </script>

</head>
<body>
<div id="wa"<?php if (isset($_smarty_tpl->tpl_vars['no_level2']->value)){?> class="s-no-level2"<?php }?>>

    <?php if (empty($_smarty_tpl->tpl_vars['embedded_version']->value)){?>
        <?php echo $_smarty_tpl->tpl_vars['wa']->value->header();?>

    <?php }?>

    <div id="wa-app">

        <?php if (empty($_smarty_tpl->tpl_vars['embedded_version']->value)){?>
        <div id="mainmenu"><ul class="tabs"><?php $_smarty_tpl->tpl_vars['rightmost_li_margin'] = new Smarty_variable(' style="margin-right: 30px;"', null, 0);?><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('settings')){?><li class="small float-right<?php if ($_smarty_tpl->tpl_vars['page']->value=='plugins'){?> selected<?php }else{ ?> no-tab<?php }?>"<?php echo $_smarty_tpl->tpl_vars['rightmost_li_margin']->value;?>
><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=plugins">Plugins</a></li><li class="small float-right<?php if ($_smarty_tpl->tpl_vars['page']->value=='settings'){?> selected<?php }else{ ?> no-tab<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=settings">Settings</a></li><?php $_smarty_tpl->tpl_vars['rightmost_li_margin'] = new Smarty_variable('', null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('importexport')){?><li class="small float-right<?php if ($_smarty_tpl->tpl_vars['page']->value=='importexport'){?> selected<?php }else{ ?> no-tab<?php }?>"<?php echo $_smarty_tpl->tpl_vars['rightmost_li_margin']->value;?>
><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=importexport">Import / Export</a></li><?php $_smarty_tpl->tpl_vars['rightmost_li_margin'] = new Smarty_variable('', null, 0);?><?php }?><!-- plugin hook: 'backend_menu.aux_li' --><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['aux_li']);?>
<?php } ?><?php if ($_smarty_tpl->tpl_vars['tutorial_visible']->value){?><li class="s-tutorial-qs-lnk" id="js-menu-tutorial-item"><div class="s-tutorial-quick-start"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?module=tutorial#/products/" class="s-tutorial-url js-tutorial-url"><div class="s-tutorial-progressbar" id="s-tutorial-progressbar"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
img/rocket-fly.png" class="s-rocket"/><span class="s-tutorial-step-title" style="display: inline-block;">Quick start</span><div class="s-tutorial-progressbar-outer"><div class="s-tutorial-progressbar-inner"></div><span class="s-tutorial-steps" id="s-tutorial-progressbar-content"><span class="js-step-count"><?php echo $_smarty_tpl->tpl_vars['tutorial_progress']->value['complete'];?>
</span> of <?php echo $_smarty_tpl->tpl_vars['tutorial_progress']->value['total'];?>
</span></div></div></a></div></li><?php if ($_smarty_tpl->tpl_vars['tutorial_progress']->value['complete']>0){?><!-- Set tutorial Back link  --><script>$(function() {var step_link = localStorage.getItem('tutorial_step_link');if (step_link) {$('.js-tutorial-url').attr('href', step_link);}});</script><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('orders')){?><li class="<?php if (!$_smarty_tpl->tpl_vars['page']->value||$_smarty_tpl->tpl_vars['page']->value=='orders'){?>selected<?php }else{ ?>no-tab<?php }?>" id="mainmenu-orders-tab"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=orders#/orders/">Orders<sup class="red" <?php if ($_smarty_tpl->tpl_vars['page']->value!='orders'&&!empty($_smarty_tpl->tpl_vars['new_orders_count']->value)){?>style="display:inline"<?php }?>><?php if (!empty($_smarty_tpl->tpl_vars['new_orders_count']->value)){?><?php echo $_smarty_tpl->tpl_vars['new_orders_count']->value;?>
<?php }?></sup></a></li><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('customers')){?><li class="<?php if ($_smarty_tpl->tpl_vars['page']->value=='customers'){?>selected<?php }else{ ?>no-tab<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=customers">Customers</a></li><?php }?><li class="<?php if ($_smarty_tpl->tpl_vars['page']->value=='products'){?>selected<?php }else{ ?>no-tab<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=products">Products</a></li><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('marketing')){?><li class="<?php if ($_smarty_tpl->tpl_vars['page']->value=='marketing'){?>selected<?php }else{ ?>no-tab<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
marketing/">Marketing</a></li><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('reports')){?><li class="<?php if ($_smarty_tpl->tpl_vars['page']->value=='reports'){?>selected<?php }else{ ?>no-tab<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=reports">Reports</a></li><?php }?><?php if ($_smarty_tpl->tpl_vars['wa']->value->userRights('design')||$_smarty_tpl->tpl_vars['wa']->value->userRights('pages')){?><li class="<?php if ($_smarty_tpl->tpl_vars['page']->value=='storefronts'){?>selected<?php }else{ ?>no-tab<?php }?> s-storefronts-tab"><a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?action=storefronts">Storefront</a></li><?php }?><!-- plugin hook: 'backend_menu.core_li' --><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['core_li']);?>
<?php } ?><li class="no-tab s-hidden-list" id="s-hidden-list" style="display: none;"><ul class="menu-h dropdown"><li class="no-tab"><a class="s-more-link" href="javascript:void(0);">More<i class="icon10 darr"></i></a><ul class="menu-v" style="width: 200px;"></ul></li></ul></li><li class="no-tab s-openstorefront"><a href="<?php echo $_smarty_tpl->tpl_vars['frontend_url']->value;?>
" target="_blank">Open storefront</a></li></ul><?php if (!isset($_smarty_tpl->tpl_vars['no_level2']->value)){?><div class="s-level2"><div class="block bordered-bottom"><?php if ($_smarty_tpl->tpl_vars['page']->value=='products'){?><div class="s-search-form"><i class="icon16 ss search-bw"></i><input type="search" placeholder="Search products" id="s-products-search"></div><?php }elseif($_smarty_tpl->tpl_vars['page']->value=='customers'){?><ul class="menu-h with-icons"><div class="s-search-form"><i class="icon16 ss search-bw"></i><input type="search" placeholder="Search customers" id="s-customers-search"></div></ul><?php }elseif($_smarty_tpl->tpl_vars['page']->value=='reports'){?><div class="float-right"><ul class="menu-h dropdown s-reports-timeframe" style="float: right;"><li class="hidden s-custom-timeframe">from <input type="text" name="from">to <input type="text" name="to"><select name="groupby"><option value="days">by day</option><option value="months">by month</option></select></li><li class="s-reports-timeframe-dropdown"><a href="javascript:void(0)" class="inline-link float-right"><b><i></i></b><i class="icon10 darr"></i></a><ul class="menu-v"><li data-timeframe="30" data-groupby="days" class="selected"><a href="javascript:void(0)" class="nowrap"><?php echo _w('Last %d day','Last %d days',30);?>
</a></li><li data-timeframe="90" data-groupby="days" data-default-choice="1"><a href="javascript:void(0)" class="nowrap"><?php echo _w('Last %d day','Last %d days',90);?>
</a></li><li data-timeframe="365" data-groupby="months"><a href="javascript:void(0)" class="nowrap"><?php echo _w('Last %d day','Last %d days',365);?>
</a></li><li data-timeframe="all" data-groupby="months"><a href="javascript:void(0)" class="nowrap">All time</a></li><li data-timeframe="custom"><a href="javascript:void(0)" class="nowrap">Select dates...</a></li></ul></li></ul><div id="s-reports-custom-controls" class="float-right"></div></div><ul class="menu-h s-reports"><?php if ($_smarty_tpl->tpl_vars['wa']->value->shop->config('reports_simple')){?><li><a href="#/summary/">Sales</a></li><?php }else{ ?><li><a href="#/sales/">Sales</a></li><li><a href="#/customers/">Customers</a></li><li><a href="#/cohorts/">Cohorts</a></li><li><a href="#/products/">Products</a></li><?php }?><?php if ($_smarty_tpl->tpl_vars['need_checkout_flow_section']->value){?><li><a href="#/checkoutflow/">Checkout funnel</a></li><?php }?><!-- plugin hook: 'backend_reports.menu_li' --><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_reports']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['menu_li']);?>
<?php } ?></ul><?php }elseif($_smarty_tpl->tpl_vars['page']->value=='orders'){?><ul class="menu-h float-right" id="s-orders-views"><li data-view="split"><a href="#"title="List"><i class="icon16 view-splitview"></i></a></li><li data-view="table"><a href="#" title="Table"><i class="icon16 view-table"></i></a></li><!-- plugin hook: 'backend_orders.viewmode_li' --><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_orders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['viewmode_li']);?>
<?php } ?></ul><ul class="menu-v dropdown  with-icons float-right s-orders-sort" id="s-orders-sort"><li><a href="javascript:void(0);" class="inline-link s-current-sort" data-sort=""><b><i><span class="f-text"></span></i></b></a><i class="icon10 darr-tiny s-sort-order" style="display: none;" data-order="desc"></i><i class="icon10 uarr-tiny s-sort-order" style="display: none;" data-order="asc"></i><ul class="menu-v with-icon"><li class="s-sort" data-sort="create_datetime"><a href="javascript:void(0);" data-sort="create_datetime">Time created</a></li><li class="s-sort" data-sort="updated"><a href="javascript:void(0);" data-sort="updated">Time updated</a></li><li class="s-sort" data-sort="paid_date"><a href="javascript:void(0);" data-sort="paid_date">Time paid</a></li><li class="s-sort" data-sort="shipping_datetime"><a href="javascript:void(0);" data-sort="shipping_datetime">Shipping time</a></li><li class="s-sort" data-sort="state_id"><a href="javascript:void(0);" data-sort="state_id">Order status</a></li></ul></li></ul><div class="s-search-form"><i class="icon16 ss search-bw"></i><input type="search" placeholder="Search orders" id="s-orders-search"></div><?php }?></div></div><?php }?></div><script>( function($) {$.shop.initElasticMenu({$wrapper: $("#mainmenu")});})(jQuery);</script>
        <?php }?>

        <div id="maincontent"<?php if (isset($_smarty_tpl->tpl_vars['no_level2']->value)){?> class="s-no-level2"<?php }?>>
        
            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

        
        </div>

    </div><!-- #wa-app -->

</div><!-- #wa -->



<div class="dialog width400px height200px" id="s-error-dialog" style="display:none;">
    <div class="dialog-background"></div>
    <div class="dialog-window">
        <div class="dialog-content">
            <div class="dialog-content-indent">
                <h1>An error occurred</h1>
                <p class="f-text"></p>
            </div>
        </div>
        <div class="dialog-buttons">
            <div class="dialog-buttons-gradient">
                <input class="button red cancel" type="button" value="Close">
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php }} ?>