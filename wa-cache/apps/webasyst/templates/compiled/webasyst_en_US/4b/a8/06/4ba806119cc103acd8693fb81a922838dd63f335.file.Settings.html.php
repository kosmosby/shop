<?php /* Smarty version Smarty-3.1.14, created on 2020-10-12 19:10:24
         compiled from "Z:\home\shop.tst\www\wa-system\webasyst\templates\actions\settings\Settings.html" */ ?>
<?php /*%%SmartyHeaderCode:260725f847ff02e0971-22147099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ba806119cc103acd8693fb81a922838dd63f335' => 
    array (
      0 => 'Z:\\home\\shop.tst\\www\\wa-system\\webasyst\\templates\\actions\\settings\\Settings.html',
      1 => 1574838290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260725f847ff02e0971-22147099',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'settings' => 0,
    'locales' => 0,
    '_locale' => 0,
    '_locale_name' => 0,
    'locale_adapter' => 0,
    'locale_adapters_list' => 0,
    '_adapter' => 0,
    '_name' => 0,
    'config' => 0,
    'framework_version' => 0,
    'php_version' => 0,
    'is_good_php_version' => 0,
    'wa_app_url' => 0,
    '_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f847ff123b565_21148033',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f847ff123b565_21148033')) {function content_5f847ff123b565_21148033($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['_title'] = new Smarty_variable("General settings — ".((string)$_smarty_tpl->tpl_vars['wa']->value->accountName(false)), null, 0);?>
<div class="s-general-settings-page blank block double-padded" id="s-general-settings-page">
    <h1 class="s-page-header">General settings</h1>
    <div class="s-general-settings-fields-block">
        <form action="?module=settingsGeneralSave">
            <div class="field-group">
                
                <div class="field">
                    <div class="name">
                        <label for="config-name">Company name</label>
                    </div>
                    <div class="value">
                        <input type="text" class="large" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" id="config-name" autocomplete="off">
                        <br>
                        <span class="hint">May be displayed on websites and in email notifications.</span>
                        <br>
                        <span class="hint s-error js-error-place"></span>
                    </div>
                </div>

                
                <div class="field">
                    <div class="name">
                        <label for="config-url">Website address</label>
                    </div>
                    <div class="value">
                        <input type="text" name="url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" id="config-url" autocomplete="off">
                        <br>
                        <span class="hint">May be used on websites and in email notifications.</span>
                        <br>
                        <span class="hint s-error js-error-place"></span>
                    </div>
                </div>

                
                <?php if ($_smarty_tpl->tpl_vars['locales']->value){?>
                    <div class="field">
                        <div class="name">
                            <label for="config-locale">Locale of software available for installation</label>
                        </div>
                        <div class="value no-shift">
                            <select name="locale" id="config-locale">
                                <?php  $_smarty_tpl->tpl_vars['_locale_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_locale_name']->_loop = false;
 $_smarty_tpl->tpl_vars['_locale'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['locales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_locale_name']->key => $_smarty_tpl->tpl_vars['_locale_name']->value){
$_smarty_tpl->tpl_vars['_locale_name']->_loop = true;
 $_smarty_tpl->tpl_vars['_locale']->value = $_smarty_tpl->tpl_vars['_locale_name']->key;
?>
                                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_locale']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->tpl_vars['settings']->value['locale']==$_smarty_tpl->tpl_vars['_locale']->value){?> selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_locale_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php }?>

                
                <?php if ($_smarty_tpl->tpl_vars['locale_adapter']->value!==false){?>
                    <div class="field">
                        <div class="name">Localization engine</div>
                        <div class="value no-shift">
                            <select name="locale_adapter">
                                <?php  $_smarty_tpl->tpl_vars['_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_name']->_loop = false;
 $_smarty_tpl->tpl_vars['_adapter'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['locale_adapters_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_name']->key => $_smarty_tpl->tpl_vars['_name']->value){
$_smarty_tpl->tpl_vars['_name']->_loop = true;
 $_smarty_tpl->tpl_vars['_adapter']->value = $_smarty_tpl->tpl_vars['_name']->key;
?>
                                    <option<?php if ($_smarty_tpl->tpl_vars['_adapter']->value==$_smarty_tpl->tpl_vars['locale_adapter']->value){?> selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['_adapter']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['_name']->value;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php }?>
                
                <div class="field">
                    <div class="name">Clear cache</div>
                    <div class="value">
                        <input type="button" class="js-clear-cache button gray" value="Clear cache">
                        <i class="icon16 loading js-cache-loading" style="display: none;"></i>
                    </div>
                    <div class="value hint">
                        Cache is temporary data that help reduce extensive load on your server. Clear cache to update those data, if you have encountered a malfunction.
                        <br><br>
                    </div>
                </div>

                
                <div class="field">
                    <div class="name">For developers</div>
                    <div class="value">
                        <input type="checkbox" name="config[debug]" value="1"<?php if (isset($_smarty_tpl->tpl_vars['config']->value['debug'])&&$_smarty_tpl->tpl_vars['config']->value['debug']){?> checked="checked"<?php }?> id="config-debug-checkbox">
                        <label for="config-debug-checkbox">
                            <span>Developer mode</span>
                            <div class="hint">Debug mode disables caching and enables verbose error messages. Recommended for debugging and during software development.</div>
                        </label>
                    </div>
                </div>

                
                <div class="field">
                    <div class="name">
                        Webasyst version
                    </div>
                    <div class="value no-shift"><?php echo $_smarty_tpl->tpl_vars['framework_version']->value;?>
</div>
                </div>

                
                <div class="field">
                    <div class="name">
                        PHP version
                    </div>
                    <div class="value no-shift"><?php echo $_smarty_tpl->tpl_vars['php_version']->value;?>
</div>
                    <?php if (!$_smarty_tpl->tpl_vars['is_good_php_version']->value){?>
                        <div class="value no-shift bold">Webasyst is moving to PHP versions 5.6 and higher.</div>
                    <?php }?>
                </div>
            </div>

            <div class="s-form-buttons">
                <div class="s-footer-actions js-footer-actions">
                    <input class="button green js-submit-button" type="submit" name="" value="Save">
                    <span class="s-hidden">
                        <span style="margin: 0 4px;">or</span>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
webasyst/settings" class="js-cancel">cancel</a>
                    </span>
                    <i class="icon16 loading s-loading" style="display: none;"></i>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    (function($) {
        new WASettingsGeneral({
            $wrapper: $('#s-general-settings-page')
        });
        $.wa.setTitle(<?php echo json_encode($_smarty_tpl->tpl_vars['_title']->value);?>
);
    })(jQuery);
</script><?php }} ?>