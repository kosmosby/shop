<?php /* Smarty version Smarty-3.1.14, created on 2020-11-03 11:48:38
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/supplier/templates/actions/backend/BackendDefault.html" */ ?>
<?php /*%%SmartyHeaderCode:870087715f97ff3308b7c2-68312350%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfeed45c7175c3ce7b18550ef230185817084447' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/supplier/templates/actions/backend/BackendDefault.html',
      1 => 1604393317,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '870087715f97ff3308b7c2-68312350',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f97ff3329da24_57938558',
  'variables' => 
  array (
    'wa' => 0,
    'wa_url' => 0,
    'profile_id' => 0,
    'settings' => 0,
    'finfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f97ff3329da24_57938558')) {function content_5f97ff3329da24_57938558($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_smarty_tpl->tpl_vars['wa']->value->appName();?>
 - <?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</title>
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>



    <script src="/wa-content/js/jquery/jquery-1.11.1.min.js"></script>

    <script type="text/javascript" src="/wa-content/js/jquery-ui/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="/wa-content/js/jquery-ui/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="/wa-content/js/jquery-ui/jquery.ui.mouse.min.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/tooltipster.bundle.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/import.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/css/jquery-ui/ui-lightness/jquery.ui.slider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/jquery.formstyler.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/jquery.formstyler.theme.css"/>

     <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.slider.min.js"></script>

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/fileupload/jquery.fileupload.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/js/jquery.formstyler.min.js"></script>z
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/supplier/js/import.js"></script>

</head>
<body>
<div id="wa">
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->header();?>

    <div id="wa-app">

            <div id="yml">

                <div class="fields form tab-content" id="profile-content">

                    <?php if (!empty($_smarty_tpl->tpl_vars['profile_id']->value)){?>
                    <span class="delete-profile" data-id="<?php echo $_smarty_tpl->tpl_vars['profile_id']->value;?>
">
                    <i class="icon16 no"></i> Удалить профиль
                </span>
                    <?php }?>

                    <form action="?plugin=yml&module=backend&action=save" id="importform" method="POST">

                        <div class="field no-border">
                            <div class="name special-padd">Файл</div>
                            <div class="value">

                                <div class="sources">
                                    <div class="sources-head">
                                        <span class="sh-col<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['source_type'])||($_smarty_tpl->tpl_vars['settings']->value['source_type']=='remote')){?> active<?php }?>" data-type="remote">Ссылка</span>
                                        <span class="sh-col<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['source_type'])=='local'){?> active<?php }?>" data-type="local">С компьютера</span>
                                        <span class="sh-col<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['source_type'])=='server'){?> active<?php }?>" data-type="server">С сервера</span>

                                        <input type="hidden" name="settings[source_type]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['source_type']);?>
">
                                    </div>
                                    <div class="source-tabs">
                                        <div class="source-tab remote<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['source_type'])||($_smarty_tpl->tpl_vars['settings']->value['source_type']=='remote')){?> active<?php }?>">
                                            <input type="text" class="std" name="settings[url]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['url'])){?> value="<?php echo $_smarty_tpl->tpl_vars['settings']->value['url'];?>
"<?php }?>/>

                                            <div class="yml-auth" id="yml-auth">
                                                <input type="checkbox" class="iButton no_highlight" name="settings[http_auth]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['http_auth'])){?> checked<?php }?>>
                                                HTTP авторизация

                                                <div class="yml-auth-data"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['http_auth'])){?> style="display: none"<?php }?>>
                                                <span class="hint">Логин:</span>
                                                <input type="text" class="short" name="settings[http_login]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['http_login'],'');?>
" style="margin-right: 15px">

                                                <span class="hint">Пароль:</span>
                                                <input type="password" class="short" name="settings[http_pass]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['http_pass'],'');?>
">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="source-tab local<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['source_type'])=='local'){?> active<?php }?>">
                                        <div class="server-col left" style="width: 210px">
                                            <input type="file" name="yml_file" id="local-source-file">

                                            <div class="progress" style="display: none;">
                                                <div class="progress-bar" style="width: 0"></div>
                                            </div>
                                        </div>

                                        <?php $_smarty_tpl->tpl_vars['finfo'] = new Smarty_variable(shopYmlPlugin::pathInfo(ifempty($_smarty_tpl->tpl_vars['settings']->value['local.file'])), null, 0);?>
                                        <div class="server-col right"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['local.file'])){?> style="display:none"<?php }?>>
                                        <span class="server-file file" style="margin-top: 4px">
                                            <span class="server-file-name" title="<?php echo ifempty($_smarty_tpl->tpl_vars['finfo']->value['basename'],'');?>
"><?php echo smarty_modifier_truncate(ifempty($_smarty_tpl->tpl_vars['finfo']->value['basename'],''),35,'..');?>
</span>
                                            <span class="server-file-size"><?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['local.file.size']);?>
</span>

                                            <span class="yml-delete-file" title="Удaлить"><i class="icon16 delete"></i></span>
                                        </span>
                                    </div>

                                </div>

                                <div class="source-tab server<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['source_type'])=='server'){?> active<?php }?>">
                                    <div class="server-col left" style="width: 120px">
                                        <button type="button" class="button mini yellow"><?php if (empty($_smarty_tpl->tpl_vars['settings']->value['server.file'])){?>Выбрать<?php }else{ ?>Сменить<?php }?></button>
                                    </div>

                                    <div class="server-col right"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['server.file'])){?> style="display:none"<?php }?>>
                                    <?php $_smarty_tpl->tpl_vars['finfo'] = new Smarty_variable(shopYmlPlugin::pathInfo(ifempty($_smarty_tpl->tpl_vars['settings']->value['server.file'])), null, 0);?>
                                    <span class="server-file path">
                                                    <?php echo ifempty($_smarty_tpl->tpl_vars['finfo']->value['dirname'],'');?>

                                                </span>

                                    <span class="server-file file">
                                            <span class="server-file-name"><?php echo ifempty($_smarty_tpl->tpl_vars['finfo']->value['basename'],'');?>
</span>
                                            <span class="server-file-size"><?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['server.file'])){?><?php echo shopYmlPlugin::formatSize($_smarty_tpl->tpl_vars['settings']->value['server.file']);?>
<?php }?></span>

                                            <span class="yml-delete-file" title="Удалить"><i class="icon16 delete"></i></span>
                                            <input type="hidden" name="settings[server.file]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['server.file'],'');?>
">
                                        </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        <div class="field" style="padding-top: 0">
            <div class="name special-padd">Соответствия</div>
            <div class="value">
                <button class="yml-matches make-snapshot button yellow" type="button">
                    <i class="icon16 merge"></i>
                    <?php if (empty($_smarty_tpl->tpl_vars['settings']->value['matched'])){?>
                    Указать
                    <?php }else{ ?>
                    Изменить
                    <?php }?>
                </button>
            </div>
        </div>


    </div>
</div>


<div id="yml-dialog">
    <div class="yml-dialog-inner">
        <form name="yml-dialog-form">
            <div class="yml-dialog-header bg-gd-orange no-hover">
                <span class="yml-dialog-title"></span>

                <div class="yml-dialog-buttons">
                    
                </div>

            </div>

            <div class="yml-dialog-content">
                <div class="yml-loader-wrap">
                </div>
            </div>

            
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/supplier/js/import.js"></script>
</body>
</html>
<?php }} ?>