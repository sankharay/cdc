<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
	<!-- jQuery -->
	<script src="<?php echo BASE_URL; ?>/js/jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
	<script src="<?php echo BASE_URL; ?>/js/jquery-ui-1.8.21.custom.min.js"></script>	
    	
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
						<h2><i class="icon-list-alt"></i>Products Fetch From API's</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
<div style="clear:both;"></div>
<div id="searchdataresult">
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
	</tr>
</tfoot>


  
						  <tbody>
                          <?php
						  if($content)
						  {
						  foreach($content as $value)
						  {
							  ?>
							<tr>
								<td>
<input class="productchecking" type="checkbox" name="select[]" value="<?php echo $value->mpt_id; ?>" />
</td>
<td><?php $sourceda = $this->apicontentm->get_vendor_name($value->product_source);
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
								<td class="center"><a href="<?php echo BASE_URL; ?>/apicontent/viewproductothersqa/<?php echo $value->mpt_id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">View For QA</button></a>
								</td>
							</tr>
							
							  <?php
						  }
						  ?>
						  </tbody>
                         
<?php
						  }
						  ?>
					  </table>
                      <?php echo $links; ?>
                      </div>
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

	