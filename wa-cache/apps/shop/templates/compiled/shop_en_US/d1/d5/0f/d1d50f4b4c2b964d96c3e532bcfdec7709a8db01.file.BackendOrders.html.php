<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:13
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/backend/BackendOrders.html" */ ?>
<?php /*%%SmartyHeaderCode:9261781225f980759d8a311-80953273%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1d50f4b4c2b964d96c3e532bcfdec7709a8db01' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/backend/BackendOrders.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9261781225f980759d8a311-80953273',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa_url' => 0,
    'wa_app_static_url' => 0,
    'wa' => 0,
    'embedded_version' => 0,
    'pending_count' => 0,
    'state_counters' => 0,
    'backend_orders' => 0,
    '_' => 0,
    'all_count' => 0,
    'unsettled_count' => 0,
    'states' => 0,
    'id' => 0,
    'state' => 0,
    'couriers' => 0,
    'courier' => 0,
    'sales_channels' => 0,
    'channel' => 0,
    'channel_id' => 0,
    'wa_app_url' => 0,
    'template_content' => 0,
    'template' => 0,
    'default_view' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075a167da5_34979255',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075a167da5_34979255')) {function content_5f98075a167da5_34979255($_smarty_tpl) {?><?php if (!is_callable('smarty_block_wa_js')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/block.wa_js.php';
if (!is_callable('smarty_modifier_replace')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.replace.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array('file'=>"js/order/order.min.js")); $_block_repeat=true; echo smarty_block_wa_js(array('file'=>"js/order/order.min.js"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery-tooltip/jquery.tooltip.patched.min.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/order/timepicker/jquery.timepicker.min.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/tmpl.min.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/lazy.load.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/orders.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/order/list.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/order/edit.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/form/customer/backend.js
<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/order/form/customer.js
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array('file'=>"js/order/order.min.js"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<link href="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/order/timepicker/jquery.timepicker.css?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
" rel="stylesheet" type="text/css" />

<?php if (0&&empty($_smarty_tpl->tpl_vars['embedded_version']->value)){?>
<div class="s-alert s-orders-mobile-notice" id="s-orders-mobile-notice" data-alert="mobile-app">
    <div class="t-layout">
        <div class="t-column">

            <h3>Get instant updates on your mobile device</h3>
            <a href="https://www.shop-script.com/mobile/">Mobile app</a> will help you to conveniently track sales, process orders, and manage products right on your iOS or Android-powered smartphone.

        </div>
        <div class="t-column right">

            <a href="https://itunes.apple.com/us/app/shop-script/id1108957302?mt=8" class="s-mobile-store">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/img/badge-appstore-en.png">
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.shop_script" class="s-mobile-store">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/img/badge-google-play-en.png">
            </a>

        </div>
    </div>
    <a class="close s-alert-close" href="javascript:void(0);">&times;</a>
</div>
<?php }?>

<?php if (empty($_smarty_tpl->tpl_vars['embedded_version']->value)){?>
<div class="sidebar left200px s-inner-sidebar" id="s-sidebar">
    <div class="block">
        <ul class="menu-v with-icons">
            <li class="bottom-padded">
                <a href="#/orders/new/" class="bold"><i class="icon16 add"></i>New order</a>
            </li>
            <li id="s-pending-orders" class="list">
                <span class="count"><?php if (!empty($_smarty_tpl->tpl_vars['pending_count']->value)){?><?php echo $_smarty_tpl->tpl_vars['pending_count']->value;?>
<?php }?></span>
                <a href="#/orders/state_id=new|processing|auth|paid">
                    <i class="icon16 ss orders-processing"></i>Processing
                    <strong class="highlighted small"><?php if (!empty($_smarty_tpl->tpl_vars['state_counters']->value['new'])){?>+<?php echo $_smarty_tpl->tpl_vars['state_counters']->value['new'];?>
<?php }?></strong>
                </a>
            </li>

            <!-- plugin hook: 'backend_orders.sidebar_top_li' -->
            
            <?php if (!empty($_smarty_tpl->tpl_vars['backend_orders']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_orders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['sidebar_top_li']);?>
<?php } ?><?php }?>

            <li id="s-all-orders" class="list">
                <span class="count"><?php if (!empty($_smarty_tpl->tpl_vars['all_count']->value)){?><?php echo $_smarty_tpl->tpl_vars['all_count']->value;?>
<?php }?></span>
                <a href="#/orders/all/">
                    <i class="icon16 ss orders-all"></i>All orders
                </a>
            </li>
            <?php if (!empty($_smarty_tpl->tpl_vars['unsettled_count']->value)){?>
                <li id="s-unsettled-orders" class="list" style="opacity: 0.6;">
                    <span class="count"><?php if (!empty($_smarty_tpl->tpl_vars['unsettled_count']->value)){?><?php echo $_smarty_tpl->tpl_vars['unsettled_count']->value;?>
<?php }?></span>
                    <a href="#/orders/unsettled=1">
                        <i class="icon16 ss flag-purple"></i>Unsettled
                        <strong class="highlighted small"></strong>
                    </a>
                </li>
            <?php }?>

        </ul>
    </div>

    <!-- plugin hook: 'backend_orders.sidebar_section' -->
    
    <?php if (!empty($_smarty_tpl->tpl_vars['backend_orders']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_orders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['sidebar_section']);?>
<?php } ?><?php }?>

    <div class="block">
        <h5 class="heading">Order states</h5>
        <ul class="menu-v with-icons collapsible">

            <?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['states']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value){
$_smarty_tpl->tpl_vars['state']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['state']->key;
?>
                <li data-state-id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="list">
                    <span class="count"><?php if (isset($_smarty_tpl->tpl_vars['state_counters']->value[$_smarty_tpl->tpl_vars['id']->value])){?><?php echo $_smarty_tpl->tpl_vars['state_counters']->value[$_smarty_tpl->tpl_vars['id']->value];?>
<?php }else{ ?>0<?php }?></span>
                    <a href="#/orders/state_id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/" style="<?php echo $_smarty_tpl->tpl_vars['state']->value->getStyle();?>
">
                        <i class="<?php echo $_smarty_tpl->tpl_vars['state']->value->getOption('icon');?>
"></i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value->getName(), ENT_QUOTES, 'UTF-8', true);?>

                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <?php if (!empty($_smarty_tpl->tpl_vars['couriers']->value)){?>
        <div class="block">
            <h5 class="heading collapse-handler">
                Couriers
            </h5>
            <ul class="menu-v collapsible with-icons">
                <?php  $_smarty_tpl->tpl_vars['courier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['courier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['couriers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['courier']->key => $_smarty_tpl->tpl_vars['courier']->value){
$_smarty_tpl->tpl_vars['courier']->_loop = true;
?>
                    <li data-courier-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['courier']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" class="list">
                        <span class="count"><?php echo $_smarty_tpl->tpl_vars['courier']->value['count'];?>
</span>
                        <a href="#/orders/search/params.courier_id=<?php echo $_smarty_tpl->tpl_vars['courier']->value['id'];?>
/">
                            <?php if ($_smarty_tpl->tpl_vars['courier']->value['contact_id']){?>
                                <i class="icon16 userpic20" style="background-image: url(<?php echo waContact::getPhotoUrl($_smarty_tpl->tpl_vars['courier']->value['contact_id'],$_smarty_tpl->tpl_vars['courier']->value['photo'],40);?>
)"></i>
                            <?php }else{ ?>
                                <i class="icon16 ss courier"></i>
                            <?php }?>
                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['courier']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['sales_channels']->value)){?>
        <div class="block">
            <h5 class="heading collapse-handler">
                Sales channels
            </h5>
            <ul class="menu-v collapsible s-storefronts-filter">
                <?php  $_smarty_tpl->tpl_vars['channel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['channel']->_loop = false;
 $_smarty_tpl->tpl_vars['channel_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sales_channels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['channel']->key => $_smarty_tpl->tpl_vars['channel']->value){
$_smarty_tpl->tpl_vars['channel']->_loop = true;
 $_smarty_tpl->tpl_vars['channel_id']->value = $_smarty_tpl->tpl_vars['channel']->key;
?>
                    <li data-storefront="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channel']->value['storefront'], ENT_QUOTES, 'UTF-8', true);?>
" data-sales-channel="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channel_id']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="list">
                        <span class="count"><?php echo $_smarty_tpl->tpl_vars['channel']->value['count'];?>
</span>
                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channel']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channel']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php }?>


    <div class="block">
        <ul class="menu-v with-icons">
            <!-- plugin hook: 'backend_orders.sidebar_bottom_li' -->
            
            <?php if (!empty($_smarty_tpl->tpl_vars['backend_orders']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_orders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['sidebar_bottom_li']);?>
<?php } ?><?php }?>

        </ul>
    </div>

    <div class="align-center hr" style="padding: 20px 0;">
        <p class="hint"><?php echo sprintf('To set up <em>discount coupons</em>, please open “%s” section.',"<a href='".((string)$_smarty_tpl->tpl_vars['wa_app_url']->value)."marketing/'>Marketing</a>");?>
</p>
    </div>
</div>
<?php }?>

<?php if (empty($_smarty_tpl->tpl_vars['embedded_version']->value)){?>
<div class="content left200px blank" id="s-content" style="padding-left: 10px;">
    <div class="block double-padded">
        Loading <i class="icon16 loading"></i>
    </div>
</div>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("template-order-product-img", null, null); ob_start(); ?>

    {% if(o.url){ %}<img src="{%#o.url%}">{% } else { %}<img src="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
img/image-dummy-small.png" class="not-found" style="width: 48px; height: 48px;">{% } %}

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("template-order", null, null); ob_start(); ?>

    {% var options = o.options || {}; %}
    {% var product = o.data.product; %}
    {% var sku_ids = o.data.sku_ids; %}
    {% var index = options.index || '0'; %}
    {% var sku_count = $.shop.helper.size(product.skus); %}
    {% var chosen_sku_id = product.sku_id; %}
    {% var currency = options.currency; %}
    {% var stocks = o.options.stocks || {}; %}
    <tr data-product-id="{%#product.id%}" data-index={%#index%} class="s-order-item">
        <td class="min-width valign-top">{% include('template-order-product-img', { url: product.url_crop_small }); %}</td>
        <td>
            <strong class="large">{%=product.name%}</strong>
            <span class="gray">{%#product.price_html%}</span>

            {% if (sku_count == 1) { %}
                {% if (product.compare_price && product.compare_price > 0) { %}
                        <span class="hint compare-price">(<span style="text-decoration: line-through">{%=Number(Math.round((product.compare_price)*100)/100) %}</span> {%#currency%})</span>
                {% } %}
            {% } %}

            {% if (sku_count == 1) { %}
            <span class="s-orders-stock-icon-aggregate">
                    {%#product.icon%}
                </span>
            <span class="s-orders-stock-icon"></span>
            {% } else { %}
                {%#product.icon%}
            {% } %}

            <p>
                {% if (sku_count > 1) { %}
                    <ul class="menu-v compact small s-orders-skus">
                        {% var sku_id, sku_id_iterator = $.shop.iterator(sku_ids); %}
                        {% while (sku_id = sku_id_iterator.next()) { %}
                            {% var sku = product.skus[sku_id]; %}
                            {% var checked = sku.checked; %}
                            {% if (checked) { %}
                                {% chosen_sku_id = sku_id; %}
                            {% } %}
                            <li>
                                <label>

                                    <input type="radio"
                                           name="sku[add][{%#index%}]"
                                           value="{%#sku_id%}"
                                           {% if (checked) { %} checked="checked" {% } %}>

                                    {%=sku.name%}

                                    {% if (sku.sku) { %}
                                        <span class="gray">{%=sku.sku%}</span>
                                    {% } %}

                                    <strong>{%#sku.price_html%}</strong>

                                    {% if (sku.compare_price && sku.compare_price > 0) { %}
                                        <span class="hint compare-price">(<span style="text-decoration: line-through">{%=Number(Math.round((sku.compare_price)*100)/100)%}</span> {%#currency%})</span>
                                    {% } %}

                                    <span class="s-orders-stock-icon-aggregate">
                                        {%#sku.icon%}
                                    </span>
                                    <span class="s-orders-stock-icon" style="display:none;"></span>
                                    <div class="s-orders-sku-stock-place">
                                        {% if (checked) { %}
                                            {% include('template-order-stocks-add', { sku: sku, stocks: stocks, index: index }); %}
                                        {% } %}
                                    </div>
                                </label>
                            </li>
                        {% } %}
                    </ul>
                {% } else { %}

                    {% var sku = product.skus[product.sku_id]; %}
                    {% if ( sku && !sku.fake && (typeof sku.sku === 'string' && sku.sku.length > 0) ) { %}
                        <span class="hint">{%=sku.sku%}</span>
                    {% } %}

                    <div class="s-orders-sku-stock-place">
                        {% include('template-order-stocks-add', { sku: product.skus[product.sku_id], stocks: stocks, index: index }); %}
                    </div>
                    <input type="hidden" name="sku[add][{%#index%}]" value="{%#product.sku_id%}">
                {% } %}
            </p>

            {% if (!$.isEmptyObject(product.services)) { %}
            <p>{% include('template-order-services-add', {
                services: product.services,
                service_ids: o.data.service_ids,
                options: options
                }); %}</p>
            {% } %}
        </td>
        <input type="hidden" name="product[add][{%#index%}]" value="{%#product.id%}">
        <td class="valign-top nowrap{% if (options.price_edit) { %} align-right{% } %}">
            <span style="padding-top: 2px;" class="gray">&times;</span>
            <input type="text"
                   name="quantity[add][{%#index%}][product]"
                   class="s-orders-quantity short numerical"
                   value="1"
            >
        </td>

        <td class="valign-top align-right s-orders-product-price">
            {% if (!options.price_edit) { %}
            <span>{%#product.skus[chosen_sku_id].price_html%}</span>
            <input type="hidden" name="price[add][{%#index%}][product]" value="{%#''+product.skus[chosen_sku_id].price%}" class="short">
            {% } else { %}
            <input type="text" name="price[add][{%#index%}][product]" value="{%#''+product.skus[chosen_sku_id].price%}" class="short js-order-edit-item-price">
            <span style="padding-top: 2px;">{%#currency%}</span>
            {% } %}
            <br/><span class="hint js-item-total-discount" data-discount-id="{%#index%}"></span>
        </td>
        <td class="valign-top min-width"><a href="#" class="s-order-item-delete"><i class="icon16 delete"></i></a></td>
    </tr>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php $_smarty_tpl->_capture_stack[0][] = array("template-order-stocks-edit", null, null); ob_start(); ?>

    {% var sku = o.sku; %}
    {% var stocks = o.stocks; %}
    {% var item_id = o.item_id; %}
    {% if (sku && !$.isEmptyObject(sku.stock)) { %}
    <select name="stock[edit][{%#item_id%}]" class="s-orders-sku-stock-select">
        {% for (var i = 0; i < stocks.length; i += 1) { %}
        {% var stock_id = stocks[i].id; %}
        <option value="{%#stock_id%}" data-icon="{%#''+sku.icons[stock_id]%}">
            @{%=stocks[i].name%} ({%#sku.count_htmls[stock_id]%})
        </option>
        {% } %}
    </select>
    <em class="errormsg s-error-item-stock_id"></em>
    {% } else { %}
    <input type="hidden" name="stock[edit][{%#item_id%}]" value="0">
    {% } %}

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php $_smarty_tpl->_capture_stack[0][] = array("template-order-stocks-add", null, null); ob_start(); ?>

    {% var sku = o.sku; %}
    {% var stocks = o.stocks; %}
    {% var index = o.index; %}

    {% if (sku && !$.isEmptyObject(sku.stock)) { %}
    <select name="stock[add][{%#index%}][product]" class="s-orders-sku-stock-select">
        {% for (var i = 0; i < stocks.length; i += 1) { %}
        {% var stock_id = stocks[i].id; %}
        <option value="{%#stocks[i].id%}" data-icon="{%#''+sku.icons[stock_id]%}">
            @{%= stocks[i].name%} ({%#sku.count_htmls[stock_id]%})
        </option>
        {% } %}
    </select>
    <em class="errormsg s-error-item-stock_id"></em>
    {% } else { %}
    <input type="hidden" name="stock[add][{%#index%}][product]" value="0">
    {% } %}


<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php $_smarty_tpl->_capture_stack[0][] = array("template-order-services-add", null, null); ob_start(); ?>

    <ul class="menu-v compact small s-orders-services">
    {% var options = o.options || {}; %}
    {% var index = options.index || '0'; %}
    {% var currency = options.currency; %}
    {% var services = o.services; %}
    {% var service_ids = o.service_ids; %}
    {% for (var i = 0, n = service_ids.length; i < n; i += 1) { %}
    {% var service_id = service_ids[i]; %}
    {% var service = services[service_id]; %}
    {% var multi_variants = $.shop.helper.size(service.variants) > 1; %}
    <li>
    <label>
        <input type="checkbox" name="service[add][{%#index%}][]" value="{%#service_id%}"
               {% if (service.checked) { %}checked="checked"{% } %}>
        {%=service.name%}
        {% if (!multi_variants) { %}
        <strong>{%#service.variants[service.variant_id].price_html%}</strong>
        {% } %}
    </label>
    {% if (multi_variants) { %}
    <select name="variant[add][{%#index%}][{%#service_id%}]" class="s-orders-service-variant">
    {% for (var variant_id in service.variants) { %}
    {% var variant = service.variants[variant_id]; %}
    <option value="{%#variant.id%}" data-price="{%#''+variant.price%}"
    data-currency="{%#variant.currency%}"
    data-price="{%#variant.price%}"
    {% if (service.currency === $.order_edit.getPercentSymbol()) { %}data-percent-price="{%#variant.percent_price%}"{% } %}
    {% if (variant.status == <?php echo shopProductServicesModel::STATUS_DEFAULT;?>
) { %}selected="selected"{% } %}>
    {%=variant.name%} ({%#variant.price_str%})
    </option>
    {% } %}
    </select>
    {% } else { %}
    <input type="hidden" name="variant[add][{%#index%}][{%#service_id%}]" value="{%#service.variant_id%}">
    {% } %}
    <input type="text" name="price[add][{%#index%}][service][{%#service_id%}]" value="{%#''+service.price%}"
           data-currency="{%#service.currency%}"
           data-price="{%#service.price%}"
           {% if (service.currency === $.order_edit.getPercentSymbol()) { %}data-percent-price="{%#service.percent_price%}"{% } %}
           class="short s-orders-service-price" >{%#currency%}
    <br/><span class="hint js-item-total-discount" data-discount-id="{%#index%}_{%#service_id%}"></span>
    </li>
    {% } %}
    </ul>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("template-order-services-edit", null, null); ob_start(); ?>

    <ul class="menu-v compact small s-orders-services">
    {% var options = o.options || {}; %}
    {% var index = options.index || '0'; %}
    {% var currency = options.currency; %}
    {% var services = o.services; %}
    {% var service_ids = o.service_ids; %}
    {% for (var i = 0, n = service_ids.length; i < n; i += 1) { %}
    {% var service_id = service_ids[i]; %}
    {% var service = services[service_id]; %}
    {% var multi_variants = $.shop.helper.size(service.variants) > 1; %}
    <li>
    <label>
        <input type="checkbox" name="service[edit][{%#index%}][new][{%#service_id%}]" value="{%#service_id%}"
               {% if (service.checked) { %}checked="checked"{% } %}>
        {%=service.name%}
        {% if (!multi_variants) { %}
        <strong>{%#service.variants[service.variant_id].price_html%}</strong>
        {% } %}
    </label>
    {% if (multi_variants) { %}
    <select name="variant[edit][{%#index%}][{%#service_id%}]" class="s-orders-service-variant">
    {% for (var variant_id in service.variants) { %}
    {% var variant = service.variants[variant_id]; %}
    <option value="{%#variant.id%}" data-price="{%#''+variant.price%}"
    data-currency="{%#variant.currency%}"
    data-price="{%#variant.price%}"
    {% if (service.currency === $.order_edit.getPercentSymbol()) { %}data-percent-price="{%#variant.percent_price%}"{% } %}
    {% if (variant.status == <?php echo shopProductServicesModel::STATUS_DEFAULT;?>
) { %}selected="selected"{% } %}>
    {%=variant.name%} ({%#variant.price_str%})
    </option>
    {% } %}
    </select>
    {% } else { %}
    <input type="hidden" name="variant[edit][{%#index%}][{%#service_id%}]" value="{%#service.variant_id%}">
    {% } %}
    <input type="text" name="price[edit][new][{%#index%}][{%#service_id%}]" value="{%#''+service.price%}"
           data-currency="{%#service.currency%}"
           data-price="{%#service.price%}"
           {% if (service.currency === $.order_edit.getPercentSymbol()) { %}data-percent-price="{%#service.percent_price%}"{% } %}
           class="short s-orders-service-price" >{%#currency%}
    <br/><span class="hint js-item-total-discount" data-discount-id="{%#index%}_{%#service_id%}"></span>
    </li>
    {% } %}
    </ul>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>



<?php  $_smarty_tpl->tpl_vars['template_content'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['template_content']->_loop = false;
 $_smarty_tpl->tpl_vars['template'] = new Smarty_Variable;
 $_from = Smarty::$_smarty_vars['capture']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['template_content']->key => $_smarty_tpl->tpl_vars['template_content']->value){
$_smarty_tpl->tpl_vars['template_content']->_loop = true;
 $_smarty_tpl->tpl_vars['template']->value = $_smarty_tpl->tpl_vars['template_content']->key;
?>
    <?php if ($_smarty_tpl->tpl_vars['template_content']->value&&(strpos($_smarty_tpl->tpl_vars['template']->value,'template-')===0)){?>
        <script id="<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
" type="text/html">
            <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['template_content']->value,'</','<\/');?>

        </script>
        <?php $_smarty_tpl->_capture_stack[0][] = array($_smarty_tpl->tpl_vars['template']->value, null, null); ob_start(); ?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php }?>
<?php } ?>

<?php if (empty($_smarty_tpl->tpl_vars['embedded_version']->value)){?>
<script>
    $(function() {
        if ($.wa_push) {
            $.wa_push.init();
        }

        $.orders.init({
            view: '<?php echo $_smarty_tpl->tpl_vars['default_view']->value;?>
'
        });
    });
</script>
<?php }?>
<?php }} ?>