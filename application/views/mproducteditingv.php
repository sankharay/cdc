<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> > Final Product 
					</li>
				</ul>
			</div>
<div id="magentoupdatedone"></div>
<div id="waiting" class="waiting" ><img src="<?php echo BASE_URL; ?>/img/loader.gif" width="32" height="32" /></div>
		<div class="spacer"></div>
			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Edit Product</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <section id="main" class="column">
        <article class="module width_full">
				<div class="module_content">
<ul id="myTab" class="nav nav-tabs">
<li class="active"><a href="#ginformation">English Version</a></li>
<li><a href="#categories">Spanish Version</a></li>
<li><a href="#metainformation">Categories</a></li>
<li><a href="#addoncategory">Addon Category</a></li>
						</ul>
<div id="myTabContent" class="tab-content">
<!-- general information starts -->
<div id="ginformation" class="tab-pane active">
<h3>General Information</h3>
<p>
<fieldset>
<label class="control-label">Product Name</label>
<input type="text" class="span6 typeahead" name="pName" id="pName" required  value="<?php echo $content->prduct_name; ?>">
</fieldset>
<fieldset>
<label>Short Description</label>
<textarea name="finalpsdesc" id="finalpsdesc" class="span6 cleditor" required>
<?php echo $content->short_description; ?>
</textarea>
</fieldset>
<fieldset>
<label>Description</label>
<textarea name="pDesc" id="pDesc" class="span6 cleditor" required>
<?php echo $content->product_description; ?>
</textarea>
</fieldset>
<label>Product Specification</label>
							<textarea rows="12" name="pSpecs" class="cleditor" id="pSpecs" required="required">
<?php echo $content->product_specs; ?>
                            </textarea>
						</fieldset>
<fieldset>
<label>Product SKU</label>
<input type="text" name="pSku" id="pSku" class="span6 typeahead" required value="<?php echo $content->product_sku; ?>">
</fieldset>
<label>Product UPC</label>
<input type="text" name="pupc" class="span6 typeahead" id="pupc" readonly value="<?php echo $content->product_upc; ?>">
</fieldset>
<fieldset>
<label>Product Cost</label>
<input type="text" name="pcost" id="pcost" class="span6 typeahead" value="<?php echo $content->product_cost; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product MSRP</label>
<input type="text" name="pmsrp" id="pmsrp" class="span6 typeahead" value="<?php echo $content->product_msrp; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product Retail</label>
<input type="text" name="pretail" id="pretail" class="span6 typeahead" value="<?php echo $content->product_retail; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product MAP</label>
<input type="text" name="pMAP" id="pMAP" class="span6 typeahead" value="<?php echo $content->product_map; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product Brand</label>
<select name="pBrand" id="pBrand" required="required">
<option value="" selected="selected">Please Select Brand</option>
<?php
foreach($branddropdown as $bdropdown)
{
?>
<option value="<?php echo $bdropdown->id; ?>" <?php if($bdropdown->id == $content->product_source) { echo "selected='selected'"; } ?>><?php echo $bdropdown->brandName; ?></option>
<?php
}
?></select><?php if($content->product_map != "" ) { echo "Current Selection : ".$content->product_brand; } ?></fieldset>
<fieldset>
<label>Product Disclaimer</label>
<select name="pDisclaimer" id="pDisclaimer" required="required">
<option value="" selected="selected">Please Select Disclaimer</option>
<?php
foreach($disclaimerdropdown as $ddropdown)
{
?>
<option value="<?php echo $ddropdown->id; ?>" <?php if($ddropdown->id == $content->product_disclaimer) { echo "selected='selected'"; } ?>><?php echo $ddropdown->name; ?></option>
<?php
}
?></select>
</fieldset>
<fieldset>
<label>Product Vendor Id</label>
<?php 
$vendors = $this->magentoeditingm->listvendordetails();
?>
<select name="pSource" id="pSource" required="required">
<?php
foreach($vendors as $vendordata)
{
	?>
<option value="<?php echo $vendordata->vmID; ?>" <?php if($vendordata->vmID == $content->product_source) { echo "selected='selected'"; } ?>><?php echo $vendordata->vendorName; ?> - <?php echo $vendordata->vendorID; ?></option>
    <?php
	
}
?>
</select>
</fieldset>
<fieldset>
<label>Is Set</label>
<select name="pisset" required="required">
<option value="">Please Select Isset Option</option>
<option value="1">Yes</option>
<option value="0" selected="selected">No</option>
</select>
</fieldset>
<fieldset>
<label>Online Only</label>
<select name="ponlineonly" required="required">
<option value="">Please Select Online Option</option>
<option value="1">Yes</option>
<option value="0" selected="selected">No</option>
</select>
</fieldset>
<fieldset>
<label>Height</label>
<input type="text" name="pHeight" id="pHeight" class="span6 typeahead" value="<?php echo $content->height; ?>" required="required" >
<label>Width</label>
<input type="text" name="pWidth" id="pWidth" class="span6 typeahead" value="<?php echo $content->width; ?>" required="required" >
<label>Depth</label>
<input type="text" name="pLength" id="pLength" class="span6 typeahead" value="<?php echo $content->length; ?>" required="required" >
<label>Weight</label>
<input type="text" name="pWeight" id="pWeight" class="span6 typeahead" value="<?php echo $content->weight; ?>" required="required" >
</fieldset>
<label>Product Keywords</label>
							<textarea rows="12" name="keywords" class="span6 typeahead" id="pkeywords" required="required"><?php echo $content->product_metatags; ?></textarea>
						</fieldset>
                        <label>Product Descriptions</label>
							<textarea rows="12" name="keyworddescription" class="span6 typeahead" id="pkeyworddescription" required="required"><?php echo $content->product_metadescription; ?></textarea>
						</fieldset>
</p>
<input type="submit" value="Save English Product" class="btn btn-primary" onclick="return msaveedit('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
</div>
<!-- general information ends -->
<!-- category section starts -->
<div id="categories" class="tab-pane">
<h3>Spanish Content</h3>
<p>
<fieldset>
<label class="control-label">Product Name</label>
<input type="text" class="span6 typeahead" name="spName" id="spName" required  value="<?php echo $contents->prduct_name; ?>">
</fieldset>
<fieldset>
<label>Short Description</label>
<textarea name="sfinalpsdesc" id="sfinalpsdesc" class="span6 cleditor" required>
<?php echo $contents->short_description; ?>
</textarea>
</fieldset>
<fieldset>
<label>Description</label>
<textarea name="spDesc" id="spDesc" class="span6 cleditor" required>
<?php echo $contents->product_description; ?>
</textarea>
</fieldset>
<label>Product Specification</label>
							<textarea rows="12" name="spSpecs" class="cleditor" id="spSpecs" required="required">
<?php echo $contents->product_specs; ?>
                            </textarea>
						</fieldset>
<fieldset>
<fieldset>
<label>Product Keywords</label>
							<textarea rows="12" name="skeywords" class="span6 typeahead" id="skeywords" required="required"><?php echo $contents->product_metatags; ?></textarea>
						</fieldset>
                        <label>Product Descriptions</label>
							<textarea rows="12" name="skeyworddescription" class="span6 typeahead" id="skeyworddescription" required="required"><?php echo $contents->product_metadescription; ?></textarea>
						</fieldset>
</p>
<input type="submit" value="Save Spanish Product" class="btn btn-primary" onclick="return msavespanishedit('<?php echo BASE_URL; ?>',<?php echo $content->spenish_id; ?>);">
</div>
<!-- category section ends -->
<!-- product Categories information starts -->
<div id="metainformation" class="tab-pane">
<form action="<?php echo BASE_URL; ?>/magentoediting/mproductlisting/<?php echo $this->uri->segment(3); ?>" method="post">
<h3>Main Category - <?php
echo $this->magentoeditingm->get_categiry_name($selected_category);
include(PLUGINS_URL."/categorytree/index.php");
?></h3>
<p>
<input type="hidden" name="categoryid" value="<?php echo $selected_category; ?>" />
<br /><?php
$selectedarray = $this->magentoeditingm->get_selected_attributes($content->attributes);
$main_attribut = $this->magentoeditingm->get_category_attributes($selected_category);
?>
<div id="catattributes">
<table width="100%" border="0">
<?php
if($main_attribut)
{
foreach($main_attribut as $values)
{
if($values->section_scope == 2)
{
$style = "style='height:150px;' multiple";
$name = "name=subattributes_".$values->id."[]";
}
else
{
$style = "";
$name = "name=subattributes_".$values->id;	
}
?>
  <tr >
    <td valign="top"><strong><?php echo $values->attributename; ?></strong></td>
    <td><?php 
	$subatt = $this->magentoeditingm->get_category_sub_attributes($values->id);
	?>
    <select <?php echo $name; ?> <?php echo $style; ?> required="required" >
    <?php 
	foreach($subatt as $values)
	{
		?>
    <option value="<?php echo  $values->id; ?>" <?php if (in_array($values->id, $selectedarray)) { echo "selected='selected'"; } ?> ><?php echo  $values->name; ?></option>
    <?php
	}
	?>
    </select>
    </td>
  </tr>
<?php
}
}
else
{
?>
<tr><td><strong>No Attribute relate to this product</strong></td></tr>
<?php
}
?>
</table>
</div>
<br />
<br />
<br />
<input type="submit" value="Save Attributes" class="btn btn-primary">
</p>
</form>
</div>
<!-- product Categories information ends -->
<!-- category addon section starts -->
<div id="addoncategory" class="tab-pane">
<h3>Addon Categories</h3>
<p>
    
<?php
$abc = new RightMenu();
echo $abc->getaddonMenu();
?>
</p>
<input type="submit" value="Save Addon Categories" class="btn btn-primary" onclick="return updateadddons('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
</div>
<!-- category addon section ends -->
</div>
                        <footer>
                        <div class="submit_link">
                        </div>
                    </footer>
                </div>
		</article><!-- end of post new article -->
        

	</section>
					</div>
				</div>
			</div><!--/row-->
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>