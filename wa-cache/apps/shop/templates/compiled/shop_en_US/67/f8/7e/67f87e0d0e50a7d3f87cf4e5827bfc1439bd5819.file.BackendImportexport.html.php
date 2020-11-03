<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:17
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/backend/BackendImportexport.html" */ ?>
<?php /*%%SmartyHeaderCode:20189218045f98075df3b904-19016174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67f87e0d0e50a7d3f87cf4e5827bfc1439bd5819' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/backend/BackendImportexport.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20189218045f98075df3b904-19016174',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'plugins' => 0,
    'info' => 0,
    'wa_url' => 0,
    'wa_backend_url' => 0,
    'wa_app_static_url' => 0,
    'wa' => 0,
    'plugin_names' => 0,
    'plugin_profiles' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075e13d911_29133025',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075e13d911_29133025')) {function content_5f98075e13d911_29133025($_smarty_tpl) {?><?php if (!is_callable('smarty_block_wa_js')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/block.wa_js.php';
?><div class="sidebar right15px">
    <div class="block s-nolevel2-sidebar"></div>
</div>
<div class="sidebar left15px">
    <div class="block s-nolevel2-sidebar"></div>
</div>

<?php $_smarty_tpl->tpl_vars['plugin_names'] = new Smarty_variable(array(), null, 0);?>

<div class="content left15px right15px s-nolevel2-box">

    <div class="sidebar left200px">
        <div class="s-inner-sidebar">
            <ul class="menu-v with-icons stack" id="s-importexport-menu">
                <li>
                    <a href="#/csv:product/">
                        <i class="icon16 ss excel"></i>Import products from CSV
                        <span class="hint">Add new and update existing products via CSV files</span>
                    </a>
                </li>
                
                <li>
                    <a href="#/images:product/">
                        <i class="icon16 pictures"></i>Bulk image upload
                        <span class="hint">Instantly create multiple products from a set of uploaded images</span>
                    </a>
                </li>
                
                <?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['plugins']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
?>
                <?php $_smarty_tpl->createLocalArrayVariable('plugin_names', null, 0);
$_smarty_tpl->tpl_vars['plugin_names']->value[$_smarty_tpl->tpl_vars['info']->value['id']] = htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['info']->value['name'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['info']->value['id'] : $tmp), ENT_QUOTES, 'UTF-8', true);?>
                <li>
                    <a href="#/<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
<?php if (isset($_smarty_tpl->tpl_vars['info']->value['default_profile'])){?>:<?php echo $_smarty_tpl->tpl_vars['info']->value['default_profile'];?>
<?php }?>/">
                        <?php if (empty($_smarty_tpl->tpl_vars['info']->value['img'])){?><i class="icon16 <?php echo (($tmp = @$_smarty_tpl->tpl_vars['info']->value['icon'])===null||$tmp==='' ? 'plugins' : $tmp);?>
"></i><?php }else{ ?><i class="icon16" style="background: url('<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['img'], ENT_QUOTES, 'UTF-8', true);?>
');"></i><?php }?><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['info']->value['name'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['info']->value['id'] : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                        <span class="hint"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['info']->value['description'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <div class="align-center hint hr block double-padded">
                <p>
                    <a href="#/plugins/" data-url="<?php echo $_smarty_tpl->tpl_vars['wa_backend_url']->value;?>
installer/#/plugins&amp;tag=importexport/shop/" class="bold">Browse import/export plugins</a><br>
                    Install new plugins from the Webasyst Store using the Installer app
                </p>
            </div>

        </div>
    </div>
    <div class="content left200px blank bordered-left">
        <div class="block double-padded" id="s-importexport-header">
        <h1><!-- title placeholder --></h1>
        <p><!-- description placeholder --></p>
        </div>

        <ul class="tabs s-export-profile-list" id="s-importexport-profile" style="display: none; padding-left: 10px;">
            <li class="no-tab float-right small delete-link-wrapper" style="display: none;"><a href="#/profile/delete/" data-href="#/profile/delete/%plugin%/" class="js-action js-confirm" data-confirm-text="Delete current profile settings and all its exported files?"><i class="icon16 delete"></i>Delete this profile</a></li>
            <li class="no-tab"><a href="#/profile/add/" data-href="#/profile/add/%plugin%/" class="js-action"><i class="icon16 add"></i>New profile</a></li>
        </ul>
        <div id="s-importexport-content">
            <div class="block double-padded"><?php if ($_smarty_tpl->tpl_vars['plugins']->value){?>Loading...<i class="icon16 loading"></i><?php }?></div>
            <div class="clear-both"></div>
        </div>
    </div>

    <div class="clear-both"></div>
</div>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array('file'=>"js/importexport/importexport.min.js")); $_block_repeat=true; echo smarty_block_wa_js(array('file'=>"js/importexport/importexport.min.js"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/importexport/importexport.js
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array('file'=>"js/importexport/importexport.min.js"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<script type="text/javascript">
document.title = '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName(false);?>
<?php $_tmp1=ob_get_clean();?><?php echo strtr(("Import / Export").(" — ").($_tmp1), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
$.importexport.init({
    debug:<?php echo var_export(waSystemConfig::isDebug(),true);?>
,
    loading : '<div class="block double-padded">Loading...<i class="icon16 loading"><'+'/i><'+'/div><div class="clear"><'+'/div>',
    title_suffix: '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName(false);?>
<?php $_tmp2=ob_get_clean();?><?php echo strtr((" — ").($_tmp2), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    plugin_names: <?php echo json_encode($_smarty_tpl->tpl_vars['plugin_names']->value);?>
,
    plugin_profiles: <?php echo json_encode($_smarty_tpl->tpl_vars['plugin_profiles']->value);?>
,
    backend_url:'<?php echo strtr($_smarty_tpl->tpl_vars['wa_backend_url']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'
});
</script><?php }} ?>