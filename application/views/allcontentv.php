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
						<a href="<?php echo BASE_URL; ?>">Home</a> 
                        
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Search Products</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>&nbsp;&nbsp;<button class="btn btn-mini btn-primary" id="rasearch">Range Search</button></div>
<div id="rangesearch" style="display:none;">
<table cellspacing="5" cellpadding="5" border="0">
				<tbody><tr>
					<td>Cost Range:</td>
					<td>
                    <input type="text" name="min" id="min" placeholder="Only Interger data"></td>
					<td>TO</td>
					<td><input type="text" name="max" id="max" placeholder="Only Interger data"></td>
				</tr>
					<td>Retail Price Range:</td>
					<td><input type="text" name="rmin" id="rmin" placeholder="Only Interger data"></td>
					<td>TO</td>
					<td><input type="text" name="rmax" id="rmax" placeholder="Only Interger data"></td>
				</tr>
				</tr>
					<td>MSRP Range:</td>
					<td><input type="text" name="mrmin" id="mrmin" placeholder="Only Interger data"></td>
					<td>TO</td>
					<td><input type="text" name="mrmax" id="mrmax" placeholder="Only Interger data"></td>
				</tr>
				</tr>
					<td>Margin Range:</td>
					<td><input type="text" name="mamin" id="mamin" placeholder="Only Interger data"></td>
					<td>TO</td>
					<td><input type="text" name="mamax" id="mamax" placeholder="Only Interger data"></td>
				</tr>
			</tbody></table>
</div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th><input type="checkbox" id="mainselect" onclick="return selecteverything()"></th>
								  <th>Source</th>
								  <th>Product Name</th>
								  <th>Product SKU</th>
								  <th>Product UPC</th>
								  <th>Brand</th>
								  <th>Assigned User</th>
								  <th>V.Product</th>
							    <th>Status</th>
								  <th>Cost</th>
								  <th>Re. Price</th>
								  <th>MSRP</th>
								  <th>Margin</th>
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
								<td><input class="productcheck" type="checkbox" name="select[]" value="<?php echo $value->mpt_id; ?>" /></td>
<td><?php echo $this->contentsearchm->get_vendor_name($value->product_source); ?></td>
								<td><?php echo $value->prduct_name; ?></td>
								<td class="center"><?php echo $value->product_sku; ?></td>
								<td class="center">
                                <?php echo $value->product_upc; ?>
                                </td>
								<td class="center">
									<?php echo $value->product_brand; ?>
								</td>
								<td class="center">
									<?php
if($value->user_assign != "0" AND $value->user_assign != NULL)
{
$assignuser = $this->contentsearchm->all_assigned_users($value->user_assign);
echo $assignuser->fname;
}
else
{
echo "Content not assigned";	
}
?>
								</td>
								<td class="center">
<a href="<?php echo BASE_URL; ?>/contentsearch/viewproduct/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">View</button></a>
								</td>
								<td class="center">
                                <span class="label label-success">
									<?php echo $this->log->content_status($value->status); ?>                                        </span>   
									</a>
								</td>
                          <td><?php echo $value->product_cost; ?></td>
                          <td><?php echo $value->product_retail; ?></td>
                          <td><?php echo $value->product_msrp; ?></td>
                          <td><?php echo ($value->product_retail-$value->product_cost); ?></td>
							</tr>
							
							  <?php
						  }
						  ?>
						  </tbody>
                          <tfoot>
<tr>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_platform">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Product Name" name="search_productname">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search SKU" name="search_sku">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search UPC" name="search_upc">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Brand" name="search_brand">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
  <th><input type="text" class="search_init" value="Search Cost" name="search_brand"></th>
  <th><input type="text" class="search_init" value="Search R.Price" name="search_brand"></th>
  <th><input type="text" class="search_init" value="Search MSRP" name="search_brand"></th>
  <th><input type="text" class="search_init" value="Search Margin" name="search_brand"></th>
</tr>
</tfoot>
<?php
						  }
						  ?>
					  </table>
                      <table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>

<td width="25%">
<!-- reject content start -->
<button class="btn btn btn-primary" onclick="return trashAllcontent('<?php echo BASE_URL; ?>')"><i class="icon-arrow-up icon-white"></i><span>Reject Content</span></button>
<script>
function trashAllcontent(url){
	
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src='+url+'/img/loader.gif>');
	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
	var userid = "20";
	if(userid == "")
	{
		alert("Select User");
		$("#notify").html('<h4 class="alert_warning">Please select user</h4>')
	}
	else
	{
		$("#notify").load(url+'/trashcontent/index/?vals='+allVals);
		return false;
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}
</script>
<!-- reject content ends -->
</td>
								  <td width="10%">&nbsp;</td>
								  <td width="10%">&nbsp;</td>
								  <td width="10%">
                                  <select id="user" style="width:100px;" name="user">
                                  <option value="">Select User</option>
                                  <?php
								  foreach($allusers as $uservalue)
								  {
								  ?>
                                        <option value="<?php echo $uservalue->user_id; ?>"><?php echo $uservalue->fname." ".$uservalue->lname; ?></option>
                                        <?php
								  }
								  ?>
            						  </select>
                                      <div id="notifyuser"></div>
                                  </td>
								  <td width="15%"><select id="priority" style="width:100px;" name="priority">
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Normal</option>
                                        <option value="4">High</option>
                                        <option value="5">Critical</option>
                                        <option value="6">Catalog</option>
            						  </select>
                                      <div id="notify"></div></td>
								  <td width="30%"><button class="btn btn btn-primary" onclick="return processAlls()"><i class="icon-arrow-up icon-white"></i><span>Process Content</span></button></td>
							  </tr>
						  </thead> 
                              </table> 
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		