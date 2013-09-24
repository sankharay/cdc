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
						<a href="#">Home</a> 
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Add New User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Username</th>
								  <th>Full Name</th>
								  <th>Role</th>
								  <th>Email</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach($content as $value)
						  {
							  ?>
							  
							<tr>
								<td><?php echo $value->username; ?></td>
								<td class="center"><?php echo $value->fname; ?> <?php echo $value->lname; ?></td>
								<td class="center">
                                <?php echo $alevel = $this->usermanagement->access_level($value->access_level); ?>
                                </td>
								<td class="center">
									<?php echo $value->email; ?>
								</td>
								<td class="center">
									<a class="btn btn-success cboxElement" href="<?php echo BASE_URL; ?>/adduser/userdetail/<?php echo $value->user_id; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>


									<a class="btn btn-info cboxElement" href="<?php echo BASE_URL; ?>/adduser/edituserdetail/<?php echo $value->user_id; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger cboxElement" href="<?php echo BASE_URL; ?>/adduser/deluserdetail/<?php echo $value->user_id; ?>">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>

								</td>
							</tr>
							
							  <?php
						  }
						  ?>
						  </tbody>
                          <tfoot>
<tr>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Username" name="search_sorting">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Name" name="search_platform">
	</th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search Roles" name="search_productname">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Email" name="search_sku">
	</th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search UPC" name="search_upc">
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

		