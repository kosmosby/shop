<?php /* Smarty version Smarty-3.1.14, created on 2020-10-12 19:10:27
         compiled from "Z:\home\shop.tst\www\wa-system\webasyst\templates\actions\settings\sidebar\Sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:238575f847ff3c8f9e8-08077516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '254a18cfad636939eb93afb360d7f086ee9539d2' => 
    array (
      0 => 'Z:\\home\\shop.tst\\www\\wa-system\\webasyst\\templates\\actions\\settings\\sidebar\\Sidebar.html',
      1 => 1541168108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '238575f847ff3c8f9e8-08077516',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    '_id' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f847ff3e5d1d6_85920992',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f847ff3e5d1d6_85920992')) {function content_5f847ff3e5d1d6_85920992($_smarty_tpl) {?><div class="s-sidebar-block" id="s-sidebar-block">
    <ul class="menu-v with-icons">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <li data-id="<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
">
                <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
">
                    <i class="icon16 ws <?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
"></i><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

                </a>
            </li>
        <?php } ?>
    </ul>
</div>
<?php }} ?>