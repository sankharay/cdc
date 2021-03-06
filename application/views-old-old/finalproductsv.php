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
						<h2><i class="icon-list-alt"></i> English Ready</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
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
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  if($content)
						  {
						  foreach($content as $value)
						  {
						  $condition = $this->finalproductsm->imgexist($value->fpl_id);
							  if($condition)
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
				<i class="icon32 icon-color "></i>
								</td>
							</tr>
							
							  <?php
							  }
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
</tr>
</tfoot>
					  </table>  
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		