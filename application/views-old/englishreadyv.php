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
									<?php echo $value->product_source; ?>                                           
									</a>
								</td>
								<td class="center">
                                <a href="<?php echo BASE_URL; ?>/contentsearch/reviewspanish/<?php echo trim($value->product_sku); ?>/<?php echo $value->product_source; ?>" class="btn btn-success">
										<i class="icon icon-white icon-check"></i>                                            
									</a>                                             
									</a>
                                <a href="#" class="btn btn-danger">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
							
							  <?php
						  }
						  }
						  ?>
						  </tbody>
					  </table>  
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		