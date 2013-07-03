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
						<h2><i class="icon-list-alt"></i> Manage Content Feedback</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>&nbsp;&nbsp;<button class="btn btn-mini btn-primary" id="asearch">Add New Error</button></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="17">&nbsp;</th>
								  <th colspan="2">Reject Reason</th>
							  </tr>
						  </thead>
                           <tfoot>
<tr>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
	<th rowspan="1">
	  <input type="text" class="search_init" value="Search Source" name="search_platform">
	  </th>
	<th rowspan="1" colspan="-3">
	  </th>
</tr>
</tfoot>


  
						  <tbody>
                          <?php
						  if($content)
						  {
						$i=1;
						  foreach($content as $value)
						  {
							  ?>
							  
							<tr>
								<td><?php echo $i; ?></td>
<td><?php echo $value->header; ?></td>
								<td width="150" colspan="-3" class="center">
  <a href="<?php echo BASE_URL; ?>/rejecteddata/editdata/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Edit</button></a>&nbsp;&nbsp;
  <a href="<?php echo BASE_URL; ?>/rejecteddata/viewdata/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">View</button></a>&nbsp;&nbsp;
  <a href="<?php echo BASE_URL; ?>/rejecteddata/deletedata/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Delete</button></a>
							    </td>
							</tr>
							
							  <?php
							  $i = $i+1;
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

		