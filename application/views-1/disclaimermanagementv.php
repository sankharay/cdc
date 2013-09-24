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
						<a href="<?php echo BASE_URL; ?>">Home</a> > Brand Management
                        
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
						<h2><i class="icon-list-alt"></i> Disclaimer Management</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>&nbsp;&nbsp;<a class="cboxElement" href="<?php echo BASE_URL; ?>/disclaimermanagement/disclaimeradd/"><button class="btn btn-mini btn-primary">Add New Disclaimer</button></a></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="47">Dis. Name</th>
								  <th width="67">Dis. English</th>
								  <th width="67">Dis. Spanish</th>
								  <th width="55">Status</th>
							    <th width="51">Action</th>
							  </tr>
						  </thead>
                           <tfoot>
<tr>
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
							  <td><?php echo $value->name;
 ?></td><td><?php echo substr($value->english,0,100);
 ?></td>
								<td><?php echo substr($value->spanish,0,100); ?></td>
								<td class="center"><span class="label label-success"><?php echo $this->log->active_status($value->status); ?></span></td>
								<td class="center">
                                
<a href="<?php echo BASE_URL; ?>/disclaimermanagement/disview/<?php echo $value->id; ?>" class="btn btn-mini btn-primary cboxElement">View</a>

<a href="<?php echo BASE_URL; ?>/disclaimermanagement/disedit/<?php echo $value->id; ?>" class="btn btn-mini btn-primary cboxElement">Edit</a>
<a href="<?php echo BASE_URL; ?>/disclaimermanagement/disdelete/<?php echo $value->id; ?>" class="btn btn-mini btn-primary cboxElement">Delete</a>
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
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		