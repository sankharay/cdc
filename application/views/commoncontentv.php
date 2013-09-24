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
                    <div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							
							<p><?php echo $this->session->userdata('update');$this->session->unset_userdata('update'); ?></p>
						</div>
                    <?php
				}
				?>
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Manage Common Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>
&nbsp;&nbsp;<a href="<?php echo BASE_URL; ?>/attributemanagement/addnewcommoncontent/" class="cboxElement"><button class="btn btn-mini btn-primary">Add New Content</button></a>
                    </div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
     
						  <thead>
							  <tr>
								  <th width="47">Category Name</th>
								  <th width="67">Meta Keywords</th>
								  <th width="55">Meta Description</th>
								  <th width="66">Action</th>
							    <th width="51">Status</th>
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
							  <td><?php echo $this->attributemanagementm->get_category_name($value->categoryid); ?></td>
								<td><?php echo $value->metakeywords; ?>
<br><br><label><b>Spanish Keywords:</b></label><br><?php echo $value->spanish_metakeywords; ?>
</td>
<td class="center">
<?php 
echo $value->metadescription;

?>
<br><br><label><b>Spanish Description:</b></label><br><?php echo $value->spanish_metadescription; ?>
</td>
								<td class="center">
<a href="<?php echo BASE_URL; ?>/attributemanagement/editcommoncontent/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Edit</button></a>
&nbsp;&nbsp;
<!--<a href="<?php echo BASE_URL; ?>/attributemanagement/deletecommoncontent/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Delete</button></a>-->
							    </td>
								<td class="center">
                                <span class="label label-success">
									<?php echo $this->attributemanagementm->attribute_status($value->status); ?>                                        </span>   
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
	  <input type="text" class="search_init" value="Search Cat." name="search_platform">
	  </th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Keywords" name="search_productname">
	</th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Description" name="search_sku">
	  </th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	  </th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
</tr>
</tfoot>
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

		