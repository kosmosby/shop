<?php /* Smarty version Smarty-3.1.14, created on 2020-11-15 22:02:32
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/plugins/yml/templates/actions/snapshot/Snapshot.html" */ ?>
<?php /*%%SmartyHeaderCode:9418937835fb17b48662c60-64089759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9f96f394cda9cd456f1b9712b1e5b77ca37adb1' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/plugins/yml/templates/actions/snapshot/Snapshot.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9418937835fb17b48662c60-64089759',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'snapshot' => 0,
    'key' => 0,
    'tag_path' => 0,
    'tag_data' => 0,
    'display' => 0,
    'depth' => 0,
    'v' => 0,
    'tag_v' => 0,
    'is_default_map' => 0,
    'map' => 0,
    'is_feature_param' => 0,
    'name' => 0,
    'ready' => 0,
    'is_main' => 0,
    'have_attrs' => 0,
    'attr_id' => 0,
    'attr_key' => 0,
    'attr_value' => 0,
    'fields_map' => 0,
    'types' => 0,
    'type_id' => 0,
    'type_name' => 0,
    'features' => 0,
    'f' => 0,
    'max_inputs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5fb17b4895aa00_20682620',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fb17b4895aa00_20682620')) {function content_5fb17b4895aa00_20682620($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
?><div id="yml-snapshot">
    <div class="yml-s-body">

        <div class="yml-tags-map">

            <div class="tags-map-title bg-gd-orange">
                Структура товара в файле
            </div>

            <div class="yml-tags-list"><div class="yml-tags-scroller"><?php if (!empty($_smarty_tpl->tpl_vars['snapshot']->value)){?><?php $_smarty_tpl->tpl_vars['display'] = new Smarty_variable(false, null, 0);?><?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['snapshot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?><?php $_smarty_tpl->tpl_vars['tag_path'] = new Smarty_variable(explode('\\',$_smarty_tpl->tpl_vars['key']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['tag_data'] = new Smarty_variable(explode(':',end($_smarty_tpl->tpl_vars['tag_path']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable(intval($_smarty_tpl->tpl_vars['tag_data']->value[0]), null, 0);?><?php $_smarty_tpl->tpl_vars['name'] = new Smarty_variable(ifempty($_smarty_tpl->tpl_vars['tag_data']->value[1]), null, 0);?><?php if ($_smarty_tpl->tpl_vars['key']->value=='0:yml_catalog\\1:shop\\2:offers\\3:offer'){?><?php $_smarty_tpl->tpl_vars['display'] = new Smarty_variable(true, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['display']->value&&($_smarty_tpl->tpl_vars['depth']->value<=3)){?><?php $_smarty_tpl->tpl_vars['display'] = new Smarty_variable(false, null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['display']->value){?><?php $_smarty_tpl->tpl_vars['tag_v'] = new Smarty_variable($_smarty_tpl->tpl_vars['v']->value, null, 0);?><?php if (is_array($_smarty_tpl->tpl_vars['v']->value)){?><?php $_smarty_tpl->tpl_vars['tag_v'] = new Smarty_variable($_smarty_tpl->tpl_vars['v']->value['value'], null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['have_attrs'] = new Smarty_variable(is_array($_smarty_tpl->tpl_vars['v']->value)&&!empty($_smarty_tpl->tpl_vars['v']->value['attrs']), null, 0);?><?php $_smarty_tpl->tpl_vars['tag_v'] = new Smarty_variable(strip_tags($_smarty_tpl->tpl_vars['tag_v']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['is_feature_param'] = new Smarty_variable($_smarty_tpl->tpl_vars['is_default_map']->value&&(strpos($_smarty_tpl->tpl_vars['key']->value,'0:yml_catalog\\1:shop\\2:offers\\3:offer\\4:param::')!==false), null, 0);?><?php $_smarty_tpl->tpl_vars['ready'] = new Smarty_variable(!empty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['key']->value]['type'])||$_smarty_tpl->tpl_vars['is_feature_param']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['depth']->value===1){?><?php $_smarty_tpl->tpl_vars['plus'] = new Smarty_variable(27, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['plus'] = new Smarty_variable(37, null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['is_main'] = new Smarty_variable(($_smarty_tpl->tpl_vars['name']->value==='offer')&&($_smarty_tpl->tpl_vars['depth']->value===3), null, 0);?><div class="yml-s-row<?php if ($_smarty_tpl->tpl_vars['ready']->value){?> tag-ready<?php }?><?php if ($_smarty_tpl->tpl_vars['is_main']->value){?> disabled<?php }?>"<?php if ($_smarty_tpl->tpl_vars['depth']->value&&!($_smarty_tpl->tpl_vars['name']->value==='offer')){?> style="padding-left: <?php echo $_smarty_tpl->tpl_vars['depth']->value*10+15;?>
px"<?php }?> data-depth="<?php echo $_smarty_tpl->tpl_vars['depth']->value;?>
"><span class="yml-item tag<?php if ($_smarty_tpl->tpl_vars['ready']->value){?> ready<?php }?><?php if ($_smarty_tpl->tpl_vars['is_main']->value){?> disabled-tag<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 - <?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['tag_v']->value), ENT_QUOTES, 'UTF-8', true);?>
" data-value="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['tag_v']->value), ENT_QUOTES, 'UTF-8', true);?>
" data-key="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
"data-type="<?php if (!$_smarty_tpl->tpl_vars['is_feature_param']->value){?><?php echo ifempty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['key']->value]['type'],'');?>
<?php }elseif(!empty($_smarty_tpl->tpl_vars['map']->value['0:yml_catalog\\1:shop\\2:offers\\3:offer\\4:param']['type'])){?><?php echo $_smarty_tpl->tpl_vars['map']->value['0:yml_catalog\\1:shop\\2:offers\\3:offer\\4:param']['type'];?>
<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['key']->value]['type'])&&empty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['key']->value]['up'])){?>|1<?php }?>">&lt;<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
<?php if (!$_smarty_tpl->tpl_vars['have_attrs']->value){?>&gt;<?php }?></span><?php if ($_smarty_tpl->tpl_vars['have_attrs']->value){?><?php  $_smarty_tpl->tpl_vars['attr_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attr_value']->_loop = false;
 $_smarty_tpl->tpl_vars['attr_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value['attrs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attr_value']->key => $_smarty_tpl->tpl_vars['attr_value']->value){
$_smarty_tpl->tpl_vars['attr_value']->_loop = true;
 $_smarty_tpl->tpl_vars['attr_id']->value = $_smarty_tpl->tpl_vars['attr_value']->key;
?><?php $_smarty_tpl->tpl_vars['attr_key'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['key']->value).":a:".((string)$_smarty_tpl->tpl_vars['attr_id']->value), null, 0);?><span class="yml-item attr<?php if (!empty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['attr_key']->value]['type'])){?> ready<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['tag_v']->value;?>
" data-value="<?php echo $_smarty_tpl->tpl_vars['attr_value']->value['value'];?>
" data-key="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attr_key']->value, ENT_QUOTES, 'UTF-8', true);?>
"data-type="<?php echo ifempty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['attr_key']->value]['type'],'');?>
<?php if (!empty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['attr_key']->value]['type'])&&empty($_smarty_tpl->tpl_vars['map']->value[$_smarty_tpl->tpl_vars['attr_key']->value]['up'])){?>|1<?php }?>"><?php echo $_smarty_tpl->tpl_vars['attr_id']->value;?>
="<?php echo $_smarty_tpl->tpl_vars['attr_value']->value['value'];?>
"</span><?php } ?><span class="yml-open-right-arrow">&gt;</span><?php }?><?php if (!empty($_smarty_tpl->tpl_vars['v']->value['end'])){?><span class="yml-value"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['tag_v']->value,100);?>
</span><span class="end-tag">&lt;/<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
&gt;</span><?php }?></div><?php }?><?php } ?><?php }?></div></div>
        </div>
    </div>

    <?php $_smarty_tpl->tpl_vars['fields_map'] = new Smarty_variable(shopYmlHelper::getMapFields(false,true), null, 0);?>
    <div class="yml-item-type">
        <p>
            Select element type:
        </p>

        <label>
            <select name="item_type">
                <option value="0">Do not import</option>
                <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['types']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields_map']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
$_smarty_tpl->tpl_vars['types']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['types']->key;
?>
                <optgroup label="<?php echo shopYmlPlugin::translate($_smarty_tpl->tpl_vars['key']->value);?>
">
                    <?php  $_smarty_tpl->tpl_vars['type_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type_name']->_loop = false;
 $_smarty_tpl->tpl_vars['type_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type_name']->key => $_smarty_tpl->tpl_vars['type_name']->value){
$_smarty_tpl->tpl_vars['type_name']->_loop = true;
 $_smarty_tpl->tpl_vars['type_id']->value = $_smarty_tpl->tpl_vars['type_name']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['type_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['type_name']->value;?>
</option>
                    <?php } ?>
                </optgroup>
                <?php } ?>
            </select>
        </label>

        <div class="yml-type-actions">
            <a class="type-multi-add" href="#" title="Добавить"><i class="icon16 add"></i></a>
            <a class="type-action type-save" title="Сохранить" href="#"><i class="icon16 yes"></i></a>
            <a class="type-action type-cancel" title="Отмена" href="#"><i class="icon16 no"></i></a>
        </div>

        <div class="feature-settings" style="display: none">
            <div class="feature-content">
                <div id="f-existing" class="f-settings-item">
                    <span class="f-settings-label">Выберите характеристику:</span>
                    <select name="feature_id" class="select2">
                        <?php if (!empty($_smarty_tpl->tpl_vars['features']->value)){?>
                        <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
" data-multiple="<?php echo $_smarty_tpl->tpl_vars['f']->value['multiple'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['name'];?>
</option>
                        <?php } ?>
                        <?php }?>
                    </select>
                </div>

                
            </div>

        </div>

        <div class="multi-list">

        </div>

        <div class="yml-type-options">
            <label id="create_sku" style="display:none">
                <input type="checkbox" name="create_sku"> Создавать артикул
            </label>

            <label>
                <input type="checkbox" name="up"> Обновлять повторно
            </label>
        </div>
    </div>

    <script type="text/javascript">
        max_inputs      = <?php echo $_smarty_tpl->tpl_vars['max_inputs']->value;?>
;
        yml_fields      = <?php echo json_encode($_smarty_tpl->tpl_vars['fields_map']->value);?>
;
        yml_type_titles = <?php echo json_encode(shopYmlPlugin::translate());?>
;
    </script>
</div><?php }} ?>