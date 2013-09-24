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
				<?php
				if($this->session->userdata('update'))
				{
					?>
                    <div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							
                            <strong><?php echo $this->session->userdata('update'); 	
							$this->session->unset_userdata('update');	?> </strong>
						</div>
                    <?php
				}
				?>
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Search Vendors</h2>
						<div class="box-icon">
							
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Vendor Name</th>
								  <th>Vendor IP Address</th>
								  <th>Vendor Username</th>
								  <th>Vendor ID</th>
								  <th>Vendor Email</th>
								  <th>Status</th>
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
								<td><?php echo $value->vendorName; ?></td>
								<td class="center">
									<?php echo $value->hostip; ?>
								</td>
								<td class="center"><?php echo $value->username; ?></td>
								<td class="center">
                                <?php echo $value->vendorID; ?>
                                </td>
								<td class="center">
									<?php echo $value->vendoremail; ?>
								</td>
								<td class="center">
                                
									<?php echo $this->managevendorm->vendorstatus($value->status); ?>                                          
									</a>
								</td>
								<td class="center">
                                
									
									
									<a class="btn btn-info" href="<?php echo BASE_URL; ?>/managevendor/editvendors/<?php echo $value->vmID; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger cboxElement" href="<?php echo BASE_URL; ?>/managevendor/delvendors/<?php echo $value->vmID; ?>">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>                                        
									</a>
								</td>
							</tr>
							
							  <?php
						  }
						  }
						  ?>
							  <tr>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								  <td>
                                  </td>
								  <td></td>
								  <td></td>
							  </tr>
						  </tbody><tfoot>
<tr><th colspan="1" rowspan="1">
	  <input type="text" name="search_platform" value="Vendor Name" class="search_init">
	  </th><th colspan="1" rowspan="1">
		<input type="text" name="search_images" value="Search Vendor Host" class="search_init">
	</th><th colspan="1" rowspan="1">
		<input type="text" name="search_sku" value="Search Vendor Username" class="search_init">
	</th><th colspan="1" rowspan="1">
	  <input type="text" name="search_upc" value="Search Vendor ID" class="search_init">
	  </th><th colspan="1" rowspan="1">
	  <input type="text" name="search_sorting" value="Search Vendor Email Address" class="search_init">
	  </th><th colspan="1" rowspan="1">
	  <input type="hidden" style="display:none;" name="search_sorting" value="Search Source" class="search_init">
	  </th><th colspan="1" rowspan="1">
	  <input type="hidden" style="display:none;" name="search_sorting" value="Search Source" class="search_init">
	  </th></tr>
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

		