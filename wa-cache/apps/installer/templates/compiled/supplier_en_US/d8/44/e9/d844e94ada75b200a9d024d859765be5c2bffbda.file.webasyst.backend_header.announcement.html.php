<?php /* Smarty version Smarty-3.1.14, created on 2020-10-12 20:21:35
         compiled from "Z:\home\shop.tst\www\wa-apps\installer\lib\handlers\templates\webasyst.backend_header.announcement.html" */ ?>
<?php /*%%SmartyHeaderCode:160335f84909fc9ef80-87432360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd844e94ada75b200a9d024d859765be5c2bffbda' => 
    array (
      0 => 'Z:\\home\\shop.tst\\www\\wa-apps\\installer\\lib\\handlers\\templates\\webasyst.backend_header.announcement.html',
      1 => 1555584780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160335f84909fc9ef80-87432360',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'announcements' => 0,
    '_key' => 0,
    '_a' => 0,
    'wa_backend_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f84909fcd07c0_56725714',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84909fcd07c0_56725714')) {function content_5f84909fcd07c0_56725714($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['announcements']->value){?>
    <div class="js-wa-announcement-wrap">
        <style>
            .wa-announcement {
                position: relative; padding: 0;
                background-image: initial; background-color: #4e4d12; box-shadow: rgba(13, 13, 13, 0.13) 0px 1px 3px -1px;
                background: #ffd; font-size: 0.9em;
                border-bottom: 1px solid silver;
            }
            .wa-announcement a.wa-announcement-close {
                float: right; display: inline-block;
                margin-right: 12px; margin-top: 7px; margin-left: 13px;
                font-size: 1.6em; color: #c2bf94; text-decoration-color: initial; text-decoration: none;
            }
            .wa-announcement .wa-announcement-content { padding: .75rem 2.5rem .75rem 5%; }
        </style>

        <?php  $_smarty_tpl->tpl_vars['_a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_a']->_loop = false;
 $_smarty_tpl->tpl_vars['_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_a']->key => $_smarty_tpl->tpl_vars['_a']->value){
$_smarty_tpl->tpl_vars['_a']->_loop = true;
 $_smarty_tpl->tpl_vars['_key']->value = $_smarty_tpl->tpl_vars['_a']->key;
?>
            <div class="wa-announcement js-wa-announcement">
                <a title="close" class="wa-announcement-close js-announcement-close" href="javascript:void(0);" rel="installer" data-key="<?php echo $_smarty_tpl->tpl_vars['_key']->value;?>
">×</a>
                <?php echo $_smarty_tpl->tpl_vars['_a']->value['value'];?>

            </div>
        <?php } ?>
    </div>
<?php }?>

<script>
$(function() {
    <?php if ($_smarty_tpl->tpl_vars['announcements']->value){?>
        $('.js-announcement-close').unbind('click').bind('click', function() {
            $.post('<?php echo $_smarty_tpl->tpl_vars['wa_backend_url']->value;?>
installer/?module=announcement&action=hide', {
                key: $(this).data('key')
            });
            $(this).closest('.js-wa-announcement').remove();
            return false;
        });
    <?php }?>
});
</script>
<?php }} ?>