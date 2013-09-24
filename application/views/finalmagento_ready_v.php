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
						<a href="<?php echo BASE_URL; ?>">Home</a> | English Ready
                        
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Magento Ready</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Product Name</th>
								  <th>Product SKU</th>
								  <th>Product UPC</th>
								  <th>Brand</th>
								  <th>Source</th>
								  <th>Add Addons</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  if($content)
						  {
						  foreach($content as $value)
						  {
							  ?>
							  
							<tr>
								<td><?php echo $value->prduct_name; ?></td>
								<td class="center"><?php echo $value->product_sku; ?></td>
								<td class="center">
                                <?php echo $value->product_upc; ?>
                                </td>
								<td class="center">
									<?php echo $value->product_brand; ?>
								</td>
								<td class="center">
									<?php echo $this->finalproductsm->getvendor($value->product_source); ?>
									</a>
								</td>
								<td class="center">
<!-- <button class="btn btn-mini btn-success" onclick="myPopup2('<?php echo PLUGINS_WEB_URL; ?>/categorytree/index_pop.php?fpl_id=<?php echo $value->fpl_id; ?>&product_sku=<?php echo trim($value->product_sku); ?>&product_source=<?php echo trim($value->product_source); ?>')">Add Related Products</button>-->
<a class="cboxElement" href="<?php echo BASE_URL; ?>/addrelatedproducts/index/<?php echo $value->fpl_id; ?>">
<button class="btn btn-mini btn-primary">Add Related Products</button></a>
<a class="cboxElement" href="<?php echo BASE_URL; ?>/addonmanagement/checkaddons/<?php echo $value->fpl_id; ?>"><button class="btn btn-mini btn-primary cboxElement" >Check Related Products</button></a>
								</td>
								<td class="center">
				<div id="updating">
<?php 
if($value->status == 1)
{ ?>
<a href="<?php echo  BASE_URL; ?>/addcontentenglish/editreviewenglish/<?php echo $value->fpl_id; ?>/1"><button class="btn btn-mini btn-primary" id="finalproductview">Edit Product</button></a>&nbsp;&nbsp;
<button class="btn btn-mini  btn-info btn-setting" onclick="send_magento('<?php echo PLUGINS_WEB_URL; ?>','<?php echo $value->fpl_id; ?>');">Send to Magento</button>
<button class="btn btn-mini  btn-info btn-setting" onclick="send_magento_staging('<?php echo PLUGINS_WEB_URL; ?>','<?php echo $value->fpl_id; ?>');">Send to Staging</button>
<?php } else { ?>
<a href="<?php echo  BASE_URL; ?>/addcontentenglish/editreviewenglish/<?php echo $value->fpl_id; ?>/1"><button class="btn btn-mini btn-primary" id="finalproductview">Edit Product</button></a>&nbsp;&nbsp;
<button class="btn btn-mini  btn-info btn-setting" onclick="edit_magento('<?php echo PLUGINS_WEB_URL; ?>','<?php echo $value->fpl_id; ?>');">Edit to Magento</button>
<?php } ?>
&nbsp;&nbsp;<a href="<?php echo BASE_URL; ?>/productpreview/index.php?fpl_id=<?php echo $value->fpl_id; ?>" target="_blank"><button class="btn btn-mini btn-primary" id="finalproductview">Final Preview</button></a>&nbsp;&nbsp;
                    &nbsp;&nbsp;<!--<a href="<?php echo BASE_URL; ?>/productpreview/spanish_index.php?fpl_id=<?php echo $value->fpl_id; ?>" target="_blank"><button class="btn btn-mini btn-primary" id="finalproductview">Final Spanish Preview</button></a>--></div>
<div id="magentoupdatedone" style="display:none;">DONE</div>
								</td>
							</tr>
							
							  <?php
						  }
						  }
						  ?>
						  </tbody><tfoot>
<tr>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Name" name="search_sorting">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search SKU" name="search_platform">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search UPC" name="search_productname">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Brand" name="search_sku">
	</th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search UPC" name="search_upc">
	</th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search Brand" name="search_brand">
	</th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search Brand" name="search_brand">
	</th>
</tr>
</tfoot>
					  </table>  
					</div>
				</div>
			</div><!--/row-->
			<div id="notify"></div>
<div id="waiting" class="waiting" ><img src="http://localhost/app/script/img/loader.gif" width="32" height="32" /></div>
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		

		<script>
		
// magento section starts
function send_magento_staging(url,fpl_id){
	// $('#s'+id).htmlarea('updateHtmlArea','');
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	$.ajax({
		  type: "GET",
		  url: url+"/magentomanagement/savedatatomagento_staging_editing.php",
		  data: { fpl_id: fpl_id }
		}).done(function( msg ) {
		  // alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send to magento")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");		
			window.location.reload(true);
			
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");		
			window.location.reload(true);
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");		
			window.location.reload(true);
		}
		
		 
		});
}
</script>
