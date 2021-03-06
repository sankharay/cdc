
<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<form action="<?php echo BASE_URL; ?>/addcontentenglish/onlyenglishready/<?php echo $this->uri->segment(3); ?>" method="post" onsubmit="return checkcategory()">
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo BASE_URL; ?>">Home</a> | Review Data
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
			
            <div class="row-fluid sortable">
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-eye-open"></i> Review English Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">

    <section id="main" class="column">
	
        <article class="module width_half">
			<header><h3>English Copy</h3></header>
             
				<div class="module_content">
                	
                  
						<fieldset>
							<label>Product Name&nbsp;&nbsp;</label>
                            
							<input type="text" name="pName" id="pName" required  value="<?php echo $english_content->prduct_name; ?>" style="width:92%;">
                            <input type="hidden" name="pFplid" id="pFplid" required  value="<?php echo $english_content->fpl_id; ?>" style="width:92%;">
                            <input type="hidden" name="pspprid" id="pspprid" required  value="<?php echo $english_content->spenish_id; ?>" style="width:92%;">
               
                            <br />
                            
						</fieldset>
						

<fieldset>
                        
                        
							<label>Product Short Description&nbsp;&nbsp;</label>
							<textarea rows="12" name="pFeature" id="pFeature"  style="width:490px;" class="cleditor">
<?php 
echo $english_content->short_description;
?>
</textarea>                   

                       	
			<label>Description </label><br />

							<textarea rows="12" name="pDesc" id="pDesc" style="width:490px;" class="cleditor">
                            	<?php 
echo htmlspecialchars_decode(str_replace("\n", '<br/>', $english_content->product_description));
?>
                            </textarea>
                            
                            <!--<button onclick="return translateitem('pDesc')" class="btn btn btn-primary" style="margin-left:15px; margin-bottom:10px;">
                                        <i class="icon-trash icon-white"></i>
                                        <span>Translate</span>
                                    </button> -->
                            </fieldset><br />
                            
						</fieldset>
                        
                        <fieldset>
                        
                            
                            
							<label>Product Specification&nbsp;&nbsp;</label>
							<textarea rows="12" name="pSpecs" id="pSpecs"  style="width:490px;" class="cleditor">
                            <?php 
echo htmlspecialchars_decode(str_replace("\n", '<br/>', $english_content->product_specs));
 ?>
                            </textarea>
                            
                            
						</fieldset><br />
<fieldset>
<label>English Disclaimer</label>
<select name="pDisclaimer" id="disclaimer" onchange="return disclaimerchange(this.value);">
<option value="">Please select disclaimer</option>
<?php foreach($disclaimer as $valuesdis)
{
?>
<option value="<?php echo $valuesdis->id; ?>"><?php echo $valuesdis->english; ?></option>
<?php
}
?>
</select>
</fieldset>
<fieldset>
<label>Video Link&nbsp;&nbsp;</label>
<textarea rows="12" name="pvideo" id="pVideo"  style="width:90%; height:80px;"><?php echo $english_content->eng_video; ?></textarea>
</fieldset>
                        
                        <footer><br />
                        
                    </footer>
                    
                   
                    
                </div>
		</article><!-- end of post new article -->
        
        
         
       
        
		<div class="spacer"></div>
	</section>
					</div>
				</div><!--/span-->
				
				<div class="box span6">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Product Other Details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
<ul id="myTab" class="nav nav-tabs">
<li class="active"><a href="#ginformation">General Information</a></li>
<li><a href="#categories">Category Management</a></li>
<li><a href="#attributes">Attribute Management</a></li>
<li><a href="#metainformation">Meta Information</a></li>
<li><a href="#addoncategory">Additional Categories</a></li>
						</ul>
<div id="myTabContent" class="tab-content">
<!-- general information starts -->
<div id="ginformation" class="tab-pane active">
<h2>General Information</h2>
<fieldset>
                        <label>Product SKU</label>
                        <input type="text" value="<?php echo $english_content->product_sku; ?>" required="" class="span6 typeahead" id="pSku" name="pSku">
                        </fieldset>
                        <fieldset>
                        <label>Product UPC</label>
                  		<input type="text" value="<?php echo $english_content->product_upc; ?>" readonly="" id="pupc" class="span6 typeahead" name="pupc">
                        </fieldset>
                        <fieldset>
                        <label>Product Cost</label>
                        <input type="text" required="required" value="<?php echo $english_content->product_cost; ?>" class="span6 typeahead" id="pcost" name="pcost">
                        </fieldset>
                        <fieldset>
                        <label>Product Retail</label>
                        <input type="text" required="required" value="<?php echo $english_content->product_retail; ?>" class="span6 typeahead" id="pretail" name="pretail">
                        </fieldset>
                        <fieldset>
                        <label>Special Price</label><br>
                        <input type="text" placeholder="Enter Special Price" value="<?php echo $english_content->specialprice; ?>" style="width:160px;" class="input-xlarge" id="pSpecialPrice" name="pSpecialPrice">
                        <input type="text" placeholder="From Date" class="input-xlarge datepicker" id="pSpecialFromDate" name="pSpecialFromDate" style="width:160px;"> To 
                        <input type="text" placeholder="To Date" class="input-xlarge datepicker" id="pSpecialToDate" name="pSpecialToDate" style="width:160px;">
                        </fieldset>
                        <fieldset>
<label>Product MSRP</label>
<input type="text" required="required" value="<?php echo $english_content->product_msrp; ?>" class="span6 typeahead" id="pmsrp" name="pmsrp">
</fieldset>
<fieldset>
<label>Product MAP</label>
<input type="text" required="required" value="<?php echo $english_content->product_map; ?>" class="span6 typeahead" id="pMAP" name="pMAP">
</fieldset>
<fieldset>
<label>Product Shipping</label>
<input type="text" placeholder="Shipping Price" required="required" class="span6 typeahead" id="pShipping" name="pShipping" value="<?php echo $english_content->shippingprice; ?>">
</fieldset>
<fieldset>
<label>Product Inventory</label>
<input type="text" placeholder="Product Inventory" required="required" value="<?php echo $english_content->product_inventory_level; ?>" class="span6 typeahead" id="pInventory" name="pInventory">
</fieldset>
<label>Product Brand</label>
<?php 
if($english_content->product_brand == "")
echo $branddropdown; 
else
echo $branddropdown = $this->addcontentenglishm->get_brand_dropdowns($english_content->product_brand);
?></fieldset>
<fieldset>
<label>Product Vendor Id</label>
<?php 
$vendors = $this->addcontentenglishm->listvendordetails();
?>
<select name="pSource" id="pSource" required="required">
<?php
foreach($vendors as $vendordata)
{
if($english_content->product_source == $vendordata->vendorID)
$selectionsource = "selected='selected'";
else
$selectionsource = "";
	?>
<option <?php echo $selectionsource; ?> value="<?php echo $vendordata->vendorID; ?>" ><?php echo $vendordata->vendorName; ?> - <?php echo $vendordata->vendorID; ?></option>
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
</div>
<!-- general information ends -->
<!-- categories information starts -->
<div id="categories" class="tab-pane">
<h2>Category Management</h2>
<?php
if(strpos($english_content->product_category,'_'))
{
$catarray = explode('_',$english_content->product_category);
$cataid = $catarray[0];
}
else
echo $cataid  = $english_content->product_category;
include(PLUGINS_URL."/categorytree/index_selected.php");
?>
</div>
<!-- categories information ends -->
<!-- categories information starts -->
<div id="attributes" class="tab-pane">
<!--<h2>Category Management</h2> -->
<!-- Attributes section starts -->
<div id="attributes" class="tab-pane">
<h3>Category Attributes</h3>
<p>
<fieldset>
<label>Height ( in Inch )</label>
<input type="text" name="pHeight" id="pHeight" class="span6 typeahead" value="<?php echo $english_content->height; ?>" required="required" > 
<label>Width ( in Inch )</label>
<input type="text" name="pWidth" id="pWidth" class="span6 typeahead" value="<?php echo $english_content->width; ?>" required="required" >
<label>Depth ( in Inch )</label>
<input type="text" name="pLength" id="pLength" class="span6 typeahead" value="<?php echo $english_content->length; ?>" required="required" >
<label>Weight ( in Pound )</label>
<input type="text" name="pWeight" id="pWeight" class="span6 typeahead" value="<?php echo $english_content->weight; ?>" required="required" >
</fieldset>
<div id="catattributes">
<?php 
// check attributes coming as per selection start
$data = $this->addcontentenglishm->get_attributes($english_content->attributes);
$key = key($data);
$catid = $this->addcontentenglishm->get_allattributescat($key);
$main_attribut = $this->addcontentenglishm->get_main_attributes($catid);
if(!$main_attribut)
$main_attribut = $this->addcontentenglishm->get_main_attributes($cataid);
$newatt = $english_content->attributes;
?>
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
	$subatt = $this->addcontentenglishm->get_sub_attributes($values->id);
	?>
    <select <?php echo $name; ?> <?php echo $style; ?> >
    <option value="">Select Attributes</option>
    <?php 
	foreach($subatt as $values)
	{
		?>
    <option <?php if(strpos($newatt,"$values->value") != FALSE) { echo "selected='selected'"; } ?> value="<?php echo  $values->value; ?>"><?php echo  $values->name; ?></option>
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
<?php
// 
?></div>
</p>
</div>
<!-- Attributes section ends -->
<!-- product meta information starts -->
</div>
<div id="metainformation" class="tab-pane">
<h3>Meta Information</h3>
<p>
<div id="metainformations">


<table width="100%" border="0">
  <tr>
    <td><label>Product Keywords</label>
							<textarea rows="12" name="keywords" class="span12 typeahead" id="pSpecs" required="required"><?php echo $english_content->product_metatags; ?></textarea>
						</fieldset></td>
  </tr>
  <tr>
    <td><label>Product Descriptions</label>
							<textarea rows="12" name="keyworddescription" class="span12 typeahead" id="pSpecs" required="required"><?php echo $english_content->product_metadescription; ?></textarea>
						</fieldset></td>
  </tr>
</table>
</div>
</p>
<!-- product meta information ends -->
</div>
<!-- category addon section starts -->
<div id="addoncategory" class="tab-pane">
<h3>Addon Categories</h3>
<p>
<div style="height:500px; overflow:scroll;">
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$abc = new RightMenu();
if(strpos($english_content->product_category,'_'))
{
$catarray = explode('_',$english_content->product_category);
echo $abc->getselectionMenu($parent=0,$catarray[1]);
}
else
{
echo $abc->getaddonMenu();
}
?>
</div>
</p>
<!-- category addon section ends -->
</div>
</div>
					</div>
				</div><!--/span-->
				
			</div><!--/row-->
			
            
                    <div style="text-align:center"><input type="submit" value=" Final Product Submit" class="btn btn-large btn-primary"></div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		
                    </form>