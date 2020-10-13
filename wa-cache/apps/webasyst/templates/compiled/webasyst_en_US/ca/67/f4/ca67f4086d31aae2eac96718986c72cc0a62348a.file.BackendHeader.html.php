<?php /* Smarty version Smarty-3.1.14, created on 2020-10-12 19:10:28
         compiled from "Z:\home\shop.tst\www\wa-system\webasyst\templates\actions\backend\BackendHeader.html" */ ?>
<?php /*%%SmartyHeaderCode:19245f847ff4982082-63646867%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca67f4086d31aae2eac96718986c72cc0a62348a' => 
    array (
      0 => 'Z:\\home\\shop.tst\\www\\wa-system\\webasyst\\templates\\actions\\backend\\BackendHeader.html',
      1 => 1565270346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19245f847ff4982082-63646867',
  'function' => 
  array (
    '_renderAnnouncement' => 
    array (
      'parameter' => 
      array (
        '_app_id' => '',
        '_texts' => 
        array (
        ),
      ),
      'compiled' => '',
    ),
    '_renderHeaderItem' => 
    array (
      'parameter' => 
      array (
        '_id' => '',
        '_info' => 
        array (
        ),
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    '_app_id' => 0,
    '_texts' => 0,
    '_info' => 0,
    'backend_url' => 0,
    '_id' => 0,
    'current_app' => 0,
    'reuqest_uri' => 0,
    '_item_url' => 0,
    'counts' => 0,
    'root_url' => 0,
    '_version' => 0,
    '_count' => 0,
    'header_top' => 0,
    '_' => 0,
    'include_wa_push' => 0,
    'wa_url' => 0,
    'announcements' => 0,
    'company_name' => 0,
    'company_url' => 0,
    'date' => 0,
    'user' => 0,
    'header_items' => 0,
    'wa_version' => 0,
    'header_middle' => 0,
    'header_bottom' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f847ff4d7c4a3_17125639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f847ff4d7c4a3_17125639')) {function content_5f847ff4d7c4a3_17125639($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'Z:\\home\\shop.tst\\www\\wa-system\\vendors\\smarty3\\plugins\\modifier.truncate.php';
?>
<?php if (!function_exists('smarty_template_function__renderAnnouncement')) {
    function smarty_template_function__renderAnnouncement($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['_renderAnnouncement']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
    <a href="#" rel="<?php echo $_smarty_tpl->tpl_vars['_app_id']->value;?>
" class="wa-announcement-close" title="close">&times;</a><p><?php echo implode('<br />',$_smarty_tpl->tpl_vars['_texts']->value);?>
</p>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<?php if (!function_exists('smarty_template_function__renderHeaderItem')) {
    function smarty_template_function__renderHeaderItem($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['_renderHeaderItem']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><?php if (!empty($_smarty_tpl->tpl_vars['_info']->value['app_id'])&&!empty($_smarty_tpl->tpl_vars['_info']->value['link'])){?><?php $_smarty_tpl->tpl_vars['_item_url'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['backend_url']->value).((string)$_smarty_tpl->tpl_vars['_info']->value['app_id'])."/".((string)$_smarty_tpl->tpl_vars['_info']->value['link'])."/", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['_item_url'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['backend_url']->value).((string)$_smarty_tpl->tpl_vars['_id']->value)."/", null, 0);?><?php }?><?php if (!empty($_smarty_tpl->tpl_vars['_info']->value['version'])){?><?php $_smarty_tpl->tpl_vars['_version'] = new Smarty_variable("?v=".((string)htmlspecialchars($_smarty_tpl->tpl_vars['_info']->value['version'], ENT_QUOTES, 'UTF-8', true)), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['_version'] = new Smarty_variable(null, null, 0);?><?php }?><li id="wa-app-<?php echo str_replace('.','-',$_smarty_tpl->tpl_vars['_id']->value);?>
" data-app="<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['_id']->value==$_smarty_tpl->tpl_vars['current_app']->value||stristr($_smarty_tpl->tpl_vars['reuqest_uri']->value,$_smarty_tpl->tpl_vars['_item_url']->value)!==false){?> class="selected"<?php }?>><?php $_smarty_tpl->tpl_vars['_count'] = new Smarty_variable(null, null, 0);?><?php if ($_smarty_tpl->tpl_vars['counts']->value&&isset($_smarty_tpl->tpl_vars['counts']->value[$_smarty_tpl->tpl_vars['_id']->value])){?><?php if (is_array($_smarty_tpl->tpl_vars['counts']->value[$_smarty_tpl->tpl_vars['_id']->value])){?><?php $_smarty_tpl->tpl_vars['_item_url'] = new Smarty_variable($_smarty_tpl->tpl_vars['counts']->value[$_smarty_tpl->tpl_vars['_id']->value]['url'], null, 0);?><?php $_smarty_tpl->tpl_vars['_count'] = new Smarty_variable($_smarty_tpl->tpl_vars['counts']->value[$_smarty_tpl->tpl_vars['_id']->value]['count'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['_count'] = new Smarty_variable($_smarty_tpl->tpl_vars['counts']->value[$_smarty_tpl->tpl_vars['_id']->value], null, 0);?><?php }?><?php }?><a href="<?php echo $_smarty_tpl->tpl_vars['_item_url']->value;?>
"><?php if (isset($_smarty_tpl->tpl_vars['_info']->value['img'])){?><img<?php if (!empty($_smarty_tpl->tpl_vars['_info']->value['icon'][96])){?> data-src2="<?php echo $_smarty_tpl->tpl_vars['root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['_info']->value['icon'][96];?>
<?php echo $_smarty_tpl->tpl_vars['_version']->value;?>
"<?php }?> src="<?php echo $_smarty_tpl->tpl_vars['root_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['_info']->value['img'];?>
<?php echo $_smarty_tpl->tpl_vars['_version']->value;?>
" alt=""><?php }?><?php echo ifempty($_smarty_tpl->tpl_vars['_info']->value['name']);?>
<?php if ($_smarty_tpl->tpl_vars['_count']->value){?><span class="indicator"><?php echo $_smarty_tpl->tpl_vars['_count']->value;?>
</span><?php }?></a></li><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>

<?php if (!empty($_smarty_tpl->tpl_vars['header_top']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['header_top']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['_']->value;?>
<?php } ?><?php }?><script type="text/javascript">var backend_url = "<?php echo $_smarty_tpl->tpl_vars['backend_url']->value;?>
";</script><?php if (!empty($_smarty_tpl->tpl_vars['include_wa_push']->value)){?><script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.push.js"></script><?php }?><?php if (!empty($_smarty_tpl->tpl_vars['announcements']->value)){?><div id="wa-announcement"><?php  $_smarty_tpl->tpl_vars['_texts'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_texts']->_loop = false;
 $_smarty_tpl->tpl_vars['_app_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_texts']->key => $_smarty_tpl->tpl_vars['_texts']->value){
$_smarty_tpl->tpl_vars['_texts']->_loop = true;
 $_smarty_tpl->tpl_vars['_app_id']->value = $_smarty_tpl->tpl_vars['_texts']->key;
?><?php smarty_template_function__renderAnnouncement($_smarty_tpl,array('_app_id'=>$_smarty_tpl->tpl_vars['_app_id']->value,'_texts'=>$_smarty_tpl->tpl_vars['_texts']->value));?>
<?php } ?></div><?php }?><div id="wa-header"><div id="wa-account"><?php if ($_smarty_tpl->tpl_vars['reuqest_uri']->value==$_smarty_tpl->tpl_vars['backend_url']->value||$_smarty_tpl->tpl_vars['reuqest_uri']->value==((string)$_smarty_tpl->tpl_vars['backend_url']->value)."/"){?><h3 title="<?php echo $_smarty_tpl->tpl_vars['company_name']->value;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['company_name']->value,18,'...');?>
<a href="<?php echo $_smarty_tpl->tpl_vars['company_url']->value;?>
" class="wa-frontend-link" target="_blank"><i class="icon16 new-window"></i></a></h3><a class="inline-link" id="show-dashboard-editable-mode" href="<?php echo $_smarty_tpl->tpl_vars['backend_url']->value;?>
"><b><i>Customize dashboard</i></b></a><input id="close-dashboard-editable-mode" type="button" value="Done editing" style="display: none;"><?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['backend_url']->value;?>
" class="wa-dashboard-link"><h3 title="<?php echo $_smarty_tpl->tpl_vars['company_name']->value;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['company_name']->value,18,'...');?>
</h3><span class="gray"><?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</span></a><?php }?></div><div id="wa-usercorner" data-user-id="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"><div class="profile image32px"><div class="image"><a href="<?php echo $_smarty_tpl->tpl_vars['backend_url']->value;?>
?module=profile"><img width="32" height="32" src="<?php echo $_smarty_tpl->tpl_vars['user']->value->getPhoto(32);?>
" alt=""></a></div><div class="details"><a href="<?php echo $_smarty_tpl->tpl_vars['backend_url']->value;?>
?module=profile" id="wa-my-username"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->getName(), ENT_QUOTES, 'UTF-8', true);?>
</a><p class="status"></p><a class="hint" href="<?php echo $_smarty_tpl->tpl_vars['backend_url']->value;?>
?action=logout">log out</a></div></div></div><div id="wa-applist"<?php if (is_array($_smarty_tpl->tpl_vars['counts']->value)){?> class="counts-cached"<?php }?>><ul><?php  $_smarty_tpl->tpl_vars['_info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_info']->_loop = false;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['header_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_info']->key => $_smarty_tpl->tpl_vars['_info']->value){
$_smarty_tpl->tpl_vars['_info']->_loop = true;
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_info']->key;
?><?php smarty_template_function__renderHeaderItem($_smarty_tpl,array('_id'=>$_smarty_tpl->tpl_vars['_id']->value,'_info'=>$_smarty_tpl->tpl_vars['_info']->value));?>
<?php } ?><li><a href="#" id="wa-moreapps"></a></li></ul>

        <?php if ($_smarty_tpl->tpl_vars['reuqest_uri']->value==$_smarty_tpl->tpl_vars['backend_url']->value||$_smarty_tpl->tpl_vars['reuqest_uri']->value==((string)$_smarty_tpl->tpl_vars['backend_url']->value)."/"){?>
            <div class="d-dashboard-header-content">
                <div class="d-dashboards-list-wrapper" id="d-dashboards-list-wrapper"></div>
                <div class="d-dashboard-link-wrapper" id="d-dashboard-link-wrapper">
                    <i class="icon10 lock-bw"></i> Only you can see this dashboard.
                </div>
            </div>
        <?php }?>
    </div>
</div>
<script id="wa-header-js" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['root_url']->value;?>
wa-content/js/jquery-wa/wa.header.js?<?php echo $_smarty_tpl->tpl_vars['wa_version']->value;?>
"<?php if (!$_smarty_tpl->tpl_vars['user']->value['timezone']){?> data-determine-timezone="1"<?php }?>></script>


<?php if (!empty($_smarty_tpl->tpl_vars['header_middle']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['header_middle']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['_']->value;?>
<?php } ?><?php }?>


<?php if (!empty($_smarty_tpl->tpl_vars['header_bottom']->value)){?><?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['header_bottom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['_']->value;?>
<?php } ?><?php }?>
<?php }} ?>