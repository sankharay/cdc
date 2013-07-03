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

			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Final Product</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <section id="main" class="column">
        <article class="module width_full">
				<div class="module_content">
                    <form action="<?php echo BASE_URL; ?>/contentsearch/englishready" method="post" onsubmit="return checkcategory()">
      
<ul id="myTab" class="nav nav-tabs">
<li class="active"><a href="#ginformation">General Information</a></li>
<li><a href="#categories">Category Management</a></li>
<li><a href="#attributes">Category Attributes</a></li>
<li><a href="#metainformation">Metatags</a></li>
<li><a href="#addoncategory">Addon Category</a></li>
						</ul>
<div id="myTabContent" class="tab-content">
<!-- general information starts -->
<div id="ginformation" class="tab-pane active">
<h3>General Information</h3>
<p>
<fieldset>
<label class="control-label">Product Name</label>
<input type="text" class="span6 typeahead" name="pName" id="pName" required  value="<?php echo htmlspecialchars($_POST['finalpname'],ENT_QUOTES)?>">
</fieldset>
<fieldset>
<label>Description</label>
<textarea name="pDesc" id="pDesc" class="span6 cleditor" required>
<?php echo $this->input->post('finalpdesc'); ?>
</textarea>
</fieldset>
<fieldset>
<label>Short Description</label>
<textarea name="finalpsdesc" id="finalpsdesc" class="span6 cleditor" required>
<?php echo $this->input->post('finalpsdesc'); ?>
</textarea>
</fieldset>
<fieldset>
<label>Product Specification</label>
							<textarea rows="12" name="pSpecs" class="cleditor" id="pSpecs" required="required"><?php echo htmlspecialchars_decode($this->input->post('finalspecs')); ?></textarea>
</fieldset>
<fieldset>
<label>Product SKU</label>
<input type="text" name="pSku" id="pSku" class="span6 typeahead" required value="<?php echo $_POST['sku']?>">
</fieldset>
<label>Product UPC</label>
<input type="text" name="pupc" class="span6 typeahead" id="pupc" readonly value="<?php echo $this->session->userdata('productupc'); ?>">
</fieldset>
<fieldset>
<label>Product Cost</label>
<input type="text" name="pcost" id="pcost" class="span6 typeahead" value="<?php echo $productdetails->product_cost; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product Retail</label>
<input type="text" name="pretail" id="pretail" class="span6 typeahead" value="<?php echo $productdetails->product_retail; ?>" required="required" >
</fieldset>
<fieldset>
<label>Special Price</label><br />
<input type="number" name="pSpecialPrice" id="pSpecialPrice" class="input-xlarge" style="width:160px;" value="" placeholder="Enter Special Price" >
<input type="text" style="width:160px;" name="pSpecialFromDate" id="pSpecialFromDate" class="input-xlarge datepicker" value="" placeholder="From Date" > To 
<input type="text" style="width:160px;" name="pSpecialToDate" id="pSpecialToDate" class="input-xlarge datepicker" value="" placeholder="To Date"  >
</fieldset>
<fieldset>
<label>Product MSRP</label>
<input type="text" name="pmsrp" id="pmsrp" class="span6 typeahead" value="<?php echo $productdetails->product_msrp; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product MAP</label>
<input type="text" name="pMAP" id="pMAP" class="span6 typeahead" value="<?php echo $productdetails->product_map; ?>" required="required" >
</fieldset>
<fieldset>
<label>Product Shipping</label>
<input type="text" name="pShipping" id="pShipping" class="span6 typeahead" value="" required="required" placeholder="Shipping Price" >
</fieldset>
<fieldset>
<label>Product Brand</label>
<?php echo $branddropdown; ?> <?php if($_POST['brand'] != "" ) { echo "Current Selection : ".$_POST['brand']; } ?></fieldset>
<fieldset>
<label>Product Disclaimer</label>
<?php echo $disclaimerdropdown; ?>
</fieldset>
<fieldset>
<label>Product Vendor Id</label>
<?php 
$vendors = $this->contentsearchm->listvendordetails();
?>
<select name="pSource" id="pSource" required="required">
<?php
foreach($vendors as $vendordata)
{
	?>
<option value="<?php echo $vendordata->vmID; ?>" <?php if($vendordata->vmID == $productdetails->product_source) { echo "selected='selected'"; } ?>><?php echo $vendordata->vendorName; ?> - <?php echo $vendordata->vendorID; ?></option>
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
</p> 
</div>
<!-- general information ends -->
<!-- category section starts -->
<div id="categories" class="tab-pane">
<h3>All Category</h3>
<p>
<?php
include(PLUGINS_URL."/categorytree/index.php");
?>

</p>
</div>
<!-- category section ends -->
<!-- Attributes section starts -->
<div id="attributes" class="tab-pane">
<h3>Category Attributes</h3>
<p>
<fieldset>
<label>Height</label>
<input type="text" name="pHeight" id="pHeight" class="span6 typeahead" value="<?php echo $productdetails->height; ?>" required="required" >
<label>Width</label>
<input type="text" name="pWidth" id="pWidth" class="span6 typeahead" value="<?php echo $productdetails->width; ?>" required="required" >
<label>Depth</label>
<input type="text" name="pLength" id="pLength" class="span6 typeahead" value="<?php echo $productdetails->length; ?>" required="required" >
<label>Weight</label>
<input type="text" name="pWeight" id="pWeight" class="span6 typeahead" value="<?php echo $productdetails->weight; ?>" required="required" >
</fieldset>
<div id="catattributes"></div>
</p>
</div>
<!-- Attributes section ends -->
<!-- product meta information starts -->
<div id="metainformation" class="tab-pane">
<h3>Meta Information</h3>
<p>
<div id="metainformations"></div>
</p>
</div>
<!-- product meta information ends -->
<!-- category addon section starts -->
<div id="addoncategory" class="tab-pane">
<h3>Addon Categories</h3>
<p>
<?php
$abc = new RightMenu();
echo $abc->getaddonMenu();
?>

</p>
</div>
<!-- category addon section ends -->
</div>
                        <footer>
                        <div class="submit_link">
                          <input type="submit" value="English Ready" class="btn btn-primary">
                        </div>
                    </footer>
                    
                    </form>
                    
                    
                </div>
		</article><!-- end of post new article -->
        
		<div class="spacer"></div>
	</section>
					</div>
				</div>
			</div><!--/row-->
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>