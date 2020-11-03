<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:14
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/installer/lib/handlers/templates/webasyst.backend_header.announcement.html" */ ?>
<?php /*%%SmartyHeaderCode:8540972505f98075a5f3eb7-38903190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9a2f877013e0ce8b6a8e716efb28a3081096591' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/installer/lib/handlers/templates/webasyst.backend_header.announcement.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8540972505f98075a5f3eb7-38903190',
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
  'unifunc' => 'content_5f98075a62b5b4_83595480',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075a62b5b4_83595480')) {function content_5f98075a62b5b4_83595480($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['announcements']->value){?>
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