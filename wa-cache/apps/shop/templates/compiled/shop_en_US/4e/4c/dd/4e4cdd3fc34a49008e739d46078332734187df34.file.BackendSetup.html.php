<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:21
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/plugins/yml/templates/actions/backend/BackendSetup.html" */ ?>
<?php /*%%SmartyHeaderCode:2814443065f980761c89d21-36149029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e4cdd3fc34a49008e739d46078332734187df34' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/plugins/yml/templates/actions/backend/BackendSetup.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2814443065f980761c89d21-36149029',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa_url' => 0,
    'version' => 0,
    'profile_id' => 0,
    'default_title' => 0,
    'profiles' => 0,
    'p_id' => 0,
    'p' => 0,
    'settings' => 0,
    'finfo' => 0,
    'types' => 0,
    't' => 0,
    'categories' => 0,
    'category' => 0,
    'separator' => 0,
    'markup_type' => 0,
    'markup' => 0,
    'm_id' => 0,
    'm' => 0,
    'features' => 0,
    'f' => 0,
    'session' => 0,
    'root_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98076252d521_31184826',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98076252d521_31184826')) {function content_5f98076252d521_31184826($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_wa_datetime')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/tooltipster.bundle.min.css?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/import.css?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/css/jquery-ui/ui-lightness/jquery.ui.slider.css?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/jquery.formstyler.css?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/css/jquery.formstyler.theme.css?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"/>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/js/tooltipster.bundle.min.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.slider.min.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/fileupload/jquery.iframe-transport.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"></script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/fileupload/jquery.fileupload.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/js/jquery.formstyler.min.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/yml/js/import.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"></script>

<div id="yml">

    <div class="profiles">

        <div class="profile-nav">
            <span class="profile-nav-button prev" data-direction="left">&larr;</span>
            <span class="profile-nav-button next" data-direction="right">&rarr;</span>
        </div>

        <ul class="tabs">
            <li <?php if (!$_smarty_tpl->tpl_vars['profile_id']->value){?>class="selected"<?php }?> id="default-profile">
                <a href="#/yml/">
                    <?php echo ifempty($_smarty_tpl->tpl_vars['default_title']->value,'Профиль 1');?>

                </a>
            </li>

            <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['p_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['profiles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p_id']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
                <li data-id="<?php echo $_smarty_tpl->tpl_vars['p_id']->value;?>
" id="profile<?php echo $_smarty_tpl->tpl_vars['p_id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['profile_id']->value==$_smarty_tpl->tpl_vars['p_id']->value){?> class="selected"<?php }?>>
                    <a href="#/yml:<?php echo $_smarty_tpl->tpl_vars['p_id']->value;?>
/">
                        <?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>

                    </a>
                </li>
            <?php } ?>

            <li class="no-tab add-profile">
                <a href="#">
                    <i class="icon16 add"></i>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="fields form tab-content" id="profile-content">
        
        <?php if (!empty($_smarty_tpl->tpl_vars['profile_id']->value)){?>
            <span class="delete-profile" data-id="<?php echo $_smarty_tpl->tpl_vars['profile_id']->value;?>
">
                <i class="icon16 no"></i> Удалить профиль
            </span>
        <?php }?>
        
        <form action="?plugin=yml&module=backend&action=save" id="importform" method="POST">
            
            <div class="field" id="profile-name">
                <div class="name special-padd">Название профиля</div>
                <div class="value">
                    <input type="text" class="std" name="settings[name]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['name'],'Без названия');?>
">
                </div>
            </div>

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
                    </div>
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
            
            <div class="field">
                <div class="name">Тип товаров</div>
                <div class="value">
                    <?php if (!empty($_smarty_tpl->tpl_vars['types']->value)){?>
                        <select name="settings[product_type]">
                            <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                                <option<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['product_type'])==$_smarty_tpl->tpl_vars['t']->value['id']){?> selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['t']->value['id'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['t']->value['name'];?>

                                </option>
                            <?php } ?>
                        </select>
                    <?php }?>
                </div>
            </div>
            
            <div class="field">
                <div class="name special-padd">
                    Принадлежность к профилю
                </div>
                
                <div class="value">
                    <ul class="menu-h" style="display:inline-block">
                        <li>Нет</li>
                        
                        <li>
                            <input type="checkbox" class="iButton" value="1" name="settings[bind_to_profile]"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['bind_to_profile'])){?> checked<?php }?>>
                        </li>
                        
                        <li>Да</li>
                    </ul>
                    
                    <div>
                        <span class="hint">
                           <i class="icon16 info"></i>
                           Включите если у вас будут синхронизироватся несколько файлов в которых могут быть товары с одинаковым внешним идентификатором.
                        </span>
                    </div>
                    
                </div>
            </div>
            
            <div class="field">
                <div class="name special-padd">
                    Импортировать категории
                </div>
                
                <div class="value">
                    <ul class="menu-h" style="display:inline-block">
                        <li>Нет</li>
                        
                        <li>
                            <input type="checkbox" class="iButton categs" value="1" id="importCategs" name="settings[import_categories]"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['import_categories'])){?> checked<?php }?>>
                        </li>
                        
                        <li>Да</li>
                    </ul>
                </div>
            </div>

            <div class="field fix-jq-margin" id="category-settings"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['import_categories'])){?> style="display: none"<?php }?>>
                <div class="name">Принадлежность товаров к категориям:</div>
                <div class="value">
                    <label <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==1){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[category]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==1){?> checked="checked"<?php }?> value="1"/>
                        Удалять из старых и добавлять в новые
                    </label>
                        <br /> 
                    <label <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==2){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[category]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==2){?> checked="checked"<?php }?> value="2"/>
                        Оставлять старые и добавлять в новые
                    </label> 
                        <br />
                    <label <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==3){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[category]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==3){?> checked="checked"<?php }?> value="3"/>
                        Устанавливать только для новых товаров
                    </label>
                        <br />
                    <label <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==4){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[category]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['category'])&&$_smarty_tpl->tpl_vars['settings']->value['category']==4){?> checked="checked"<?php }?> value="4"/>
                        Не устанавливать
                    </label>
                    <br /> <br />
                    <label id="duplicate_as_child">
                        <input class="no_highlight" type="checkbox" name="settings[duplicate_as_child]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['duplicate_as_child'])){?> checked<?php }?> value="1"/>
                        Загрузить структуру категорий в отдельную категорию на сайте
                    </label>
                    
                    <div style="margin-top:14px;<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['duplicate_as_child'])){?> display:none<?php }?>" id="parent-category">
                        <label style="display:block;margin-bottom:4px;font-size: 13px">Выберите родительскую категорию:</label>
                        
                        <select name="settings[parent_id]">
                            <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['parent_id'])==$_smarty_tpl->tpl_vars['category']->value['id']){?> selected<?php }?>>
                                    <?php echo str_repeat("-",$_smarty_tpl->tpl_vars['category']->value['depth']);?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="name special-padd">Ручное сопоставление категорий <span class="beta">(beta)</span></div>
                <div class="value">

                    <ul class="menu-h" style="display:inline-block">
                        <li>Нет</li>

                        <li>
                            <input type="checkbox" class="iButton" value="1" id="allowCategMap" name="settings[allow_categ_map]"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['allow_categ_map'])){?> checked<?php }?>>
                        </li>

                        <li>Да</li>
                    </ul>

                    <div id="match-categories" <?php if (empty($_smarty_tpl->tpl_vars['settings']->value['allow_categ_map'])){?>style="display: none"<?php }?>>
                        <input type="button" class="button yellow" value="Сопоставить категории">
                    </div>
                </div>
            </div>
            
            <div class="field">
                <div class="name">Добавлять новые товары в категорию</div>
                <div class="value">
                    <select name="settings[new_parent_id]">
                        <option value="0">Не добавлять</option>
                        <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['new_parent_id'])==$_smarty_tpl->tpl_vars['category']->value['id']){?> selected<?php }?>>
                                <?php echo str_repeat("-",$_smarty_tpl->tpl_vars['category']->value['depth']);?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="field">
                <div class="name">Обнулять склады не обновлённые плагином</div>
                <div class="value">
                    <ul class="menu-h" style="display:inline-block">
                        <li>Нет</li>

                        <li>
                            <input type="checkbox" class="iButton" value="1" id="reset_stocks" name="settings[reset_stocks]"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['reset_stocks'])){?> checked<?php }?>>
                        </li>

                        <li>Да</li>
                    </ul>

                    <span class="hint">
                        <i class="icon16 info"></i> Если вы загружаете остатки в определённый склад, то друие склады будут обнулены. Чтобы другие склады не менялизначение отключите эту опцию.
                    </span>
                </div>
            </div>
            
            <div class="field">
                <div class="name">Изображения товаров</div>
                <div class="value fix-jq-margin">
                    <label <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['images'])==1){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[images]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['images'])&&$_smarty_tpl->tpl_vars['settings']->value['images']==1){?> checked="checked"<?php }?> value="1"/>
                        Удалять старые и добавлять новые
                    </label>
                        <br />
                    <label <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['images'])==2){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[images]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['images'])&&$_smarty_tpl->tpl_vars['settings']->value['images']==2){?> checked="checked"<?php }?> value="2"/>
                        Добавлять только новые
                    </label> 
                        <br />
                    <label <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['images'])==3){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[images]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['images'])&&$_smarty_tpl->tpl_vars['settings']->value['images']==3){?> checked="checked"<?php }?> value="3"/>
                        Скачивать только для новых товаров
                    </label>
                        <br />
                    <label <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['images'])==4){?> class="checkedinput"<?php }?>>
                        <input type="radio" name="settings[images]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['images'])&&$_smarty_tpl->tpl_vars['settings']->value['images']==4){?> checked="checked"<?php }?> value="4"/>
                        Не скачивать изображения
                    </label>

                    <div class="img_separator">
                        <?php $_smarty_tpl->tpl_vars['separator'] = new Smarty_variable(ifempty($_smarty_tpl->tpl_vars['settings']->value['link_separator']), null, 0);?>
                        Разделитель ссылок на изображения: <select name="settings[link_separator]">
                            <option value="0">Нет</option>
                            <option value="1"<?php if ($_smarty_tpl->tpl_vars['separator']->value==='1'){?> selected<?php }?>>Запятая (,)</option>
                            <option value="2"<?php if ($_smarty_tpl->tpl_vars['separator']->value==='2'){?> selected<?php }?>>Точка с зап. (;)</option>
                            <option value="3"<?php if ($_smarty_tpl->tpl_vars['separator']->value==='3'){?> selected<?php }?>>Пробел</option>
                        </select>

                        <br>
                        <span class="hint">
                            <i class="icon16 info"></i>
                             По умолчанию, плагин воспринимает каждое значение тега/артибута как отдельную прямую ссылку на изображение. Но иногда ссылки указаны в одном теге разделённые к примеру запятой.
                        </span>
                    </div>

                    <div class="images_nr" style="margin-top:17px">
                        Макс. количество изображений: <input type="text" class="short" name="settings[max_img]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['max_img'],'');?>
">
                    </div>
                </div>
            </div>
            
            <div class="field">
                <div class="name">Наценка</div>
                <div class="value">
                    
                    <div class="yml-markup">
                        <div class="yml-markup-types">
                            <label data-id="">
                                <input type="radio" name="settings[markup_type]" value="0"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['markup_type'])){?> checked<?php }?>> Нет
                            </label>                            
                            
                            <label data-id="fixed">
                                <input type="radio" name="settings[markup_type]" value="1"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['markup_type'])=='1'){?> checked<?php }?>> Фиксированная
                            </label>
                            
                            <label data-id="stepped">
                                <input type="radio" name="settings[markup_type]" value="2"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['markup_type'])=='2'){?> checked<?php }?>> Ступенчатая
                            </label>
                        </div>
    
                        <div class="yml-markup-content">
                            <?php $_smarty_tpl->tpl_vars['markup_type'] = new Smarty_variable(ifempty($_smarty_tpl->tpl_vars['settings']->value['markup_type'],'0'), null, 0);?>
                            <div id="yml-markup-fixed" class="yml-markup-tab yml-fixed"<?php if ($_smarty_tpl->tpl_vars['markup_type']->value!=='1'){?> style="display:none"<?php }?>>
                                <input type="text" name="settings[price_up]" class="short" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['price_up'],0);?>
">
                                <select name="settings[type_of_markup]">
                                        <option value="0"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['type_of_markup'])){?> selected<?php }?>>Сумма</option>
                                        <option value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['type_of_markup'])){?> selected<?php }?>>Процент</option>
                                 </select>
                            </div>
                            
                            <div id="yml-markup-stepped" class="yml-markup-tab yml-stepped"<?php if ($_smarty_tpl->tpl_vars['markup_type']->value!=='2'){?> style="display:none"<?php }?>>
                                
                                <div class="yml-stepped-header">
                                    <span class="step-header-col">
                                        Цена
                                    </span>
                                    
                                    <span class="step-header-col">
                                        Наценка
                                    </span>
                                    
                                    <span class="step-header-col">
                                        Тип
                                    </span>
                                    
                                    <span class="stepped-markup-add"><i class="icon16 add"></i></span>
                                </div>
                                
                                <div class="yml-stepped-body">
                                    <?php if (!empty($_smarty_tpl->tpl_vars['markup']->value)){?>
                                        <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_smarty_tpl->tpl_vars['m_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['markup']->value['steps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
$_smarty_tpl->tpl_vars['m']->_loop = true;
 $_smarty_tpl->tpl_vars['m_id']->value = $_smarty_tpl->tpl_vars['m']->key;
?>
                                            <div class="yml-stepped-row" data-id="<?php echo $_smarty_tpl->tpl_vars['m_id']->value;?>
">
                                                <span class="step-body-col">
                                                    <i>до</i> &nbsp;<input type="text" name="stepped_markup[<?php echo $_smarty_tpl->tpl_vars['m_id']->value;?>
][limit]" value="<?php echo $_smarty_tpl->tpl_vars['m']->value['limit'];?>
">
                                                </span>
                                                
                                                <span class="step-body-col">
                                                    <input type="text" name="stepped_markup[<?php echo $_smarty_tpl->tpl_vars['m_id']->value;?>
][rate]" value="<?php echo $_smarty_tpl->tpl_vars['m']->value['rate'];?>
">
                                                </span>
                                                
                                                <span class="step-body-col">
                                                    <select name="stepped_markup[<?php echo $_smarty_tpl->tpl_vars['m_id']->value;?>
][type]">
                                                        <option value="0"<?php if ($_smarty_tpl->tpl_vars['m']->value['type']=='0'){?> selected<?php }?>>Сумма</option>
                                                        <option value="1"<?php if ($_smarty_tpl->tpl_vars['m']->value['type']=='1'){?> selected<?php }?>>Процент</option>
                                                    </select>
                                                </span>
                                                
                                                <span class="markup-delete">
                                                    <i class="icon16 delete"></i>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    <?php }?>

                                    <div class="yml-stepped-row empty"<?php if (!empty($_smarty_tpl->tpl_vars['markup']->value['steps'])){?> style="display: none"<?php }?>>
                                            <span class="yml-markup-message">
                                                <i class="icon16 exclamation"></i> Правила не установлены
                                            </span>
                                    </div>

                                    <div class="yml-stepped-row step-default"<?php if (empty($_smarty_tpl->tpl_vars['markup']->value)){?> style="display: none"<?php }?>>
                                        <div class="step-default-label">В иных случаях:</div>

                                        <span class="step-body-col">
                                            <input type="text" name="stepped_default[rate]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['markup']->value['default']['rate'],'');?>
">
                                        </span>

                                        <span class="step-body-col">
                                            <select name="stepped_default[type]">
                                                <option value="0"<?php if (ifempty($_smarty_tpl->tpl_vars['markup']->value['default']['type'],'')==0){?> selected<?php }?>>Сумма</option>
                                                <option value="1"<?php if (ifempty($_smarty_tpl->tpl_vars['markup']->value['default']['type'],'')==1){?> selected<?php }?>>Процент</option>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="yml-stepped-row" id="stepped-template" style="display: none">
                                    <span class="step-body-col till">
                                        <i>до</i> &nbsp;<input type="text" data-key="limit">
                                    </span>
                                    
                                    <span class="step-body-col rate">
                                        <input type="text" data-key="rate">
                                    </span>
                                    
                                    <span class="step-body-col">
                                        <select data-key="type">
                                                <option value="1">Процент.</option>
                                                <option value="0">Фикс.</option>
                                        </select>
                                    </span>
                                    
                                    <span class="markup-delete">
                                        <i class="icon16 delete"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="floated-ibutton" style="margin-top: 15px">
                        <input type="checkbox" class="iButton" name="settings[convert_prices]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['convert_prices'])){?> checked="checked"<?php }?> value="1">
                        Конвертировать цены в основную валюту
                    </div>
                    
                </div>
            </div>
            
            <div class="field">
                <div class="name">
                    Название товара
                </div>
                
                <div class="value">
                   <label>
                      <input type="radio" name="settings[product_names]" value="1"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['product_names'])||$_smarty_tpl->tpl_vars['settings']->value['product_names']==1){?> checked<?php }?>>
                      Из одного тега
                   </label>
                   
                   <label style="margin-left: 20px">
                      <input type="radio" name="settings[product_names]" value="2"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['product_names'])==2){?> checked<?php }?>>
                      Из нескольких тегов <span class="hint">(typePrefix + vendor + model)</span>
                   </label>                   
                </div>
            </div>

            <div class="field">
                <div class="name">
                    Округлять цены до
                </div>

                <div class="value">
                    <select name="settings[round]">
                        <option value="0"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['round'])){?> selected<?php }?>>Не округлять</option>
                        <option value="1"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['round'])=='1'){?> selected<?php }?>>1</option>
                        <option value="5"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['round'])=='5'){?> selected<?php }?>>5</option>
                        <option value="10"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['round'])=='10'){?> selected<?php }?>>10</option>
                        <option value="100"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['round'])=='100'){?> selected<?php }?>>100</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <div class="name">
                    Ед. измерения веса
                </div>

                <div class="value">
                    <select name="settings[weight_unit]">
                        <option value="g"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['weight_unit'])=='g'){?> selected<?php }?>>г</option>
                        <option value="kg"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['weight_unit'])=='kg'){?> selected<?php }?>>кг</option>
                    </select>
                </div>
            </div>
            
            <div class="field">
                <div class="name">
                    Отмечать товары характеристикой
                </div>
                <div class="value" id="mark-with-feature">
                    <select name="settings[mark_feature]">
                        <option value="0">Не отмечать</option>
                        <?php if (!empty($_smarty_tpl->tpl_vars['features']->value)){?>
                            <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['f']->value['code'];?>
"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['mark_feature'])==$_smarty_tpl->tpl_vars['f']->value['code']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['f']->value['name'];?>
</option>
                            <?php } ?>
                        <?php }?>
                    </select>
                    <br><br>
                    
                    <input style="padding: 4px 6px; min-width: 120px;width: 120px;<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['mark_feature'])){?>display:none<?php }?>" type="text" name="settings[mark_value]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['mark_value']);?>
">
                </div>
            </div>
            
            <div class="field">
                <div class="name">Правила поиска</div>
                <div class="value">
                    <div class="value-w">
                        <div style="padding: 5px 0;font-size: 12px" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['searchbyname'])&&$_smarty_tpl->tpl_vars['settings']->value['searchbyname']==1){?> class="checkedinput"<?php }?>>Искать товары по наименованию:</div>
                        <ul class="menu-h" style="display:inline-block">
                            <li style="padding: 0;vertical-align: top;">Нет</li>
                            <li style="padding: 0;"><input type="checkbox" class="iButton x" name="settings[searchbyname]" <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['searchbyname'])==1){?> checked="checked"<?php }?> value="1"/></li>
                            <li class="istrue <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['searchbyname'])&&$_smarty_tpl->tpl_vars['settings']->value['searchbyname']==1){?>checkedinput<?php }?>" style="padding: 0;vertical-align: top;">Да</li>
                        </ul>
                    </div>

                    <div class="value-w float-right">
                        <div style="padding: 5px 0;font-size: 12px" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['searchbysku'])&&$_smarty_tpl->tpl_vars['settings']->value['searchbysku']==1){?> class="checkedinput"<?php }?>>Искать товары по артикулу:</div>
                        <ul class="menu-h" style="display:inline-block">
                            <li style="padding: 0;vertical-align: top;">Нет</li>
                            <li style="padding: 0;"><input type="checkbox" class="iButton x" name="settings[searchbysku]" <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['searchbysku'])==1){?> checked="checked"<?php }?> value="1"/></li>
                            <li class="istrue <?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['searchbysku'])==1){?>checkedinput<?php }?>" style="padding: 0;vertical-align: top;">Да</li>
                        </ul>
                    </div>

                    <div style="clear: both; width: 100%; height: 20px"></div>

                    <div class="floated-ibutton">
                        <input type="checkbox" class="iButton no_highlight" name="settings[skip_another_profiles]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['skip_another_profiles'])){?> checked<?php }?>>
                        <span class="yml-label">
                            Не сопоставлять с товарами других профилей
                            <span class="hint"></span>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="field">
                <div class="name">Другие настройки</div>
                <div class="value floated-ibutton">
                    <div>
                        <input type="checkbox" class="iButton no_highlight" name="settings[no_new_products]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['no_new_products'])){?> checked<?php }?>>
                        <span class="yml-label">
                            Не добавлять новые товары
                            <span class="hint">Пропускать новые товары обновляя только те которые были созданы ранее</span>
                        </span>
                    </div>
                    
                    <div>
                        <input type="checkbox" class="iButton no_highlight" name="settings[no_update_products]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['no_update_products'])){?> checked<?php }?>>
                        <span class="yml-label">
                            Не обновлять товары
                            <span class="hint">Пропускать товары которые были созданы ранее добавляя только новинки</span>
                        </span>
                    </div>
                    
                    <div>
                        <input type="checkbox" class="iButton no_highlight" name="settings[no_new_categs]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['no_new_categs'])){?> checked<?php }?>>
                        <span class="yml-label">Не добавлять новые категории
                            <span class="hint">Пропускать новые категории обновляя только те которые были созданы ранее</span>
                        </span>
                    </div>
                    
                    <div>
                        <input type="checkbox" class="iButton no_highlight" name="settings[no_update_categs]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['no_update_categs'])){?> checked<?php }?>>
                        <span class="yml-label">Не обновлять категории
                            <span class="hint">Пропускать категории которые были созданы ранее, добавляя новые</span>
                        </span>
                    </div>

                    <div>
                        <input type="checkbox" class="iButton no_highlight" name="settings[hide_excluded]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['hide_excluded'])){?> checked<?php }?>>
                        <span class="yml-label">Обнулять исчезнувшие товары
                            <span class="hint">Товары которые исчезнут из файла будут сняты с продажи
                        </span>
                    </div>
                    
                    <div id="enforce-protocol">
                        <input type="checkbox" class="iButton no_highlight" name="settings[enforce_protocol]" value="1"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['enforce_protocol'])){?> checked<?php }?>>
                        <span class="yml-label">Протокол в ссылках на изображения
                            <span class="hint">Данная опция позволяет заменять протокол доступа к изображениям (например с http на https)</span>
                        </span>
                        
                        <div class="enforce-option" style="margin-top: 10px; font-size: 0.9em;<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['enforce_protocol'])){?>display:none<?php }?>">
                            Выберите протокол:
                            <select name="settings[enforce_protocol_option]">
                                <option value="1"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['enforce_protocol_option'])||($_smarty_tpl->tpl_vars['settings']->value['enforce_protocol_option']=='1')){?> selected<?php }?>>https</option>
                                <option value="2"<?php if (ifempty($_smarty_tpl->tpl_vars['settings']->value['enforce_protocol_option'])=='2'){?> selected<?php }?>>http</option>
                            </select>
                        </div>
                    </div>

                    <div id="yml-slider">
                        <input type="checkbox" class="iButton" value="1" name="settings[limit_stream]"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['limit_stream'])){?> checked<?php }?>>

                        <span class="yml-label">
                            Ограничить поток

                            <span class="hint">
                                Ограничение рабочего процесса для устранения 500'ых ошибок.
                            </span>
                        </span>

                        <div class="yml-slider-value"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['limit_stream'])){?> style="display: none"<?php }?>>
                            <span id="slider-value">
                                <?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['stream_value'],40);?>

                            </span>

                            <input type="hidden" name="settings[stream_value]" value="<?php echo ifempty($_smarty_tpl->tpl_vars['settings']->value['stream_value'],40);?>
">
                        </div>

                        <div class="yml-slider"<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['limit_stream'])){?> style="display: none"<?php }?>></div>
                    </div>

                </div>
            </div>
            
            <div class="field">
                <div class="name">
                    Запоминать незавершённые сессии
                </div>
                
                <div class="value">
                    <ul class="menu-h" style="display:inline-block">
                        <li>Нет</li>
                        <li>
                            <input type="checkbox" class="iButton" value="1" name="settings[restore]"<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['restore'])){?> checked<?php }?>>
                        </li>
                        <li>Да</li>
                    </ul>
                    
                    <?php if (!empty($_smarty_tpl->tpl_vars['session']->value)){?>
                        <div style="margin-top: 10px;<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['restore'])){?>display:none;<?php }?>">
                            <div class="session">
                                <span class="session-label">
                                    <i class="icon16 exclamation"></i>
                                    Обнаружена неоконченная сессия импорта
                                </span>
                                
                                <span class="session-remove" title="Удалить сессию">x</span>
                                
                                <div class="session-info">
                                    <span class="sess-inf-time">
                                        <strong>Время старта:</strong>
                                        <i><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['session']->value['time_start'],'humandatetime');?>
</i>
                                    </span>

                                    <span class="sess-inf-time">
                                        <strong>Время прерывания:</strong>
                                        <i><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['session']->value['time_end'],'humandatetime');?>
</i>
                                    </span>
                                </div>

                                <span class="hint">
                                    <i class="icon16 info"></i>  Следующий импорт начнётся с того места на котором прервался предыдущий импорт.<br>
                                    Чтобы импорт сработал по умолчанию - удалите эту сессию с помощью кнопки выше.
                                </span>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
            
            <div class="field">
                <div class="name" >Отложенное выполнение:</div>
                <div class="value">
                    <ul class="menu-h" style="display:inline-block">
                        <li style="padding: 0;vertical-align: top;">Нет</li>
                        <li style="padding: 0;"><input type="checkbox" class="iButton" name="settings[automatization]" <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['automatization'])&&$_smarty_tpl->tpl_vars['settings']->value['automatization']==1){?> checked="checked"<?php }?> value="1"/></li>
                        <li class="istrue <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['automatization'])&&$_smarty_tpl->tpl_vars['settings']->value['automatization']==1){?>checkedinput<?php }?>" style="padding: 0;vertical-align: top;">Да</li>
                    </ul>
                    <div class="yml-cli">php <?php echo $_smarty_tpl->tpl_vars['root_path']->value;?>
/cli.php shop ymlSyncFile<?php if (!empty($_smarty_tpl->tpl_vars['profile_id']->value)){?> -profile <?php echo $_smarty_tpl->tpl_vars['profile_id']->value;?>
<?php }?></div>
                    
                    <div class="yml-cli-alert">
                            <?php if (empty($_smarty_tpl->tpl_vars['settings']->value['last_cli_time'])){?>
                                <span class="yml-cli-alert-text no">
                                <i class="icon16 status-red"></i> Задание CRON не настроено
                                <span class="hint">
                                    Отложенное обновление еще ни разу не выполнялось.
                                </span>
                            <?php }else{ ?>
                                <span class="yml-cli-alert-text">
                                <i class="icon16 status-green"></i> Задание CRON настроено
                                <span class="hint">
                                    Последняя отложенная синхронизация выполнялась: <strong><i><?php echo wa_date('humandatetime',$_smarty_tpl->tpl_vars['settings']->value['last_cli_time']);?>
</i></strong>
                                </span>
                            <?php }?>
                                </span>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="field yml-buttons">
                <div class="name"></div>
                <div class="value" style="margin-left: 255px">
                    <input type="submit" id="yml-pre-sync" class="button green" value="Сохранить" />
                    <span id="save-status"></span>
                    <input type="button" class="button green" id="yml-start-sync" value="Начать синхронизацию" />
                    
                    <input type="hidden" name="profile_id" value="<?php echo ifempty($_smarty_tpl->tpl_vars['profile_id']->value,'');?>
">
                </div>
            </div>

            <div class="field no-border" style="padding-left: 30px">
                <div class="name"></div>
                <div class="value" style="margin-left:150px; border: none;">
                    <!-- Progress bar -->
                    <div id="progressbar" style="display:none; margin-top: 20px;">
                        <div class="stage_label"></div>

                        <div class="progressbar blue float-left" style="display: none; width: 80%;">
                            <div class="progressbar-outer" style="overflow: hidden;">
                                <div class="progressbar-inner" style="width: 0%;"></div>
                            </div>
                        </div>

                        <img style="float:left; margin-top:8px;" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/img/loading32.gif" />
                        <div class="clear"></div>
                        <span class="progressbar-description">0%</span>
                        <em class="hint">Пожалуйста не закрывайте браузер пока операция не закончится.</em>
                        <br clear="left" />
                        <em class="errormsg"></em>
                    </div>

                    <div id="report"></div>
                    <!-- ./Progress Bar -->
                </div>
            </div>

        </form>
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
</div><?php }} ?>