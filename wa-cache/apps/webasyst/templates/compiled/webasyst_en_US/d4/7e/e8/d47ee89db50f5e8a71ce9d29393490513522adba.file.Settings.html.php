<?php /* Smarty version Smarty-3.1.14, created on 2020-10-12 19:10:27
         compiled from "Z:\home\shop.tst\www\wa-system\webasyst\templates\layouts\Settings.html" */ ?>
<?php /*%%SmartyHeaderCode:194785f847ff3f41162-07845929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd47ee89db50f5e8a71ce9d29393490513522adba' => 
    array (
      0 => 'Z:\\home\\shop.tst\\www\\wa-system\\webasyst\\templates\\layouts\\Settings.html',
      1 => 1565270346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '194785f847ff3f41162-07845929',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'wa_url' => 0,
    'backend_assets' => 0,
    'item' => 0,
    'sidebar' => 0,
    'content' => 0,
    'wa_backend_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f847ff420c504_43352433',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f847ff420c504_43352433')) {function content_5f847ff420c504_43352433($_smarty_tpl) {?><?php if (!is_callable('smarty_block_wa_js')) include 'Z:\\home\\shop.tst\\www\\wa-system/vendors/smarty-plugins\\block.wa_js.php';
?><?php $_smarty_tpl->tpl_vars['_locale_string'] = new Smarty_variable(substr($_smarty_tpl->tpl_vars['wa']->value->locale(),0,2), null, 0);?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Settings &mdash; <?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</title>
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>


    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/css/wa-settings/settings.css?v=<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/ibutton/jquery.ibutton.min.css" rel="stylesheet">

    
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array()); $_block_repeat=true; echo smarty_block_wa_js(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-1.11.1.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-migrate-1.2.1.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.core.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.widget.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.mouse.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.sortable.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/ibutton/jquery.ibutton.min.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/ace/ace.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.elrte.ace.js
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array()); $_block_repeat=true; echo smarty_block_wa_js(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.core.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.dialog.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.contentrouter.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.general.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.email.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.maps.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.captcha.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.push.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.sms.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.auth.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.field.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.field.edit.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.field.delete.confirm.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.regions.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.db.js
        <?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.db.list.dialog.js
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/css/wa-settings/settingsDialog.css?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
">
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa-settings/settings.dialog.js?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
"></script>

    
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_assets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['item']->value;?>

    <?php } ?>

    <?php echo $_smarty_tpl->tpl_vars['wa']->value->js();?>


</head>
<body><div id="wa">

    <?php echo $_smarty_tpl->tpl_vars['wa']->value->header();?>


    <div id="wa-app">
        <div class="s-main-wrapper" id="s-main-wrapper">

            
            <section class="s-sidebar-wrapper sidebar left200px" id="s-sidebar-wrapper">
                <?php echo $_smarty_tpl->tpl_vars['sidebar']->value;?>

            </section>

            
            <section class="s-content-wrapper content shadowed left200px">
                <div class="s-content-block" id="s-content-block">
                    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                </div>
            </section>
        </div>

    </div>
    <script>
        (function($) { "use strict";

            
            window.wa_app = <?php echo json_encode($_smarty_tpl->tpl_vars['wa']->value->app());?>
;
            
            window.wa_url = <?php echo json_encode($_smarty_tpl->tpl_vars['wa_url']->value);?>
;

            $.wa.content = new ContentRouter({
                $content: $("#s-content-block"),
                app_url: <?php echo json_encode(((string)$_smarty_tpl->tpl_vars['wa_backend_url']->value)."webasyst/settings/");?>

            });
        })(jQuery);
    </script>
</body>
</html><?php }} ?>