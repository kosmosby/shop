<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:15
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/orders/Orders.html" */ ?>
<?php /*%%SmartyHeaderCode:12093867605f98075b6e3182-23282401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f617dfad5e1f92648f5e48e03090523cba59d13e' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/orders/Orders.html',
      1 => 1603270274,
      2 => 'file',
    ),
    '68bf43b937c041b4521314892c543f093cd22d2e' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/orders/include.template_order_list_table.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12093867605f98075b6e3182-23282401',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orders' => 0,
    'view' => 0,
    'params_str' => 0,
    'actions' => 0,
    'a' => 0,
    'a_id' => 0,
    '_available_for_states_str' => 0,
    'count' => 0,
    'total_count' => 0,
    'template_content' => 0,
    'template' => 0,
    'order' => 0,
    'params' => 0,
    'all_order_state_ids' => 0,
    'timeout' => 0,
    'wa' => 0,
    'state_names' => 0,
    'counters' => 0,
    'sort' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075b919447_07556499',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075b919447_07556499')) {function content_5f98075b919447_07556499($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.replace.php';
?><?php if (empty($_smarty_tpl->tpl_vars['orders']->value)){?>
    <div class="block double-padded align-center blank">
            <br><br><br><br>
            <span class="gray large">There are no orders in this view.</span>
            <div class="clear-left"></div>
        </div>
    </div>
<?php }else{ ?>

<div class="<?php if ($_smarty_tpl->tpl_vars['view']->value!='table'){?>sidebar left300px bordered-left<?php }?>" id="s-orders">
    <div class="">
        <?php if ($_smarty_tpl->tpl_vars['view']->value=='split'){?>
            <ul class="zebra s-orders" id="order-list">
            </ul>
            <?php $_smarty_tpl->_capture_stack[0][] = array("template-order-list-split", null, null); ob_start(); ?>
                
                {% var orders = o.orders; %}
                {% for (var i = 0, n = orders.length; i < n; i += 1) { %}
                    {% var order = orders[i]; %}
                    <li class="order s-order-status-pending{% if (order.unsettled==='1') { %} s-unsettled{% } %}" data-order-id="{%#order.id%}">
                        <a href="#/orders/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
&<?php }?>id={%#order.id%}/">
                            {% if (!$.isEmptyObject(order.contact)) { %}
                                <div class="profile image50px">
                                    <div class="image">
                                        <img src="{%#order.contact.photo_50x50%}" class="userpic">
                                    </div>
                                    <div class="details nowrap">
                                        {% include('template-order-list-split-details', { order: order }); %}
                                    </div>
                                </div>
                            {% } %}
                        </a>
                    </li>
                {% } %}
                
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("template-order-list-split-details", null, null); ob_start(); ?>
                {%#o.order.status%}
                    <span class="float-right small" style="{%#o.order.style%}">{%#o.order.total_str%}</span>

                    <i class="{%#o.order.icon%}"></i><span {% if (o.order.state_id == 'new') { %}class="highlighted"{% } %} style="{%#o.order.style%}">{%#o.order.id_str%}</span>

                    <p>
                        {% if (o.order.contact.name) { %}
                            <span class="small black">{%#o.order.contact.name%}</span><br>
                        {% } else { %}
                            <span class="hint">(no name)</span><br>
                        {% } %}
                        <span class="hint">{%#o.order.create_datetime_str%}</span>
                    </p>
                
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php }elseif($_smarty_tpl->tpl_vars['view']->value=='table'){?>

            <div class="s-orders-selection-menu" style="display: none;" id="s-orders-selection-menu">
                <div class="table-layout">
                    <div class="column-item s-checkbox-column">
                        <input type="checkbox" name="" class="s-order-list-select-all">
                    </div>
                    <div class="column-item">
                        <ul class="menu-h with-icons dropdown">
                            <li>
                                <a class="inline-link nowrap" style="display:inline;">
                                    <b><i><strong>With selected</strong></i></b>
                                    <i class="icon10 darr"></i>
                                    <i class="icon16 loading js-selection-menu-loading" style="display: none"></i>
                                </a>
                                <ul class="menu-v wf-actions">
                                    <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_smarty_tpl->tpl_vars['a_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
$_smarty_tpl->tpl_vars['a']->_loop = true;
 $_smarty_tpl->tpl_vars['a_id']->value = $_smarty_tpl->tpl_vars['a']->key;
?>

                                        <?php $_smarty_tpl->tpl_vars['_available_for_states'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['a']->value['available_for_states'])===null||$tmp==='' ? array() : $tmp), null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['_available_for_states_str'] = new Smarty_variable(join($_smarty_tpl->tpl_vars['a']->value['available_for_states'],','), null, 0);?>

                                        <li class="s-disabled s-wf-action-item js-wf-action-item" data-action-id="<?php echo $_smarty_tpl->tpl_vars['a_id']->value;?>
" data-available-for-states="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_available_for_states_str']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                                            <a href="javascript:void(0);" data-action-id="<?php echo $_smarty_tpl->tpl_vars['a_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <table class="zebra single-lined padded" id="order-list">
                <tbody></tbody>
            </table>

            <?php $_smarty_tpl->_capture_stack[0][] = array("template-order-list-table", null, null); ob_start(); ?>
                <?php /*  Call merged included template "./include.template_order_list_table.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('./include.template_order_list_table.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '12093867605f98075b6e3182-23282401');
content_5f98075b7b3ee4_99085676($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "./include.template_order_list_table.html" */?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php }?>

        <div class="lazyloading-wrapper">
            <div class="lazyloading-progress-string"><?php echo _w('%d order','%d orders',$_smarty_tpl->tpl_vars['count']->value);?>
&nbsp;<?php echo sprintf(_w('of %d'),$_smarty_tpl->tpl_vars['total_count']->value);?>
</div><br>
             <a href="javascript:void(0);" class="lazyloading-link" <?php if ($_smarty_tpl->tpl_vars['count']->value>=$_smarty_tpl->tpl_vars['total_count']->value){?>style="display:none;"<?php }?>>Show more orders</a>
            <span class="lazyloading-progress" style="display:none">
                <i class="icon16 loading"></i> Loading <span class="lazyloading-chunk"><?php echo _w('%d order','%d orders',min($_smarty_tpl->tpl_vars['total_count']->value-$_smarty_tpl->tpl_vars['count']->value,$_smarty_tpl->tpl_vars['count']->value));?>
...</span>
            </span>
        </div>
        <div class="clear-left"></div>
    </div>
</div>
<div class="content <?php if ($_smarty_tpl->tpl_vars['view']->value!='table'){?>left300px<?php }?>" id="s-order" <?php if ($_smarty_tpl->tpl_vars['view']->value=='table'){?>style="display:none;"<?php }?>></div>

<?php $_smarty_tpl->_capture_stack[0][] = array("template-order-list-printforms-menu-items", null, null); ob_start(); ?>
    
        {% var printform, printform_iterator = $.shop.iterator(o.printforms); %}
        {% if (printform_iterator.len() > 0) { %}
            <li class="s-printform-item-sep"></li>
            {% while (printform = printform_iterator.next()) { %}
                <li class="s-printform-item">
                    <label>
                        <input type="checkbox" checked="true" data-id="{%#printform_iterator.key()%}" value="{%#printform.url%}">
                        <span {% if (!printform.all) { %}style="opacity: 0.5;"{% } %}>
                            {%=printform.name%}
                            {% if (printform.owner_name) { %}
                                —
                                {%=printform.owner_name%}
                            {% } %}
                        </span>
                    </label>
                </li>
            {% } %}
            <li class="s-printform-item-button">
                <input type='button' class="small" value="Print">
            </li>
        {% } %}
    
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>



<?php  $_smarty_tpl->tpl_vars['template_content'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['template_content']->_loop = false;
 $_smarty_tpl->tpl_vars['template'] = new Smarty_Variable;
 $_from = ifempty(Smarty::$_smarty_vars['capture'],array()); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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

<?php }?>

<script>
( function($) {
    $.order_list.init({
        id: <?php if ($_smarty_tpl->tpl_vars['view']->value!='table'&&$_smarty_tpl->tpl_vars['order']->value['id']){?><?php echo $_smarty_tpl->tpl_vars['order']->value['id'];?>
<?php }else{ ?>0<?php }?>,
        view: '<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
',
        filter_params: <?php echo json_encode($_smarty_tpl->tpl_vars['params']->value);?>
,
        filter_params_str: '<?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
',
        orders: <?php echo json_encode($_smarty_tpl->tpl_vars['orders']->value);?>
,
        total_count: <?php echo $_smarty_tpl->tpl_vars['total_count']->value;?>
,
        all_order_state_ids: <?php echo json_encode($_smarty_tpl->tpl_vars['all_order_state_ids']->value);?>
,
        count: <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
,
        lazy_loading: {
            auto: true
        },
        update_process: {
            timeout: <?php echo $_smarty_tpl->tpl_vars['timeout']->value;?>

        },
        title_suffix: '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName(false);?>
<?php $_tmp1=ob_get_clean();?><?php echo strtr((' — ').($_tmp1), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
        state_names: <?php echo json_encode($_smarty_tpl->tpl_vars['state_names']->value);?>
,
        counters: <?php echo json_encode($_smarty_tpl->tpl_vars['counters']->value);?>
,
        $selectionMenu: $("#s-orders-selection-menu"),
        sort: <?php echo json_encode($_smarty_tpl->tpl_vars['sort']->value);?>

    });
})(jQuery);
</script>
<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:15
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/orders/include.template_order_list_table.html" */ ?>
<?php if ($_valid && !is_callable('content_5f98075b7b3ee4_99085676')) {function content_5f98075b7b3ee4_99085676($_smarty_tpl) {?>
    {% var orders = o.orders; %}
    {% var check_all = o.check_all; %}
    {% var order, order_iterator = $.shop.iterator(orders); %}
    {% while (order = order_iterator.next()) { %}
        <tr class="order{% if (order.unsettled==='1') { %} s-unsettled{% } %}  {% if (check_all) { %}selected{% } %}" data-order-id="{%#order.id%}" data-state-id="{%#order.state_id%}">
            {% if (!o.hide_checkbox) { %}
                <td><input type="checkbox" {% if (check_all) { %}checked="checked"{% } %}></td>
            {% } %}
            <td style="{%#order.style%}" class="nowrap">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>">
                        <i class="{%#order.icon%}"></i><span{% if (order.state_id == 'new') { %} class="highlighted"{% } %}>{%#order.id_str%}</span></a>
                </div>
            </td>
            <td style="{%#order.style%}">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>">{%#order.create_datetime_str%}</a>
                    <i class="shortener"></i>
                </div>
            </td>
            <td style="{%#order.style%}">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>">{%#order.contact.name%}</a>
                    <i class="shortener"></i>
                </div>
            </td>
            <td style="{%#order.style%}" class="nowrap align-right">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>">{%#order.total_str%}</a>
                </div>
            </td>
            <td style="{%#order.style%}">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>">{%#order.shipping_name%}</a>
                </div>
            </td>
            <td style="{%#order.style%}">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>"><span style="color:#888">{%#order.courier_name%} {%#order.shipping_interval%}</span></a>
                </div>
            </td>
            <td style="{%#order.style%}">
                <div><a href="?action=orders#/order/{%#order.id%}/<?php if ($_smarty_tpl->tpl_vars['params_str']->value){?><?php echo $_smarty_tpl->tpl_vars['params_str']->value;?>
/<?php }?>">{%#order.payment_name%}</a></div>
            </td>
        </tr>
    {% } %}

<?php }} ?>