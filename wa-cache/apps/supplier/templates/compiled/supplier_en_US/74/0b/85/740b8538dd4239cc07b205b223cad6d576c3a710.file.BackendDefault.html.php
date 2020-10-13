<?php /* Smarty version Smarty-3.1.14, created on 2020-10-12 20:21:35
         compiled from "Z:\home\shop.tst\www\wa-apps\supplier\templates\actions\backend\BackendDefault.html" */ ?>
<?php /*%%SmartyHeaderCode:99925f84909f775a99-13202925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '740b8538dd4239cc07b205b223cad6d576c3a710' => 
    array (
      0 => 'Z:\\home\\shop.tst\\www\\wa-apps\\supplier\\templates\\actions\\backend\\BackendDefault.html',
      1 => 1602522317,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99925f84909f775a99-13202925',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f84909f7e07d0_55729442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84909f7e07d0_55729442')) {function content_5f84909f7e07d0_55729442($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_smarty_tpl->tpl_vars['wa']->value->appName();?>
 - <?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</title>
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>

    <script src="<?php echo $_smarty_tpl->tpl_vars['wa']->value->url();?>
wa-content/js/jquery/jquery-1.4.2.min.js"
            type="text/javascript"></script>
</head>
<body>
<div id="wa">
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->header();?>

    <div id="wa-app">
        <div class="block">Hello world!</div>
    </div>
</div>
</body>
</html><?php }} ?>