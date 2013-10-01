
<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<form id="english-form" action="<?php echo BASE_URL; ?>/addcontentenglish/onlyenglishready/<?php echo $this->uri->segment(3); ?>" method="post" onsubmit="return checkcategory()">
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
							<label>Product Name&nbsp;&nbsp;<span class="asterik">*</span></label>
<?php
if($temp_content)
{
if($temp_content->prduct_name != "")
$productname = $temp_content->prduct_name;
else
$productname = $english_content->prduct_name;
}
else
$productname = $english_content->prduct_name;
$productname = str_replace("\0", "",$productname);
?>
							<input type="text" name="pName" id="pName" required  value="<?php echo $productname; ?>" style="width:92%;" onchange="return savetempname('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
                            <input type="hidden" name="mptid" id="mptid" required  value="<?php echo $this->uri->segment(3); ?>" style="width:92%;">
                            <input type="hidden" name="pFplid" id="pFplid" required  value="<?php echo $english_content->fpl_id; ?>" style="width:92%;">
                            <input type="hidden" name="pspprid" id="pspprid" required  value="<?php echo $english_content->spenish_id; ?>" style="width:92%;">
               
                            <br />
                            
						</fieldset>
						

<fieldset>
   <?php
if($temp_content)
{
if($temp_content->short_description != "")
$short_description = $temp_content->short_description;
else
$short_description = $english_content->short_description;
}
else
{
$short_description = $english_content->short_description;
}
if($short_description == "")
{
$short_description = $english_content->product_description;
}
$short_description = str_replace("\0", "",$short_description);
?>
                        
							<label>Product Short Description&nbsp;<span class="asterik">*</span></label>
							<textarea rows="12" name="pFeature" id="pFeature"  style="width:490px;" class="cleditor">
<?php 
echo substr($short_description,0,200); 
?>
</textarea>                   
<?php
if($temp_content)
{
if($temp_content->product_description != "")
$description = $temp_content->product_description;
else
$description = $english_content->product_description;
}
else
$description = $english_content->product_description;
$description = str_replace("\0", "",$description);
?>
                       	
			<label>Description <span class="asterik">*</span></label><br />

							<textarea rows="12" name="pDesc" id="pDesc" style="width:490px;" class="cleditor">
                            	<?php 
echo htmlspecialchars_decode(str_replace("\n", '<br/>', $description));
?>
                            </textarea>
                            
                            <!--<button onclick="return translateitem('pDesc')" class="btn btn btn-primary" style="margin-left:15px; margin-bottom:10px;">
                                        <i class="icon-trash icon-white"></i>
                                        <span>Translate</span>
                                    </button> -->
                            </fieldset><br />
                            
						</fieldset>
                        
                        <fieldset>
                        
<?php
if($temp_content)
{
if($temp_content->product_specs != "")
$product_specs = $temp_content->product_specs;
else
$product_specs = $english_content->product_specs;
}
else
$product_specs = $english_content->product_specs;
$product_specs = str_replace("\0", "",$product_specs);
?>                        
                            
							<label>Product Specification&nbsp;&nbsp;</label>
							<textarea rows="12" name="pSpecs" id="pSpecs"  style="width:490px;" class="cleditor">
                            <?php 
echo htmlspecialchars_decode(str_replace("\n", '<br/>', $product_specs));
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
<?php
if($temp_content)
{
if($temp_content->eng_video != "")
$eng_video = $temp_content->eng_video;
else
$eng_video = $english_content->eng_video;
}
else
$eng_video = $english_content->eng_video;
?>
<fieldset>
<label>Video Link&nbsp;&nbsp;</label>
<textarea rows="12" name="pvideo" id="pVideo"  style="width:90%; height:80px;" onchange="return savetempvideo('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);"><?php echo $eng_video; ?></textarea>
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
<li class="active attributes"><a href="#ginformation">General Information</a></li>
<li class="categories"><a href="#categories">Category Management</a></li>
<li class="attributes"><a href="#attributes">Attribute Management</a></li>
<li class="metainformation"><a href="#metainformation">Meta Information</a></li>
<li class="addoncategory"><a href="#addoncategory">Additional Categories</a></li>
						</ul>
<div id="myTabContent" class="tab-content">
<!-- general information starts -->
<div id="ginformation" class="tab-pane active">
<h2>General Information</h2>
<fieldset>
<?php
if($temp_content)
{
if($temp_content->product_sku != "")
$product_sku = $temp_content->product_sku;
else
$product_sku = $english_content->product_sku;
}
else
$product_sku = $english_content->product_sku;
?>
                        <label>Product SKU<span class="asterik">*</span></label>
                        <input type="text" value="<?php echo $product_sku; ?>" required="" class="span6 typeahead" id="pSku" name="pSku" onchange="return savetempsku('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
                        </fieldset>
                        <fieldset>
                        <label>Product UPC<span class="asterik">*</span></label>
                  		<input type="text" value="<?php echo $english_content->product_upc; ?>" id="pupc" class="span6 typeahead" name="pupc">
                        </fieldset>
                        <fieldset>
<?php
if($temp_content)
{
if($temp_content->product_cost != "")
$product_cost = $temp_content->product_cost;
else
$product_cost = $english_content->product_cost;
}
else
$product_cost = $english_content->product_cost;
?>
                        <label>Product Cost<span class="asterik">*</span></label>
                        <input type="text" required="required" value="<?php echo $product_cost; ?>" class="span6 typeahead" id="pcost" name="pcost"  onchange="return savetempcost('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
                        </fieldset>
                        <fieldset>
<?php
if($temp_content)
{
if($temp_content->product_retail != "")
$product_retail = $temp_content->product_retail;
else
$product_retail = $english_content->product_retail;
}
else
$product_retail = $english_content->product_retail;
?>
                        <label>Product Retail<span class="asterik">*</span></label>
                        <input type="text" required="required" value="<?php echo $product_retail; ?>" class="span6 typeahead" id="pretail" name="pretail"  onchange="return savetempretail('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
                        </fieldset>
                        <fieldset>
<?php
if($temp_content)
{
if($temp_content->specialprice != "")
$specialprice = $temp_content->specialprice;
else
$specialprice = $english_content->specialprice;
}
else
$specialprice = $english_content->specialprice;
?>
                        <label>Special Price</label><br>
                        <input type="text" placeholder="Enter Special Price" value="<?php echo $specialprice; ?>" style="width:160px;" class="input-xlarge" id="pSpecialPrice" name="pSpecialPrice"  onchange="return savetempsprice('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
                        <input type="text" placeholder="From Date" class="input-xlarge datepicker" id="pSpecialFromDate" name="pSpecialFromDate" style="width:160px;"  onchange="return savetempspricefromdate('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);"> To 
                        <input type="text" placeholder="To Date" class="input-xlarge datepicker" id="pSpecialToDate" name="pSpecialToDate" style="width:160px;"  onchange="return savetempspricetodate('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
                        </fieldset>
                        <fieldset>
<?php
if($temp_content)
{
if($temp_content->product_msrp != "")
$product_msrp = $temp_content->product_msrp;
else
$product_msrp = $english_content->product_msrp;
}
else
$product_msrp = $english_content->product_msrp;
?>
<label>Product MSRP<span class="asterik">*</span></label>
<input type="text" required="required" value="<?php echo $product_msrp; ?>" class="span6 typeahead" id="pmsrp" name="pmsrp"  onchange="return savetempmrsp('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
</fieldset>
<fieldset>
<?php
if($temp_content)
{
if($temp_content->product_map != "")
$product_map = $temp_content->product_map;
else
$product_map = $english_content->product_map;
}
else
$product_map = $english_content->product_map;
?>
<label>Product MAP<span class="asterik">*</span></label>
<input type="text" required="required" value="<?php echo $product_map; ?>" class="span6 typeahead" id="pMAP" name="pMAP"  onchange="return savetemppmap('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
</fieldset>
<fieldset>
<?php
if($temp_content)
{
if($temp_content->shippingprice != "")
$shippingprice = $temp_content->shippingprice;
else
$shippingprice = $english_content->shippingprice;
}
else
$shippingprice = $english_content->shippingprice;
?>
<label>Product Shipping<span class="asterik">*</span></label>
<input type="text" placeholder="Shipping Price" required="required" value="<?php echo $shippingprice; ?>" class="span6 typeahead" id="pShipping" name="pShipping"  onchange="return savetempshipping('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);" x-moz-errormessage="Shipping Column Required">
</fieldset>
<fieldset>
<?php
if($temp_content)
{
if($temp_content->product_inventory_level != "")
$product_qty = $temp_content->product_inventory_level;
else
$product_qty = $english_content->product_inventory_level;
}
else
$product_qty = $english_content->product_inventory_level;
?>
<label>Product Inventory<span class="asterik">*</span></label>
<input type="text" placeholder="Product Inventory" value="<?php echo $product_qty; ?>" class="span6 typeahead" required="" id="pInventory" name="pInventory"  onchange="return savetempinventry('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
</fieldset>
<label>Product Brand</label>
<?php
if($temp_content)
{
if($temp_content->product_brand != "")
$product_brand = $temp_content->product_brand;
else
$product_brand = $english_content->product_brand;
}
else
$product_brand = $english_content->product_brand;
?>
<?php 
if($product_brand != "")
echo $branddropdown = $this->addcontentenglishm->get_brand_dropdowns($product_brand);
else
echo $branddropdown;
?></fieldset>
<fieldset>
<label>Product Vendor Id</label>
<?php
if($english_content->product_source != "")
$vendorrealvdid = $this->addcontentenglishm->get_vendor_realid($english_content->product_source);
$vendors = $this->addcontentenglishm->listvendordetails();
?>
<select name="pSource" id="pSource" required="required">
<option value="">Please select Vendor Id</option>
<?php
foreach($vendors as $vendordata)
{
if($vendordata->vendorID == $vendorrealvdid)
{
$selection = " selected='selected'";
}
else
{
$selection = "";
}
	?>
<option <?php echo $selection; ?> value="<?php echo $vendordata->vendorID; ?>"><?php echo $vendordata->vendorName; ?> - <?php echo $vendordata->vendorID; ?></option>
    <?php
	
}
?>
</select>
</fieldset>
<fieldset>
<label>Is Set<span class="asterik">*</span></label>
<select name="pisset" required="required">
<option value="">Please Select Isset Option</option>
<option value="1">Yes</option>
<option value="0" selected="selected">No</option>
</select>
</fieldset>
<fieldset>
<label>Online Only<span class="asterik">*</span></label>
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
echo $cataid  = $this->addcontentenglishm->getcatename($english_content->product_category);
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
<?php
if($temp_content)
{
if($temp_content->height != "")
$height = $temp_content->height;
else
$height = $english_content->height;
}
else
$height = $english_content->height;
?>
<label>Height ( in Inch )<span class="asterik">*</span></label>
<input type="text" name="pHeight" id="pHeight" class="span6 typeahead" value="<?php echo $height; ?>" required="required"   onchange="return savetempheight('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);"> 
<label>Width ( in Inch )<span class="asterik">*</span></label>
<?php
if($temp_content)
{
if($temp_content->width != "")
$width = $temp_content->width;
else
$width = $english_content->width;
}
else
$width = $english_content->width;
?>
<input type="text" name="pWidth" id="pWidth" class="span6 typeahead" value="<?php echo $width; ?>" required="required"   onchange="return savetempwidth('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
<label>Depth ( in Inch )<span class="asterik">*</span></label>
<?php
if($temp_content)
{
if($temp_content->length != "")
$length = $temp_content->length;
else
$length = $english_content->length;
}
else
$length = $english_content->length;
?>
<input type="text" name="pLength" id="pLength" class="span6 typeahead" value="<?php echo $length; ?>" required="required"   onchange="return savetemplength('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
<label>Weight ( in Pound )<span class="asterik">*</span></label>
<?php
if($temp_content)
{
if($temp_content->weight != "")
$weight = $temp_content->weight;
else
$weight = $english_content->weight;
}
else
$weight = $english_content->weight;
?>
<input type="text" name="pWeight" id="pWeight" class="span6 typeahead" value="<?php echo $weight; ?>" required="required"   onchange="return savetempweight('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);">
</fieldset>
<div id="catattributes">
<?php
if($temp_content)
{
if($temp_content->attributes != "")
$english_content = $temp_content->attributes;
else
$english_content = $english_content->attributes;
}
else
$english_content = $english_content->attributes;
// check attributes coming as per selection start
$data = $this->addcontentenglishm->get_attributes($english_content);
$key = key($data);
$catid = $this->addcontentenglishm->get_allattributescat($key);
$main_attribut = $this->addcontentenglishm->get_main_attributes($catid);
if(!$main_attribut)
$main_attribut = $this->addcontentenglishm->get_main_attributes($cataid);
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
$callfunction = "subattributes".$values->id."($values->id,this)";
$function = "subattributes".$values->id."(attid,replaces)";
}
else
{
$style = "";
$name = "name=subattributes_".$values->id;	
$callfunction = "subattributes".$values->id."($values->id,this)";
$function = "subattributes".$values->id."(attid,replaces)";
}
?>
  <tr >
    <td valign="top"><strong><?php echo $values->attributename; ?><span class="asterik">*</span></strong></td>
    <td><?php 
	$subatt = $this->addcontentenglishm->get_sub_attributes($values->id);
	?>
    <select <?php echo $name; ?> <?php echo $style; ?> onchange="<?php echo $callfunction; ?>;" >
    <option value="">Select Attributes</option>
    <?php 
	foreach($subatt as $values)
	{
		?>
    <option <?php if (in_array($values->value, $data)) { echo "selected='selected'"; } ?> value="<?php echo  $values->value; ?>"><?php echo  $values->name; ?></option>
    <?php
	}
	?>
    </select>
<script>
function <?php echo $function; ?>
{
	var replacevalue = replaces.value;
	var mptid = $('#mptid').val();
	var url = "<?php echo BASE_URL; ?>";
	$.ajax({
		  type: "POST",
		  url: url+"/addtempdata/saveattributes",
		  data: { mptid: mptid,attid: attid,replacevalue: replacevalue }
		}).done(function( msg ) {
		  // alert( "Data Send: " + msg );
		 if(msg = 1){
			// alert("Data send for recheck");			
			// window.location.reload(true);
			
		}
		});
}
</script>
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
<h3>Meta Information<span class="asterik">*</span></h3>
<p>
<div id="metainformations">

<?php
$main_metainfo = $this->addcontentenglishm->get_metainformationcat($cataid);
?>
<?php
if($main_metainfo)
{
	?>
    <style>
	.we
	{
		position:relative;
	}
	</style>
<table width="100%" border="0">
  <tr>
    <td><label>Product Keywords<span class="asterik">*</span></label>
							<textarea rows="12" name="keywords" class="span12 typeahead" id="keywords" required="required"><?php echo $main_metainfo->metakeywords; ?></textarea>
						</fieldset></td>
  </tr>
  <tr>
    <td><label>Product Descriptions<span class="asterik">*</span></label>
							<textarea rows="12" name="keyworddescription" class="span12 typeahead" id="keyworddescription" required="required"><?php echo htmlspecialchars_decode($short_description); ?></textarea>
						</fieldset></td>
  </tr>
</table>
                        <?php
}
else
{
?>
<table width="100%" border="0">
  <tr>
    <td width=""><label>Product Keywords<span class="asterik">*</span></label>
							<textarea rows="12" name="keywords" class="span12 typeahead" id="keywords" required="required"></textarea>
						</fieldset></td>
  </tr>
  <tr>
    <td><label>Product Descriptions<span class="asterik">*</span></label>
							<textarea rows="12" name="keyworddescription" class="span12 typeahead" id="keyworddescription" required="required">
<?php echo htmlspecialchars_decode($short_description); ?>
</textarea>
						</fieldset></td>
  </tr>
</table>
<?php	
}
?>
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
$abc = new RightMenu();
echo $abc->getaddonMenu();
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
<script>


function savebrandname(vals)
{
	var vbrand = vals.value;
	var url= "http://www.icuracao.com/cdc/script";
	$.ajax({
		  type: "POST",
		  url: url+"/addtempdata/savetempbrand",
		  data: { mptid: $('#mptid').val(),vbrand: vbrand }
		}).done(function( msg ) {
		  // alert( "Data Send: " + msg );
		 if(msg = 1){
			// alert("Data send for recheck");			
			// window.location.reload(true);
			
		}
		});
}
</script>