<?php /* Smarty version Smarty-3.1.14, created on 2020-10-27 14:41:18
         compiled from "/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/csv/CsvProductsetup.import.html" */ ?>
<?php /*%%SmartyHeaderCode:10604001895f98075ea31551-70921927%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '956f8a044e96c949ec05f25f9637d1f42289b695' => 
    array (
      0 => '/Users/kosmos/Documents/sites/shop/wa-apps/shop/templates/actions/csv/CsvProductsetup.import.html',
      1 => 1603270274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10604001895f98075ea31551-70921927',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'encoding' => 0,
    'enc' => 0,
    'profile' => 0,
    'meta_fields' => 0,
    'types' => 0,
    'type_id' => 0,
    'type' => 0,
    'app_path' => 0,
    'app_id' => 0,
    'upload_app' => 0,
    'path' => 0,
    'upload_path' => 0,
    'wa_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5f98075eb1b895_94455811',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f98075eb1b895_94455811')) {function content_5f98075eb1b895_94455811($_smarty_tpl) {?><h1>CSV product import</h1>
<p>
    <?php echo sprintf('Import new products and update existing product information from a comma-separated values (CSV) file. CSV files can be created and managed using most modern spreadsheet applications such as Microsoft Excel, OpenOffice, and iWork. For detailed information about Shop-Script-supported CSV file structure, please <a href="%s" target="_blank">refer to the manual</a>.','http://www.shop-script.com/help/45/import-products-from-csv-file/');?>

    <i class="icon10 new-window"></i>
</p>


<!-- FILE UPLOAD -->
<div class="field-group">
    <div class="field">
        <div class="name">
           Encoding
        </div>
        <div class="value">
            <select name="encoding" class="js-ignore-change">
            <?php  $_smarty_tpl->tpl_vars['enc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['enc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['encoding']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['enc']->key => $_smarty_tpl->tpl_vars['enc']->value){
$_smarty_tpl->tpl_vars['enc']->_loop = true;
?><option<?php if ($_smarty_tpl->tpl_vars['enc']->value==$_smarty_tpl->tpl_vars['profile']->value['config']['encoding']){?> selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['enc']->value, ENT_QUOTES, 'UTF-8', true);?>
</option><?php } ?>
            </select>
        </div>
    </div>
    <div class="field">
        <div class="name">
           Separator
        </div>
        <div class="value">
            <select name="delimiter" class="js-ignore-change">
                <option value=";"<?php if ($_smarty_tpl->tpl_vars['profile']->value['config']['delimiter']==';'){?> selected="selected"<?php }?>>Semicolon (;)</option>
                <option value=","<?php if ($_smarty_tpl->tpl_vars['profile']->value['config']['delimiter']==','){?> selected="selected"<?php }?>>Comma (,)</option>
                <option value="tab"<?php if ($_smarty_tpl->tpl_vars['profile']->value['config']['delimiter']=='tab'){?> selected="selected"<?php }?>>Tab</option>
            </select>
        </div>
    </div>

    <div class="field">
        <div class="name">
            File
        </div>
        <div class="value no-shift">
            <input type="file" name="" class="fileupload">
            <div class="js-fileupload-progress" style="display:none;">
                <i class="icon16 loading"></i><span><!-- upload progress handler --></span>
            </div>
            <span class="errormsg" style="display:none;"><br><br><i class="icon10 no"></i> <span></span></span>

            <!-- <?php $_smarty_tpl->_capture_stack[0][] = array("file-info-template-js", null, null); ob_start(); ?> -->
            {% file=o.file; %}
            <input type="hidden" name="file" value="{%=file.name%}">
            <input type="hidden" name="delimiter" value="{%=file.delimiter%}">
            <i class="icon16 yes"></i>
            <strong{% if(file.name != file.original_name){ %} title="{%=file.name%}"{% } %}>{%=file.original_name%}</strong><br>
            <span class="hint">{% if(file.size != file.original_size){ %}{%=file.original_size%} &rarr; {% } %}{%=file.size%}</span>
            {% if(file.header && false){ %}
            <p><br>Following columns were located in the uploaded file:</p>
            <ul class="menu-h with-icons hint">
                {% for (var column in file.header){if(file.header.hasOwnProperty(column)){ %}
                <li title="{%=column%}">{%=file.header[column]%}</li>
                {% }} %}
            </ul>
            {% } %}
            <!-- <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?> -->

        </div>
    </div>
</div>


<!-- BASIC SETTINGS AND CSV PREVIEW -->
<div class="field-group" style="display: none;">

    <div class="field" id="s_import_csv_table"><!-- CSV TABLE MAP PLACEHOLDER --></div>
    <div class="field">
        <div class="name">
            Product identification column
        </div>
        <div class="value no-shift">
            <input type="hidden" name="emulate" value="1">
            <select name="primary" class="bold">
                <option value="name">Product name</option>
                <option value="url">Public link</option>
                <option value="id">Product ID</option>
                <?php if ((!empty($_smarty_tpl->tpl_vars['meta_fields']->value['product']['id_1c']))){?>
                <option value="id_1c">Идентификатор товара «1С»</option>
                <?php }?>
                <option value="false" class="italic">SKU identification column</option>
                <option value="null" class="italic">(skip products and categories, import only SKUs)</option>
            </select>
            &nbsp;
            <span class="s-csv-primary-column-helper"></span>
            <br>
            <span class="hint">Select the product identification column (property) which uniquely identifies each product. Based on the identification column value in the CSV file uploaded, the import routine will either update existing product info, or create a new product.</span>
        </div>
    </div>

    <div class="field">
        <div class="name">
            SKU identification column
        </div>
        <div class="value no-shift">
            <select name="secondary" class="bold">
                <option value="skus:-1:sku">SKU code</option>
                <option value="skus:-1:name">SKU name</option>
                <option value="skus:-1:id">SKU ID</option>
                <?php if ((!empty($_smarty_tpl->tpl_vars['meta_fields']->value['sku']['id_1c']))){?>
                <option value="skus:-1:id_1c">Идентификатор артикула «1С»</option>
                <?php }?>
            </select>
            &nbsp;
            <span class="s-csv-secondary-column-helper"></span>
            <br>
            <span class="hint">Similar to product, select the SKU identification column (property) which uniquely identifies each product SKU. Based on the identification column value in the CSV file uploaded, the import routine will either update existing SKU info, or create a new SKU for the product.</span>
        </div>
    </div>
    <div class="field">
        <div class="value">
            <a href="#/csv_product/settings/advanced/" class="js-action inline-link"><b><i>Advanced settings</i></b> <i class="icon10 darr"></i></a>
        </div>
    </div>
</div>


<!-- ADVANCED SETTINGS -->
<div class="field-group" style="display: none;">
    <div class="field">
        <div class="value no-shift">
            <label><input type="checkbox" name="ignore_category" value="1" checked="checked"> Ignore category nesting when searching for matching products (recommended)</label>
            <br>
            <span class="hint">When importing a product and searching if it exists in the store already, product search will be performed only within the category as defined in a CSV file.</span>
        </div>
    </div>

    <div class="field">
        <div class="name">Product type</div>
        <div class="value">
            <select name="type_id">
                <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_smarty_tpl->tpl_vars['type_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
$_smarty_tpl->tpl_vars['type']->_loop = true;
 $_smarty_tpl->tpl_vars['type_id']->value = $_smarty_tpl->tpl_vars['type']->key;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['type_id']->value;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
                <?php } ?>
            </select>
            <br>
            <span class="hint">If no particular product type column was specified in the uploaded CSV file, selected product type will be applied to all new products, created during the import.</span>
        </div>
    </div>

    <div class="field">
        <div class="name">Product descriptions</div>
        <div class="value no-shift">
            <label><input type="checkbox" name="nl2br_description" value="1"> Non-HTML product descriptions</label>
            <p class="hint">If checked, a &lt;br&gt; tag will be automatically added after every line of the product description.</p>
        </div>
    </div>

    <div class="field">
        <div class="name">Product images import local path</div>

        <div class="value">
            <select  name="upload_app">
            <?php  $_smarty_tpl->tpl_vars['path'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['path']->_loop = false;
 $_smarty_tpl->tpl_vars['app_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['app_path']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['path']->key => $_smarty_tpl->tpl_vars['path']->value){
$_smarty_tpl->tpl_vars['path']->_loop = true;
 $_smarty_tpl->tpl_vars['app_id']->value = $_smarty_tpl->tpl_vars['path']->key;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['app_id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['upload_app']->value==$_smarty_tpl->tpl_vars['app_id']->value){?> selected="selected" <?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['path']->value, ENT_QUOTES, 'UTF-8', true);?>
</option>
            <?php } ?>
            </select>
            <input type="text" class="long" name="upload_path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['upload_path']->value, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="path/to/folder/with/source/images/">
            <br>
            <span class="hint">If your CSV file contains links to product images to be imported, import routine will attempt to automatically attach them to imported products. A link to an image file can be either global (a full image URL) or local (image file name). For local image import, indicate path to the folder where all source images are stored, i.e. where you uploaded them into. If linked image was not found, no image will be attached to the product.</span>
        </div>
    </div>

    <div class="field">
        <div class="name">Unique product image URLs</div>
        <div class="value">
            <label><input type="radio" name="image_match" value="" checked="checked"> by file name</label>
            <br>
           	<span class="hint"><?php echo sprintf('https://%s/path/to/<strong>file.jpg</strong>','domain.com');?>
</span>
        </div>
        <div class="value">
            <label><input type="radio" name="image_match" value="path_md5"> by file path</label>
            <br>
           	<span class="hint"><?php echo sprintf('https://%s/<strong>path/to/file.jpg</strong>','domain.com');?>
</span>
        </div>
        <div class="value">
            <label><input type="radio" name="image_match" value="host_path_md5"> by file path and domain name</label>
            <br>
           	<span class="hint"><?php echo sprintf('https://<strong>%s/path/to/file.jpg</strong>','domain.com');?>
</span>
        </div>
        <div class="value">
            <p class="hint">Select how unique image URLs must be extracted from your CSV file.</p>
        </div>
    </div>

    <div class="field">
        <div class="name">Stock level for products with selectable features defined as <{ … }></div>
        <div class="value no-shift">
            <label>
                <input type="radio" name="virtual_sku_stock" value="distribute" checked="checked"/>
                Equally distribute stock levels among all SKUs of this product
                <br/>
                <span class="hint">(e.g. if 24 is set as stock level for the entire product in CSV file, and there are 8 SKUs to be imported, every SKU will be set 3 as stock count; the overall product stock level will be set to 8 &times; 3 = 24)</span>
            </label>
        </div>
        <div class="value">
            <label>
                <input type="radio" name="virtual_sku_stock" value="set"/>
                Set provided stock count for all imported SKUs
                <br/>
                <span class="hint">(e.g. if 24 is set as stock level for the entire product in CSV file, and there are 8 SKUs, every SKU will be set 24 as stock count, and thus the overall product stock level will be set to 8 &times 24 = 192)</span>
            </label>
        </div>
        <div class="value">
            <label>
                <input type="radio" name="virtual_sku_stock" value=""/>
                Don’t import stock information for such SKUs
            </label>
        </div>
    </div>

</div>

<div class="field-group" id="s-csvproduct-info" style="display: none;">
    <!-- <?php $_smarty_tpl->_capture_stack[0][] = array("file-header-template-js", null, null); ob_start(); ?> -->
    {% file=o.file; %}
    {% if(file.header){ %}
    <div class="field">
        <div class="name">Column assignment map</div>
        <div class="value"><p class="js-csv-columns-counter bold"><!-- placeholder for column counters --></p></div>
        <div class="value">
            <ul class="menu-h hint s-csv-header" id="s_import_csv_header">
                {% for (var column in file.header){if(file.header.hasOwnProperty(column)){ %}
                <li data-value="null" data-column="{%=column%}" data-title="{%=$.importexport.csv_product_helper.id2name(column)%}" title="{%=$.importexport.csv_product_helper.id2name(column)%}"><i class="icon16 exclamation"></i>{%=file.header[column]%}</li>
                {% }} %}
            </ul>
        </div>
    </div>
    {% } %}
    <!-- <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?> -->
    <div class="field">
        <div class="value">
            <ol class="s-csv-import-navigator">
                <li data-mode="emulate">Upload and assign columns</li>
                <li data-mode="import">Review settings</li>
                <li data-mode="finish">Import</li>
            </ol>
        </div>
    </div>
</div>

<div class="field-group" id="s-csvproduct-report" style="display: none;">
    <div class="field">
        <div class="value"></div>
    </div>
</div>

<div class="field-group" id="s-csvproduct-submit" style="display: none;">
    <div class="field">
        <div class="value submit">
            <input data-emulate-class="" data-emulate-value="Review import settings" data-import-class="large green" data-import-value="Start import" type="submit" class="button green" value="Review import settings">
        </div>

        <div class="js-progressbar-container value" style="display:none;">
            <div class="progressbar blue float-left" style="display: none; width: 70%;">
                <div class="progressbar-outer">
                    <div class="progressbar-inner" style="width: 0;"></div>
                </div>
            </div>
            <img style="float:left; margin-top:8px;" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/img/loading32.gif" />
            <div class="clear"></div>
                <span class="progressbar-description"></span>
            <br clear="left" />
            <br>
            <span class="small" data-mode="import">
                Please do not close your browser window and do not leave this page until the entire import process is finished.
            </span>
            <span class="small italic" data-mode="emulate">
                Gathering information from the file...
            </span>
        </div>
        <br>
        <br>

        <em class="errormsg"></em>
    </div>
</div>

<div class="clear-left"></div>
<script type="text/javascript">

$.wa.locale = $.extend($.wa.locale, {
    'Collision at rows #':'Collision at rows #'
});
</script><?php }} ?>