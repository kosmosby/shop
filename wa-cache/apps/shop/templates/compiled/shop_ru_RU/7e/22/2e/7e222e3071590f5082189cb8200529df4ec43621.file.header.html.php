<?php /* Smarty version Smarty-3.1.14, created on 2020-10-29 13:04:26
         compiled from "/Users/kosmos/Documents/sites/shop/wa-data/public/shop/themes/default/header.html" */ ?>
<?php /*%%SmartyHeaderCode:7252167695f9a93aaadc7a1-80653616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e222e3071590f5082189cb8200529df4ec43621' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-data/public/shop/themes/default/header.html',
      1 => 1603270277,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7252167695f9a93aaadc7a1-80653616',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_settings' => 0,
    'wa' => 0,
    'shop_pages' => 0,
    'category' => 0,
    'frontend_nav' => 0,
    'output' => 0,
    'query' => 0,
    'wa_app_url' => 0,
    'categories' => 0,
    'cat' => 0,
    'tagcloud' => 0,
    'tag' => 0,
    '_hook_frontend_sidebar_section' => 0,
    '_key' => 0,
    '_' => 0,
    'frontend_nav_aux' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f9a93aace3533_88593443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9a93aace3533_88593443')) {function content_5f9a93aace3533_88593443($_smarty_tpl) {?><?php if (!is_callable('smarty_function_wa_print_tree')) include '/Users/kosmos/Documents/sites/shop/wa-system/vendors/smarty-plugins/function.wa_print_tree.php';
?><?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['header_links']=='shop-pages'){?>
    <?php $_smarty_tpl->tpl_vars['shop_pages'] = new Smarty_variable(array(), null, 0);?> 
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['shop_pages'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->pages(), null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['shop_pages']->value||$_smarty_tpl->tpl_vars['theme_settings']->value['category_nav_mode']!='sidebar'){?>

    <?php if (isset($_smarty_tpl->tpl_vars['category']->value)){?><?php $_smarty_tpl->tpl_vars['selected_category'] = new Smarty_variable($_smarty_tpl->tpl_vars['category']->value['id'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['selected_category'] = new Smarty_variable(null, null, 0);?><?php }?>
    <?php $_smarty_tpl->tpl_vars['categories'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->categories(0,null,true), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['tagcloud'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->tags(), null, 0);?>
    <!-- plugin hook: 'frontend_nav' -->
    
    <?php $_smarty_tpl->tpl_vars['_hook_frontend_sidebar_section'] = new Smarty_variable(false, null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['frontend_nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
        <?php if (!empty($_smarty_tpl->tpl_vars['output']->value)){?>
            <?php $_smarty_tpl->tpl_vars['_hook_frontend_sidebar_section'] = new Smarty_variable(true, null, 0);?>
        <?php }?>
    <?php } ?>

    <!-- product search -->
    <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/search');?>
" class="search">
        <div class="search-wrapper">
            <input id="search" type="search" name="query" <?php if (!empty($_smarty_tpl->tpl_vars['query']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
"<?php }?> placeholder="Найти товары">
            <button type="submit"></button>
            
        </div>
    </form>

    <ul class="pages flyout-nav">

        <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['category_nav_mode']!='sidebar'){?>

            <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['category_nav_mode']=='dropdown'){?>

                

                <li class="collapsible">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
" class="bold">Каталог товаров</a>
                    <div class="flyout">
                        <div class="container">
                            <?php if (count($_smarty_tpl->tpl_vars['categories']->value)){?>
                                <div class="departments">
                                    <?php echo smarty_function_wa_print_tree(array('tree'=>$_smarty_tpl->tpl_vars['categories']->value,'unfolded'=>true,'collapsible_class'=>'collapsible','class'=>"menu-v",'elem'=>'<a href=":url" title=":name">:name</a>'),$_smarty_tpl);?>

                                </div>
                            <?php }else{ ?>
                                <p class="align-center gray"><br><br>Вы еще не создали ни одной категории товаров.</p>
                            <?php }?>
                        </div>
                    </div>
                </li>

            <?php }else{ ?>

                

                <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>
                    <?php if (count($_smarty_tpl->tpl_vars['cat']->value['childs'])){?>
                        <li class="collapsible">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['cat']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</a>
                            <div class="flyout">
                                <div class="container">
                                    <?php echo smarty_function_wa_print_tree(array('tree'=>$_smarty_tpl->tpl_vars['cat']->value['childs'],'unfolded'=>true,'collapsible_class'=>'collapsible','class'=>"menu-v",'elem'=>'<a href=":url" title=":name">:name</a>'),$_smarty_tpl);?>

                                </div>
                            </div>
                        </li>
                    <?php }else{ ?>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['cat']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</a>
                        </li>
                    <?php }?>
                <?php } ?>

            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['tagcloud']->value){?>

                

                <li class="collapsible">
                    <a href="javascript:void(0);">Теги</a>
                    <div class="flyout">
                        <div class="container">
                            <div class="tags block align-center">
                                <?php  $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tagcloud']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->key => $_smarty_tpl->tpl_vars['tag']->value){
$_smarty_tpl->tpl_vars['tag']->_loop = true;
?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
tag/<?php echo $_smarty_tpl->tpl_vars['tag']->value['uri_name'];?>
/" style="font-size: <?php echo $_smarty_tpl->tpl_vars['tag']->value['size'];?>
%; opacity: <?php echo $_smarty_tpl->tpl_vars['tag']->value['opacity'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['_hook_frontend_sidebar_section']->value){?>

                

                <?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_smarty_tpl->tpl_vars['_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['frontend_nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
 $_smarty_tpl->tpl_vars['_key']->value = $_smarty_tpl->tpl_vars['_']->key;
?>
                    <li class="collapsible">
                        <a href="javascript:void(0);" onClick="return false">
                            <?php if (substr($_smarty_tpl->tpl_vars['_key']->value,-7)=='-plugin'){?><?php echo $_smarty_tpl->tpl_vars['wa']->value->pluginName(substr($_smarty_tpl->tpl_vars['_key']->value,0,-7));?>
<?php }else{ ?>Еще<?php }?>
                        </a>
                        <div class="flyout">
                            <div class="container">
                                <?php echo $_smarty_tpl->tpl_vars['_']->value;?>

                            </div>
                        </div>
                    </li>
                <?php } ?>
                <?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_smarty_tpl->tpl_vars['_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['frontend_nav_aux']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
 $_smarty_tpl->tpl_vars['_key']->value = $_smarty_tpl->tpl_vars['_']->key;
?>
                    <li class="collapsible">
                        <a href="javascript:void(0);" onClick="return false">
                            <?php if (substr($_smarty_tpl->tpl_vars['_key']->value,-7)=='-plugin'){?><?php echo $_smarty_tpl->tpl_vars['wa']->value->pluginName(substr($_smarty_tpl->tpl_vars['_key']->value,0,-7));?>
<?php }else{ ?>Еще<?php }?>
                        </a>
                        <div class="flyout">
                            <div class="container">
                                <?php echo $_smarty_tpl->tpl_vars['_']->value;?>

                            </div>
                        </div>
                    </li>
                <?php } ?>


            <?php }?>

        <?php }?>


        

        <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shop_pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
$_smarty_tpl->tpl_vars['page']->_loop = true;
?>
            <li<?php if (strlen($_smarty_tpl->tpl_vars['page']->value['url'])>1&&strstr($_smarty_tpl->tpl_vars['wa']->value->currentUrl(),$_smarty_tpl->tpl_vars['page']->value['url'])){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['page']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
</a></li>
        <?php } ?>


    </ul>

<?php }?>
<?php }} ?>