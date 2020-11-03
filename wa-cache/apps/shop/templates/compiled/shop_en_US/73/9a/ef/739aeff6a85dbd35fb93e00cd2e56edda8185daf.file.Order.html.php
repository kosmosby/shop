<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:16
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/order/Order.html" */ ?>
<?php /*%%SmartyHeaderCode:6471729185f98075c139199-16819305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '739aeff6a85dbd35fb93e00cd2e56edda8185daf' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/order/Order.html',
      1 => 1603270274,
      2 => 'file',
    ),
    'c076059f2209a72c1fa08b4ba6ca03a1b88c6eda' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/customers/include.top_fields.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6471729185f98075c139199-16819305',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'actions_html' => 0,
    'h' => 0,
    'filter_params_str' => 0,
    'wa' => 0,
    'backend_order' => 0,
    '_' => 0,
    'last_action_datetime' => 0,
    'buttons' => 0,
    'b' => 0,
    'customer_essentials' => 0,
    'customers_rights' => 0,
    'customer' => 0,
    'main_contact_info' => 0,
    'similar_contacts' => 0,
    'shipping_address' => 0,
    'params' => 0,
    'shipping_address_html' => 0,
    'shipping_custom_fields' => 0,
    'f' => 0,
    'customer_delivery_date' => 0,
    'customer_delivery_time' => 0,
    'customer_delivery_date_str' => 0,
    'shipping_date' => 0,
    '_package' => 0,
    'courier' => 0,
    'available_actions' => 0,
    'edit_shipping_details_available' => 0,
    'shipping_time_start' => 0,
    'shipping_time_end' => 0,
    'tracking' => 0,
    'billing_address' => 0,
    'item' => 0,
    'wa_app_static_url' => 0,
    '_code' => 0,
    'subtotal' => 0,
    'wa_app_url' => 0,
    'bottom_buttons' => 0,
    'log' => 0,
    'row' => 0,
    '_product' => 0,
    '_is_service' => 0,
    'top_buttons' => 0,
    'printable_docs' => 0,
    'printable_doc' => 0,
    'plugin_id' => 0,
    'map' => 0,
    'sales_channel' => 0,
    'wa_url' => 0,
    'count_new' => 0,
    'currency' => 0,
    'offset' => 0,
    'timeout' => 0,
    'filter_params' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075cd32561_17790726',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075cd32561_17790726')) {function content_5f98075cd32561_17790726($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.regex_replace.php';
if (!is_callable('smarty_modifier_wa_date')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/modifier.wa_date.php';
if (!is_callable('smarty_modifier_truncate')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
?><?php if (empty($_smarty_tpl->tpl_vars['order']->value)){?>
    <div class="block double-padded align-center blank">
        <br><br><br><br>
        <span class="gray large">There are no orders in this view.</span>
        <div class="clear-left"></div>
    </div>
<?php }else{ ?>
    <div class="s-order" id="s-order-block" style="visibility: hidden;">
        <?php if (!empty($_smarty_tpl->tpl_vars['actions_html']->value)){?>
            <?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actions_html']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value){
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
                <?php echo $_smarty_tpl->tpl_vars['h']->value;?>

            <?php } ?>
        <?php }?>

        <div class="s-split-order-wrapper block double-padded" id="s-split-order-wrapper">
            <div class="s-split-order-block">
                <div class="s-split-order-content">

                    <!-- order title -->
                    <h1 id="s-order-title">
                        <a href="#/orders/<?php if ($_smarty_tpl->tpl_vars['filter_params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['filter_params_str']->value;?>
&view=table/<?php }?>" class="back order-list" style="display:none;">&larr; Orders</a>
                        <a href="#/order/<?php echo $_smarty_tpl->tpl_vars['order']->value['id'];?>
/<?php if ($_smarty_tpl->tpl_vars['filter_params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['filter_params_str']->value;?>
/<?php }?>" class="back read-mode" style="display:none;">&larr; Back</a>

                        <?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->orderId($_smarty_tpl->tpl_vars['order']->value['id']);?>

                        <i class="icon16 loading" style="display:none"></i>

                        <!-- plugin hook: 'backend_order.title_suffix' -->
                        
                        <?php if (!empty($_smarty_tpl->tpl_vars['backend_order']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_order']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['title_suffix']);?>
<?php } ?><?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['order']->value['state']){?>
                            <span class="small" style="font-size: 16px; margin-left: 10px; position: relative; top: -2px; <?php echo $_smarty_tpl->tpl_vars['order']->value['state']->getStyle();?>
">
                                <i class="<?php echo $_smarty_tpl->tpl_vars['order']->value['state']->getOption('icon');?>
" style="margin-top: 9px;"></i><span style="margin-right: 10px;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['state']->getName(), ENT_QUOTES, 'UTF-8', true);?>
</span>
                                <?php if ($_smarty_tpl->tpl_vars['last_action_datetime']->value){?>
                                    <em class="hint nowrap"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['last_action_datetime']->value,'humandatetime');?>
</em>
                                    <em class="hint nowrap s-print-only"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['last_action_datetime']->value,'datetime');?>
</em>
                                <?php }?>
                            </span>
                        <?php }else{ ?>
                            Unknown state: <?php echo $_smarty_tpl->tpl_vars['order']->value['state_id'];?>

                        <?php }?>

                    </h1>

                    <!-- order action buttons -->
                    <div class="block not-padded s-order-readable">
                        <ul class="menu-h s-order-actions workflow-actions">
                            <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value){
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
                                <li><?php echo $_smarty_tpl->tpl_vars['b']->value;?>
</li>
                            <?php } ?>

                            <!-- plugin hook: 'backend_order.action_button' -->
                            
                            <?php if (!empty($_smarty_tpl->tpl_vars['backend_order']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_order']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php if ((!empty($_smarty_tpl->tpl_vars['_']->value['action_button']))){?><li><?php echo $_smarty_tpl->tpl_vars['_']->value['action_button'];?>
</li><?php }?><?php } ?><?php }?>
                        </ul>
                        <div class="workflow-content" id="workflow-content"></div>
                    </div>

                    <!-- customer info -->
                    <div class="profile image50px">
                        <div class="image">
                            <?php if ((($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['id'])===null||$tmp==='' ? '0' : $tmp)){?>
                                <a href="?action=customers#/id/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['id'])===null||$tmp==='' ? '0' : $tmp);?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['customer_essentials']->value['photo_50x50'];?>
" class="userpic" />
                                </a>
                            <?php }else{ ?>
                                <img src="<?php echo $_smarty_tpl->tpl_vars['customer_essentials']->value['photo_50x50'];?>
" class="userpic" />
                            <?php }?>
                        </div>
                        <div class="details">
                            <?php $_smarty_tpl->tpl_vars['customers_rights'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->userRights('customers'), null, 0);?>
                            <h3>
                                <?php if ($_smarty_tpl->tpl_vars['customers_rights']->value&&(($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['id'])===null||$tmp==='' ? '0' : $tmp)){?>
                                    <a href="?action=customers#/id/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['id'])===null||$tmp==='' ? '0' : $tmp);?>
" <?php if (!htmlspecialchars($_smarty_tpl->tpl_vars['customer_essentials']->value['name'], ENT_QUOTES, 'UTF-8', true)){?> class="gray"<?php }?>>
                                        <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['name'])===null||$tmp==='' ? '(no name)' : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                                    </a>
                                <?php }else{ ?>
                                    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['name'])===null||$tmp==='' ? '(no name)' : $tmp);?>

                                    <?php if (!htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['id'])===null||$tmp==='' ? '0' : $tmp), ENT_QUOTES, 'UTF-8', true)){?> <span class="hint">deleted</span><?php }?>
                                <?php }?>
                                <?php if ((($tmp = @$_smarty_tpl->tpl_vars['customer_essentials']->value['registered'])===null||$tmp==='' ? false : $tmp)){?>
                                    <i class="icon10 lock" title="Registered customer"></i>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['customer']->value['number_of_orders']==1){?>
                                    <em class="hint">New customer</em>
                                <?php }else{ ?>
                                    <em class="hint"><?php echo _w('%d order','%d orders',$_smarty_tpl->tpl_vars['customer']->value['number_of_orders']);?>
</em>
                                <?php }?>
                            </h3>
                            <?php if ($_smarty_tpl->tpl_vars['main_contact_info']->value){?>

                                <?php /*  Call merged included template "./../customers/include.top_fields.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("./../customers/include.top_fields.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('top'=>$_smarty_tpl->tpl_vars['main_contact_info']->value,'similar_contacts'=>$_smarty_tpl->tpl_vars['similar_contacts']->value,'need_other_values'=>true), 0, '6471729185f98075c139199-16819305');
content_5f98075c312eb1_07942671($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "./../customers/include.top_fields.html" */?>

                            <?php }?>
                        </div>
                    </div>

                    <!-- plugin hook: 'backend_order.info_section' -->
                    
                    <?php if (!empty($_smarty_tpl->tpl_vars['backend_order']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_order']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php if ((!empty($_smarty_tpl->tpl_vars['_']->value['info_section']))){?><?php echo $_smarty_tpl->tpl_vars['_']->value['info_section'];?>
<?php }?><?php } ?><?php }?>

                    <div class="clear-right"></div>

                    <?php if (($_smarty_tpl->tpl_vars['shipping_address']->value)||!empty($_smarty_tpl->tpl_vars['params']->value['shipping_name'])){?>
                        <h3><span class="gray">Shipping<?php if (!empty($_smarty_tpl->tpl_vars['params']->value['shipping_name'])){?> —<?php }?></span> <strong><?php echo ifset($_smarty_tpl->tpl_vars['params']->value['shipping_name']);?>
</strong></h3>
                        <?php if ($_smarty_tpl->tpl_vars['shipping_address']->value){?>
                            <p class="s-order-address">
                                <?php echo $_smarty_tpl->tpl_vars['shipping_address_html']->value;?>

                            </p>
                            <?php if (!empty($_smarty_tpl->tpl_vars['shipping_custom_fields']->value)){?>
                                <p class="s-order-shipping-custom-fields">
                                    <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shipping_custom_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                                        <?php echo $_smarty_tpl->tpl_vars['f']->value['title'];?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['value'], ENT_QUOTES, 'UTF-8', true);?>
<br>
                                    <?php } ?>
                                </p>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['customer_delivery_date']->value||$_smarty_tpl->tpl_vars['customer_delivery_time']->value||$_smarty_tpl->tpl_vars['customer_delivery_date_str']->value){?>
                                <p class="s-order-customer-delivery-date<?php if (!empty($_smarty_tpl->tpl_vars['shipping_date']->value)){?> grey<?php }?>">
                                    Preferred shipping time:
                                    <?php if ($_smarty_tpl->tpl_vars['customer_delivery_date']->value){?>
                                        <span class="customer-delivery-date"><?php echo htmlspecialchars(wa_date('date',$_smarty_tpl->tpl_vars['customer_delivery_date']->value,waDateTime::getDefaultTimezone()), ENT_QUOTES, 'UTF-8', true);?>
</span>
                                    <?php }elseif($_smarty_tpl->tpl_vars['customer_delivery_date_str']->value){?>
                                        <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_delivery_date_str']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['customer_delivery_time']->value){?>
                                        <?php if ($_smarty_tpl->tpl_vars['customer_delivery_date']->value){?>
                                            &nbsp;
                                        <?php }?>
                                        <span class="customer-delivery-time-from"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_delivery_time']->value['from_hours'], ENT_QUOTES, 'UTF-8', true);?>
:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_delivery_time']->value['from_minutes'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                        -
                                        <span class="customer-delivery-time-to"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_delivery_time']->value['to_hours'], ENT_QUOTES, 'UTF-8', true);?>
:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_delivery_time']->value['to_minutes'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                    <?php }?>
                                </p>
                            <?php }?>

                        <?php }?>
                        <?php $_smarty_tpl->tpl_vars['_package'] = new Smarty_variable(shopShipping::extractItemsTotal($_smarty_tpl->tpl_vars['order']->value['params'],true), null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['_package']->value){?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['_package']->value['package_total_weight'])){?>
                                <p style="padding-left: 20px;">Total order weight: <?php echo $_smarty_tpl->tpl_vars['_package']->value['package_total_weight'];?>
</p>
                            <?php }?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['_package']->value)){?>
                                <p style="padding-left: 20px;" title="Width × length × height">Total order dimensions: <?php echo $_smarty_tpl->tpl_vars['_package']->value['package_total_width'];?>
&times;<?php echo $_smarty_tpl->tpl_vars['_package']->value['package_total_length'];?>
×<?php echo $_smarty_tpl->tpl_vars['_package']->value['package_total_height'];?>
</p>
                            <?php }?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['shipping_address']->value){?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['courier']->value)){?>
                                <!-- Courier -->
                                <h3>
                                    <span class="gray">Courier —</span> <a href="#/orders/search/params.courier_id=<?php echo $_smarty_tpl->tpl_vars['courier']->value['id'];?>
/" class="bold highlighted"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['courier']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                </h3>
                            <?php }?>

                            <?php $_smarty_tpl->tpl_vars['edit_shipping_details_available'] = new Smarty_variable(false, null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['order']->value['state'])){?><?php $_smarty_tpl->tpl_vars['available_actions'] = new Smarty_variable($_smarty_tpl->tpl_vars['order']->value['state']->getActions(), null, 0);?><?php $_smarty_tpl->tpl_vars['edit_shipping_details_available'] = new Smarty_variable(!empty($_smarty_tpl->tpl_vars['available_actions']->value['editshippingdetails']), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['edit_shipping_details_available']->value||!empty($_smarty_tpl->tpl_vars['shipping_date']->value)){?><p style="padding-left: 20px;"><?php if (!empty($_smarty_tpl->tpl_vars['shipping_date']->value)){?>Shipping time: <?php echo htmlspecialchars(wa_date('date',$_smarty_tpl->tpl_vars['shipping_date']->value,waDateTime::getDefaultTimezone()), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shipping_time_start']->value, ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shipping_time_end']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php if (!empty($_smarty_tpl->tpl_vars['order']->value['state'])){?><br><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['edit_shipping_details_available']->value){?><a href="javascript:void(0)" class="wf-action hint" data-action-id="editshippingdetails" data-container="#workflow-content">Edit shipping details</a><?php }?></p><?php }?>

                            <!-- shipping plugin output -->
                            <?php if (!empty($_smarty_tpl->tpl_vars['params']->value['tracking_number'])){?>
                                <h3>
                                    <span class="gray">Shipment tracking number —</span> <strong class="highlighted"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value['tracking_number'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
                                    <a href="javascript:void(0)"  class="wf-action hint" data-action-id="ship" data-container="#workflow-content"><i class="icon10 edit"></i></a>
                                </h3>
                            <?php }?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['tracking']->value)&&$_smarty_tpl->tpl_vars['order']->value['state_id']!='completed'){?>
                                <blockquote class="plugin s-tracking">
                                    <?php echo $_smarty_tpl->tpl_vars['tracking']->value;?>

                                </blockquote>
                            <?php }?>
                        <?php }?>
                    <?php }?>

                    <?php if (!empty($_smarty_tpl->tpl_vars['params']->value['payment_name'])){?>
                        <h3><span class="gray">Payment —</span> <strong><?php echo $_smarty_tpl->tpl_vars['params']->value['payment_name'];?>
</strong></h3>
                        <?php if ($_smarty_tpl->tpl_vars['billing_address']->value!==null){?>
                            <p class="s-order-address"><?php echo $_smarty_tpl->tpl_vars['billing_address']->value;?>
</p>
                        <?php }?>
                    <?php }?>

                    <div class="clear-right"></div>

                    <!-- order comment -->
                    <?php if ($_smarty_tpl->tpl_vars['order']->value['comment']){?>
                        <pre class="block double-padded s-order-comment"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['comment'], ENT_QUOTES, 'UTF-8', true);?>
</pre>
                    <?php }?>

                    <!-- order content -->

                    <table id="s-order-items" class="light s-order-items-table s-order-readable">
                        <?php if ($_smarty_tpl->tpl_vars['order']->value['items']){?>
                            <tr>
                                <th colspan="2"></th>
                                <th class="align-right">Qty</th>
                                <th class="align-right">Total</th>
                            </tr>

                            <?php $_smarty_tpl->tpl_vars['subtotal'] = new Smarty_variable(0, null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                <tr class="s-product-wrapper <?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='service'){?>is-product small<?php }?>" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" >
                                    <td class="min-width valign-top">
                                        <?php if ($_smarty_tpl->tpl_vars['item']->value['type']!='service'){?>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image_id'])){?>
                                                <?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->productImgHtml(array('id'=>$_smarty_tpl->tpl_vars['item']->value['product_id'],'image_id'=>$_smarty_tpl->tpl_vars['item']->value['image_id'],'image_filename'=>$_smarty_tpl->tpl_vars['item']->value['image_filename'],'ext'=>$_smarty_tpl->tpl_vars['item']->value['ext']),'48x48');?>

                                            <?php }else{ ?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
img/image-dummy-small.png" class="not-found" style="width: 48px; height: 48px;">
                                            <?php }?>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='service'){?><span class="gray s-overhanging-plus">+</span><?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['deleted'])){?>
                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                                            <span class="gray"><?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='product'){?>deleted product<?php }else{ ?>deleted service<?php }?></span>
                                        <?php }else{ ?>
                                            <a href="?action=products#/<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='product'){?>product/<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
<?php }else{ ?>services/<?php echo $_smarty_tpl->tpl_vars['item']->value['service_id'];?>
<?php }?>/"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                        <?php }?>
                                        <?php if (empty($_smarty_tpl->tpl_vars['item']->value['deleted'])&&$_smarty_tpl->tpl_vars['item']->value['type']=='product'&&htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['current_product_name'], ENT_QUOTES, 'UTF-8', true)!=htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true)){?>
                                            <div class="s-product-previous-name">
                                                <i class=" icon16 exclamation"></i>
                                                <span class="gray">
                                                    Current name: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['current_product_name'], ENT_QUOTES, 'UTF-8', true);?>

                                                </span>
                                            </div>
                                        <?php }?>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['sku_code'])&&empty($_smarty_tpl->tpl_vars['item']->value['deleted'])){?>
                                            <br>
                                            <span class="hint"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sku_code'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                        <?php }?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['stock'])){?>
                                            <br><span class="small">@<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['stock']['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                        <?php }?>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['stock_icon'])){?>
                                            <br><?php echo $_smarty_tpl->tpl_vars['item']->value['stock_icon'];?>

                                        <?php }?>

                                        <?php if ($_smarty_tpl->tpl_vars['item']->value['product_codes']){?>
                                            <div class="s-marking-section">
                                                <div class="s-section-icon">
                                                    <i class="icon16 ss parameter"></i>
                                                </div>
                                                <div class="s-marking-list">
                                                    <?php  $_smarty_tpl->tpl_vars['_code'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_code']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['product_codes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_code']->key => $_smarty_tpl->tpl_vars['_code']->value){
$_smarty_tpl->tpl_vars['_code']->_loop = true;
?>
                                                        <div class="s-mark-wrapper">
                                                            <a class="s-name inline-link wf-action" href="javascript:void(0);" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_code']->value['code'], ENT_QUOTES, 'UTF-8', true);?>
" data-action-id="editcode" data-form-in-dialog="1" data-item-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" data-code-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_code']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                                                                <b><i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_code']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</i></b>
                                                            </a>
                                                            <span class="s-count-text"><?php if (count($_smarty_tpl->tpl_vars['_code']->value['values'])>=$_smarty_tpl->tpl_vars['item']->value['quantity']){?><i class="icon16 yes"></i><?php }else{ ?><i class="icon16 exclamation"></i><?php }?><?php if ($_smarty_tpl->tpl_vars['item']->value['quantity']>1){?><?php echo sprintf_wp("%s out of %s",count($_smarty_tpl->tpl_vars['_code']->value['values']),$_smarty_tpl->tpl_vars['item']->value['quantity']);?>
<?php }else{ ?><?php echo count($_smarty_tpl->tpl_vars['_code']->value['values']);?>
<?php }?></span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </td>
                                    <td class="align-right nowrap"><span class="gray"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['item']->value['price'],$_smarty_tpl->tpl_vars['order']->value['currency']);?>
 &times;</span> <?php echo $_smarty_tpl->tpl_vars['item']->value['quantity'];?>
</td>
                                    <td class="align-right nowrap"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['item']->value['price']*$_smarty_tpl->tpl_vars['item']->value['quantity'],$_smarty_tpl->tpl_vars['order']->value['currency']);?>
</td>
                                </tr>
                                <?php $_smarty_tpl->tpl_vars['subtotal'] = new Smarty_variable($_smarty_tpl->tpl_vars['subtotal']->value+$_smarty_tpl->tpl_vars['item']->value['price']*$_smarty_tpl->tpl_vars['item']->value['quantity'], null, 0);?>
                            <?php } ?>
                            <tr class="no-border">
                                <td colspan="2"></td>
                                <td class="align-right"><br>Subtotal</td>
                                <td class="align-right nowrap"><br><?php echo wa_currency_html($_smarty_tpl->tpl_vars['subtotal']->value,$_smarty_tpl->tpl_vars['order']->value['currency']);?>
</td>
                            </tr>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="4" class="s-empty-order-note">Order content is unknown</td>
                            </tr>
                        <?php }?>
                        <tr class="no-border">
                            <td colspan="2"></td>
                            <td class="align-right">
                                Discount
                                <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['coupon'])){?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
marketing/coupons/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['coupon']['id'], ENT_QUOTES, 'UTF-8', true);?>
/"><i class="icon16 ss coupon"></i><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['coupon']['code'], ENT_QUOTES, 'UTF-8', true);?>
</strong></a>
                                <?php }?>
                            </td>
                            <td class="align-right nowrap">&minus; <?php echo wa_currency_html($_smarty_tpl->tpl_vars['order']->value['discount'],$_smarty_tpl->tpl_vars['order']->value['currency']);?>
</td>
                        </tr>
                        <?php if (isset($_smarty_tpl->tpl_vars['params']->value['shipping_name'])||$_smarty_tpl->tpl_vars['order']->value['shipping']>0){?>
                            <tr class="no-border">
                                <td colspan="2"></td>
                                <td class="align-right">Shipping</td>
                                <td class="align-right nowrap"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['order']->value['shipping'],$_smarty_tpl->tpl_vars['order']->value['currency']);?>
</td>
                            </tr>
                        <?php }?>
                        <tr class="no-border">
                            <td colspan="2"></td>
                            <td class="align-right">Tax</td>
                            <td class="align-right nowrap"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['order']->value['tax'],$_smarty_tpl->tpl_vars['order']->value['currency']);?>
</td>
                        </tr>
                        <tr class="no-border bold large" style="font-size: 150%;">
                            <td colspan="2"></td>
                            <td class="align-right">Total</td>
                            <td class="align-right nowrap"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['order']->value['total'],$_smarty_tpl->tpl_vars['order']->value['currency']);?>
</td>
                        </tr>
                    </table>


                    <div id="s-order-items-edit" class="s-order-editable" style="display:none;"></div>

                    <!-- order processing timeline -->
                    <div class="s-order-readable s-order-timeline">
                        <h3>Order timeline</h3><br>
                        <p class="workflow-actions">
                            <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['bottom_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value){
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
                                <?php echo $_smarty_tpl->tpl_vars['b']->value;?>

                            <?php } ?>
                        </p>
                        <div class="workflow-content"></div>
                        <div class="fields">
                            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['log']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                <div class="field">
                                    <div class="name"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['row']->value['datetime'],"humandatetime");?>
</div>
                                    <div class="value">
                                        <?php if ($_smarty_tpl->tpl_vars['row']->value['action_id']){?>
                                            <?php if ($_smarty_tpl->tpl_vars['row']->value['contact_id']){?>
                                                <i class="icon16 userpic20" style="background-image: url(<?php echo waContact::getPhotoUrl($_smarty_tpl->tpl_vars['row']->value['contact_id'],$_smarty_tpl->tpl_vars['row']->value['contact_photo'],20);?>
);"></i>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value['contact_name'], ENT_QUOTES, 'UTF-8', true);?>

                                            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['action_id']=='callback'&&!empty($_smarty_tpl->tpl_vars['row']->value['plugin'])){?>
                                                <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['plugin_icon_url'])){?>
                                                    <i class="icon16" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['row']->value['plugin_icon_url'];?>
');"></i>
                                                <?php }?>
                                                <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['row']->value['plugin'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                                            <?php }?>
                                            <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['params']['actor_courier_name'])){?>
                                                <?php if ($_smarty_tpl->tpl_vars['row']->value['contact_id']){?><br><?php }?>
                                                <i class="icon16 ss courier"></i>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value['params']['actor_courier_name'], ENT_QUOTES, 'UTF-8', true);?>

                                            <?php }?>
                                            <strong><?php if ($_smarty_tpl->tpl_vars['row']->value['action']){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value['action']->getOption('log_record'), ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['action_id'];?>
<?php }?></strong>

                                            <?php if ($_smarty_tpl->tpl_vars['row']->value['text']){?>
                                                <p<?php if ($_smarty_tpl->tpl_vars['row']->value['action_id']=='message'||$_smarty_tpl->tpl_vars['row']->value['action_id']=='comment'||$_smarty_tpl->tpl_vars['row']->value['action_id']=='pay'||$_smarty_tpl->tpl_vars['row']->value['action_id']=='ship'){?> class="s-order-timeline-message<?php if ($_smarty_tpl->tpl_vars['row']->value['action_id']=='message'){?> blue<?php }elseif($_smarty_tpl->tpl_vars['row']->value['action_id']=='ship'){?> yellow<?php }?>"<?php }?>><?php echo nl2br(smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['row']->value['text'],'@\<br\s*/?\>\r?(\n)@','$1'));?>
</p>
                                            <?php }?>
                                        <?php }else{ ?>
                                            <?php if ($_smarty_tpl->tpl_vars['row']->value['text']){?>
                                                <p><?php echo nl2br(smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['row']->value['text'],'@\<br\s*/?\>\r?(\n)@','$1'));?>
</p>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['params']['refund_items'])){?>
                                        <div class="value">
                                            <ul class="menu-v compact" style="margin: 0 0 20px 24px;"><?php  $_smarty_tpl->tpl_vars['_product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['params']['refund_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_product']->key => $_smarty_tpl->tpl_vars['_product']->value){
$_smarty_tpl->tpl_vars['_product']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['_is_service'] = new Smarty_variable($_smarty_tpl->tpl_vars['_product']->value['type']==="service", null, 0);?><li class="<?php if ($_smarty_tpl->tpl_vars['_is_service']->value){?>s-service gray<?php }else{ ?>s-product<?php }?>"><span class="s-name"><?php if ($_smarty_tpl->tpl_vars['_is_service']->value){?>+ <?php }?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php if (!empty($_smarty_tpl->tpl_vars['_product']->value['sku_code'])){?><span class="s-divider">, </span><span class="s-sku-code gray"><?php echo $_smarty_tpl->tpl_vars['_product']->value['sku_code'];?>
</span><?php }?><span class="s-divider">, </span><span class="s-price"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['_product']->value['price'],ifset($_smarty_tpl->tpl_vars['_product']->value['currency'],$_smarty_tpl->tpl_vars['order']->value['currency']));?>
</span><span class="s-divider"> x </span><span class="s-quantity"><?php echo floatval($_smarty_tpl->tpl_vars['_product']->value['quantity']);?>
 items</span></li><?php } ?></ul>
                                        </div>
                                    <?php }?>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['params']['return_stock'])){?>
                                    <div class="value">
                                        <?php echo htmlspecialchars(sprintf("Items were returned to stock “%s”.",ifset($_smarty_tpl->tpl_vars['row']->value['params']['return_stock_name'],$_smarty_tpl->tpl_vars['row']->value['params']['return_stock'])), ENT_QUOTES, 'UTF-8', true);?>

                                    </div>
                                    <?php }?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="s-split-order-sidebar float-right s-order-aux ">

                    <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['paid_date'])){?>
                        <div class="s-paid-order-stamp" title="<?php echo sprintf('Order was paid on %s',smarty_modifier_wa_date($_smarty_tpl->tpl_vars['order']->value['paid_date'],'humandate'));?>
"><div class="s-stamp-inner"></div><span>Paid</span></div>
                    <?php }elseif(!empty($_smarty_tpl->tpl_vars['order']->value['auth_date'])){?>
                        <div class="s-paid-order-stamp" title="<?php echo sprintf('Order payment was captured on %s',smarty_modifier_wa_date($_smarty_tpl->tpl_vars['order']->value['auth_date'],'humandate'));?>
"><div class="s-stamp-inner"></div><span style="font-size: 12px;">Payment is authorized</span></div>
                    <?php }?>

                    <div class="block half-padded s-printable-print-button align-center">
                        <input type="button" value="Print" onClick="window.print();">
                    </div>

                    <!-- order action links -->
                    <ul class="menu-v with-icons compact workflow-actions">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
?module=order&id=<?php echo $_smarty_tpl->tpl_vars['order']->value['id'];?>
&printable=true" class="js-show-print-page"><i class="icon16 print"></i>Printable version</a>
                            <script>
                                ( function($) {
                                    $(".workflow-actions .js-show-print-page").on("click", function(event) {
                                        event.preventDefault();
                                        showWindow($(this).attr('href'));
                                    });

                                    function showWindow(href) {
                                        var $window = $(window),
                                            window_w = $window.width(),
                                            window_h = $window.height();

                                        var params_array = [
                                            ["top", parseInt(window_h * .025)],
                                            ["left", parseInt(window_w * .025)],
                                            ["height", parseInt(window_h * .95)],
                                            ["width", parseInt(window_w * .95)]
                                        ];

                                        var params = [];

                                        $.each(params_array, function(index, item) {
                                            var param_string = item[0] + "=" + item[1];
                                            params.push(param_string);
                                        });

                                        window.open(href, "wa-shop-order-print", params.join(","));
                                    }

                                })(jQuery);
                            </script>
                        </li>
                        <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['top_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value){
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
                            <li><?php echo $_smarty_tpl->tpl_vars['b']->value;?>
</li>
                        <?php } ?>

                        <!-- plugin hook: 'backend_order.action_link' -->
                        
                        <?php if (!empty($_smarty_tpl->tpl_vars['backend_order']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_order']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php if ((!empty($_smarty_tpl->tpl_vars['_']->value['action_link']))){?><li><?php echo $_smarty_tpl->tpl_vars['_']->value['action_link'];?>
</li><?php }?><?php } ?><?php }?>

                    </ul>
                    <div class="workflow-content"></div>

                    <!-- printable docs -->
                    <?php if (count($_smarty_tpl->tpl_vars['printable_docs']->value)){?>
                        <br>
                        <ul class="menu-v js-printable-docs">
                            <?php  $_smarty_tpl->tpl_vars['printable_doc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['printable_doc']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['printable_docs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['printable_doc']->key => $_smarty_tpl->tpl_vars['printable_doc']->value){
$_smarty_tpl->tpl_vars['printable_doc']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin_id']->value = $_smarty_tpl->tpl_vars['printable_doc']->key;
?>
                                <li>
                                    <label>
                                        <input type="checkbox" checked="true" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['printable_doc']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['plugin_id']->value;?>
" data-target="_printform_<?php echo $_smarty_tpl->tpl_vars['plugin_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['order']->value['id'];?>
">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['printable_doc']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['printable_doc']->value['mail_url'])){?>
                                            <a href="#" class="inline js-printable-docs-send" data-order-id="<?php echo $_smarty_tpl->tpl_vars['order']->value['id'];?>
" data-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['printable_doc']->value['mail_url'], ENT_QUOTES, 'UTF-8', true);?>
" title="Email this form to customer"><i class="icon16 email on-hover-only"></i></a>
                                        <?php }?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                        <input type="button" value="Print" class="js-printable-docs">
                        <br><br>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['shipping_address']->value){?>
                        <!-- order shipping & billing addresses -->
                        <div class="s-order-aux"><?php echo $_smarty_tpl->tpl_vars['map']->value;?>
</div>
                    <?php }?>

                    <!-- order aux info -->
                    <p class="gray">
                        Order created: <strong><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['order']->value['create_datetime'],"humandatetime");?>
</strong><br>
                        <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['params']['referer'])){?>Referrer: <strong><a href="<?php echo $_smarty_tpl->tpl_vars['order']->value['params']['referer'];?>
" target="_blank" style="color: #03c;"><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['order']->value['params']['referer'],42), ENT_QUOTES, 'UTF-8', true);?>
</a></strong><br><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['params']['utm_campaign'])){?>UTM campaign: <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['params']['utm_campaign'], ENT_QUOTES, 'UTF-8', true);?>
</strong><br><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['sales_channel']->value)){?>Sales channel: <strong title="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['order']->value['params']['sales_channel'])===null||$tmp==='' ? '?' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sales_channel']->value, ENT_QUOTES, 'UTF-8', true);?>
</strong><br><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['params']['storefront'])){?>Storefront: <strong><?php echo (($tmp = @$_smarty_tpl->tpl_vars['order']->value['params']['storefront_decoded'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['order']->value['params']['storefront'] : $tmp);?>
</strong><br><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['params']['keyword'])){?>Keyword: <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['params']['keyword'], ENT_QUOTES, 'UTF-8', true);?>
</strong><br><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['params']['ip'])){?>IP: <strong><?php echo $_smarty_tpl->tpl_vars['order']->value['params']['ip'];?>
</strong><br><?php }?>

                        <!-- plugin hook: 'backend_order.aux_info' -->
                        
                        <?php if (!empty($_smarty_tpl->tpl_vars['backend_order']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_order']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php if ((!empty($_smarty_tpl->tpl_vars['_']->value['aux_info']))){?><?php echo $_smarty_tpl->tpl_vars['_']->value['aux_info'];?>
<br><?php }?><?php } ?><?php }?>
                    </p>

                </div>
            </div>
        </div>

        <div class="clear-left"></div>

    </div>
    <div class="clear-both"></div>

    <script>
        ( function($) {
            var sources = [{
                id: "wa-dialog-css",
                type: "css",
                uri: "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/dialog/dialog.css?v=<?php echo $_smarty_tpl->tpl_vars['wa']->value->version(true);?>
"
            }, {
                id: "wa-dialog-js",
                type: "js",
                uri: "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/dialog/dialog.js?v=<?php echo $_smarty_tpl->tpl_vars['wa']->value->version(true);?>
"
            }, {
                id: "wa-shop-backend-order-css",
                type: "css",
                uri: "<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
css/backend/orders/order.css?v=<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
"
            }, {
                id: "wa-shop-backend-order-js",
                type: "js",
                uri: "<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/order/order.js?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
"
            }];

            $.shop.loadSources(sources).then(init);

            function init() {
                var $wrapper = $("#s-order-block").removeAttr("style");

                var view = "<?php echo $_smarty_tpl->tpl_vars['wa']->value->get('view');?>
";
                var count_new = <?php if (!empty($_smarty_tpl->tpl_vars['count_new']->value)){?><?php echo $_smarty_tpl->tpl_vars['count_new']->value;?>
<?php }else{ ?>0<?php }?>;
                var options = {
                    $wrapper: $wrapper,
                    order: <?php echo json_encode($_smarty_tpl->tpl_vars['order']->value);?>
,
                    currency: '<?php echo $_smarty_tpl->tpl_vars['currency']->value;?>
',
                    view: view,
                    offset: <?php echo json_encode($_smarty_tpl->tpl_vars['offset']->value);?>

                };

                // title has to be overridden in this cases
                if (view === 'table') {
                    options.title = '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName(false);?>
<?php $_tmp1=ob_get_clean();?><?php echo strtr(($_smarty_tpl->tpl_vars['wa']->value->shop->orderId($_smarty_tpl->tpl_vars['order']->value['id'])).(" — ").($_tmp1), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
                    if (count_new) {
                        options.title = '(' + count_new + ') ' + options.title;
                    }
                }

                if (!$.order_list || view === 'table') {
                    if ($.order_list) {
                        $.order_list.finit();   // destructor
                    }
                    options.dependencies = options.dependencies || { };
                    options.dependencies.order_list = {
                        view: view,
                        update_process: {
                            timeout: <?php echo $_smarty_tpl->tpl_vars['timeout']->value;?>

                        },
                        count_new: <?php echo $_smarty_tpl->tpl_vars['count_new']->value;?>
,
                        title_suffix: " — <?php echo strtr($_smarty_tpl->tpl_vars['wa']->value->accountName(false), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
",
                        filter_params: <?php echo json_encode($_smarty_tpl->tpl_vars['filter_params']->value);?>
,
                        filter_params_str: '<?php echo $_smarty_tpl->tpl_vars['filter_params_str']->value;?>
'
                    };
                }

                options.templates = {
                };

                options.urls = {
                    "marking_dialog": "todo:"
                };

                $.order.init(options);

                <?php if ($_smarty_tpl->tpl_vars['wa']->value->shop->config('enable_2x')){?>
                    $.fn.retina && $('#s-order-items img').retina();
                <?php }?>
            }
        })(jQuery);
    </script>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:16
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/customers/include.top_fields.html" */ ?>
<?php if ($_valid && !is_callable('content_5f98075c312eb1_07942671')) {function content_5f98075c312eb1_07942671($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['need_other_values'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['need_other_values']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['top']->value){?>

    <?php $_smarty_tpl->tpl_vars['customers_rights'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->userRights('customers'), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['_has_hidden_fields'] = new Smarty_variable(false, null, 0);?>

    <div class="s-customer-fields-section" id="js-customer-fields-section">
        <ul class="menu-v with-icons compact s-customer-top-field-list">
            <?php  $_smarty_tpl->tpl_vars['top_field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['top_field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['top']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['top_field']->key => $_smarty_tpl->tpl_vars['top_field']->value){
$_smarty_tpl->tpl_vars['top_field']->_loop = true;
?>
                <li class="s-customer-top-field-default-value-item">
                    <?php if ($_smarty_tpl->tpl_vars['top_field']->value['id']!=='im'){?>
                        <i class="icon16 <?php echo $_smarty_tpl->tpl_vars['top_field']->value['id'];?>
<?php if ($_smarty_tpl->tpl_vars['top_field']->value['default_value']['is_confirmed']){?>-confirmed ss<?php }?>" <?php if ($_smarty_tpl->tpl_vars['top_field']->value['default_value']['is_confirmed']){?>title="Confirmed"<?php }?>></i>
                    <?php }?>

                    <?php echo $_smarty_tpl->tpl_vars['top_field']->value['default_value']['formatted'];?>


                    <?php if ($_smarty_tpl->tpl_vars['top_field']->value['id']=='email'&&!empty($_smarty_tpl->tpl_vars['similar_contacts']->value['email']['count'])){?>
                        <span class="similar hint">
                            <span class="similar-hull">
                                <?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?><a href="?action=customers#/search/email=<?php echo urlencode($_smarty_tpl->tpl_vars['similar_contacts']->value['email']['value']);?>
" class="nowrap"><?php }?><i class="icon10 exclamation"></i><?php echo _w('%d more customer found with the same email address','%d more customers found with the same email address',$_smarty_tpl->tpl_vars['similar_contacts']->value['email']['count']);?>
<?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?></a><?php }?>
                            </span>
                            <span class="similar-short" title="Number of customers with the same email address">
                                <?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?><a href="?action=customers#/search/email=<?php echo urlencode($_smarty_tpl->tpl_vars['similar_contacts']->value['email']['value']);?>
" class="nowrap"><?php }?><i class="icon10 exclamation"></i><?php echo $_smarty_tpl->tpl_vars['similar_contacts']->value['email']['count'];?>
<?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?></a><?php }?>
                            </span>
                         </span>

                    <?php }elseif($_smarty_tpl->tpl_vars['top_field']->value['id']=='phone'&&!empty($_smarty_tpl->tpl_vars['similar_contacts']->value['phone']['count'])){?>
                        <span class="similar hint">
                            <span class="similar-hull">
                                <?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?><a href="?action=customers#/search/phone=<?php echo urlencode($_smarty_tpl->tpl_vars['similar_contacts']->value['phone']['value']);?>
" class="nowrap"><?php }?><i class="icon10 exclamation"></i><?php echo _w('%d more customer found with the same phone number','%d more customers found with the same phone number',$_smarty_tpl->tpl_vars['similar_contacts']->value['phone']['count']);?>
<?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?></a><?php }?>
                            </span>
                            <span class="similar-short" title="Number of customers with the same phone number">
                                <?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?><a href="?action=customers#/search/phone=<?php echo urlencode($_smarty_tpl->tpl_vars['similar_contacts']->value['phone']['value']);?>
" class="nowrap"><?php }?><i class="icon10 exclamation"></i><?php echo $_smarty_tpl->tpl_vars['similar_contacts']->value['phone']['count'];?>
<?php if ($_smarty_tpl->tpl_vars['customers_rights']->value){?></a><?php }?>
                            </span>
                        </span>
                    <?php }?>
                </li>
            <?php } ?>

            <?php if ($_smarty_tpl->tpl_vars['need_other_values']->value){?>
                <?php  $_smarty_tpl->tpl_vars['top_field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['top_field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['top']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['top_field']->key => $_smarty_tpl->tpl_vars['top_field']->value){
$_smarty_tpl->tpl_vars['top_field']->_loop = true;
?>
                    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['top_field']->value['other_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
                        <?php if (empty($_smarty_tpl->tpl_vars['_has_hidden_fields']->value)){?><?php $_smarty_tpl->tpl_vars['_has_hidden_fields'] = new Smarty_variable(true, null, 0);?><?php }?>

                        <li class="s-customer-top-field-other-value-item" style="display: none;">

                            <?php if ($_smarty_tpl->tpl_vars['top_field']->value['id']!=='im'){?>
                                <i class="icon16 <?php echo $_smarty_tpl->tpl_vars['top_field']->value['id'];?>
<?php if ($_smarty_tpl->tpl_vars['value']->value['is_confirmed']){?>-confirmed ss<?php }?>" <?php if ($_smarty_tpl->tpl_vars['value']->value['is_confirmed']){?>title="Confirmed"<?php }?> />
                            <?php }?>

                            <?php echo $_smarty_tpl->tpl_vars['value']->value['formatted'];?>

                        </li>
                    <?php } ?>
                <?php } ?>
            <?php }?>
        </ul>

        <?php if (!empty($_smarty_tpl->tpl_vars['_has_hidden_fields']->value)){?>
            <div class="s-fields-toggle">
                <a class="inline-link js-toggle-button" href="javascript:void(0);">
                    <i class="svg-icon size-10 arrow-toggle" style="padding: 0 7px 0 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 5">
                            <polyline style="fill:none; stroke: currentColor; stroke-linecap:round; stroke-linejoin:round;" points="0.5 0.5 4.5 4.5 8.5 0.5"/>
                        </svg>
                    </i>
                    <b><i>More contact information</i></b>
                </a>

                <script>
                    ( function($) {
                        var $wrapper = $("#js-customer-fields-section").removeAttr("id");
                        $wrapper.on("click", ".js-toggle-button", function(event) {
                            event.preventDefault();
                            $(this).closest(".s-fields-toggle").hide();
                            $wrapper.find(".s-customer-top-field-other-value-item").show();
                        });
                    })(jQuery);
                </script>
            </div>
        <?php }?>
    </div>
<?php }?>
<?php }} ?>