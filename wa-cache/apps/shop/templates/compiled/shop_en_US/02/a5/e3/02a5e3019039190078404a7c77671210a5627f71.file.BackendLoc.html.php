<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:14
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/backend/BackendLoc.html" */ ?>
<?php /*%%SmartyHeaderCode:14338813075f98075ad75a35-14858000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02a5e3019039190078404a7c77671210a5627f71' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/backend/BackendLoc.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14338813075f98075ad75a35-14858000',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'strings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075adc4143_48125307',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075adc4143_48125307')) {function content_5f98075adc4143_48125307($_smarty_tpl) {?>$.wa.locale = $.extend($.wa.locale, <?php ob_start();?><?php echo json_encode($_smarty_tpl->tpl_vars['strings']->value);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_tmp1;?>
);<?php }} ?>