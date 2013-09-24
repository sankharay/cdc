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
						<h2><i class="icon-list-alt"></i> Rejected Content Only</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
<!-- Only Rejected Content start -->

					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="20"><input type="checkbox" onclick="return selecteverything()" id="mainselectrej" /></th>
								  <th width="47">Source</th>
								  <th width="67">Product Name</th>
								  <th width="55">Product SKU</th>
								  <th width="55">Product UPC</th>
								  <th width="41">Brand</th>
								  <th width="66">V.Product</th>
							    <th width="51">Status</th>
							  </tr>
						  </thead>
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
</tr>
</tfoot>


  
						  <tbody>
                          <?php
						  if($contents)
						  {
						  foreach($contents as $value)
						  {
							if($this->addcontentm->countreject($value->mpt_id) == TRUE)
								{
							  ?>
							<tr>
								<td><input class="productcheck" type="checkbox" name="select[]" value="<?php echo $value->mpt_id; ?>" /></td>
<td><?php $sourceda = $this->addcontentm->get_vendor_name($value->product_source);
echo $sourceda;
 ?></td>
								<td><?php echo $this->addcontentm->countreject($value->mpt_id); ?>-<?php echo $value->prduct_name; ?></td>
								<td class="center"><?php echo $value->product_sku; ?></td>
								<td class="center">
                                <?php echo $value->product_upc; ?>
                                </td>
								<td class="center">
									<?php echo $value->product_brand; ?>
								</td>
								<td class="center">
<a href="<?php echo BASE_URL; ?>/addcontent/viewproductothers/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Raw View</button></a>&nbsp;<a href="<?php echo BASE_URL; ?>/addcontent/viewproductothersqa/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">View For QA</button></a>&nbsp;<a href="<?php echo BASE_URL; ?>/addcontent/qafailed/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">QA Failed Case</button></a>
								</td>
								<td class="center">
                                <span class="label label-success">
									<?php 
if($value->status != '13')
echo $this->log->content_status($value->status)." - Corrected";
else
echo $this->log->content_status($value->status);
?>
                                        </span><br> 
<span class="label label-warning" data-rel="tooltip" href="#" data-original-title="<?php echo $resultvalue = $this->addcontentm->rejectreason($value->mpt_id); ?>">Reason</span>	
								</td>
							</tr>
							
							  <?php
							}
						  }
						  ?>
						  </tbody>
                         
<?php
						  }
						  ?>
					  </table>
					</div>
				</div>
<!-- Only Rejected Content ends -->
<div class="box">
<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Content For Review</h2>
						<div class="box-icon">
							<a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="20"><input type="checkbox" onclick="return selecteverything()" id="mainselect" /></th>
								  <th width="47">Source</th>
								  <th width="67">Product Name</th>
								  <th width="55">Product SKU</th>
								  <th width="55">Product UPC</th>
								  <th width="41">Brand</th>
								  <th width="66">V.Product</th>
							    <th width="51">Status</th>
							  </tr>
						  </thead>
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
</tr>
</tfoot>


  
						  <tbody>
                          <?php
						  if($content)
						  {
						  foreach($content as $value)
						  {
							if($this->addcontentm->countreject($value->mpt_id) == FALSE)
								{
							  ?>
							  
							<tr>
								<td><input class="productcheck" type="checkbox" name="select[]" value="<?php echo $value->mpt_id; ?>" /></td>
<td><?php $sourceda = $this->addcontentm->get_vendor_name($value->product_source);
echo $sourceda;
 ?></td>
								<td><?php echo $value->prduct_name; ?></td>
								<td class="center"><?php echo $value->product_sku; ?></td>
								<td class="center">
                                <?php echo $value->product_upc; ?>
                                </td>
								<td class="center">
									<?php echo $value->product_brand; ?>
								</td>
								<td class="center">
<a href="<?php echo BASE_URL; ?>/addcontent/viewproductothers/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Raw View</button></a>&nbsp;<a href="<?php echo BASE_URL; ?>/addcontent/viewproductothersqa/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">View For QA</button></a>&nbsp;<a href="<?php echo BASE_URL; ?>/addcontent/qafailed/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">QA Failed Case</button></a>
								</td>
								<td class="center">
                                <span class="label label-success">
									<?php echo $this->log->content_status($value->status); ?>                                        </span>   
									</a>
<?php
echo $datavval = $this->addcontentm->get_magentoid($value->product_sku);
//echo $datavval->magento_category_id;
?>
								</td>
							</tr>
							
							  <?php
							}
						  }
						  ?>
						  </tbody>
                         
<?php
						  }
						  ?>
					  </table>
                      <table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <td width="25%">
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
                                  </td>
								  <td width="15%"><select id="priority" style="width:100px;" name="priority">
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Normal</option>
                                        <option value="4">High</option>
                                        <option value="5">Critical</option>
            						  </select>
                                      <div id="notify"></div></td>
								  <td width="30%"><button class="btn btn btn-primary" onclick="return processAllcontent('<?php echo BASE_URL; ?>')"><i class="icon-arrow-up icon-white"></i><span>Process Content</span></button></td>
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

		