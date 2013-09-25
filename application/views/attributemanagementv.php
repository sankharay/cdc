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
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>&nbsp;&nbsp;<a href="<?php echo BASE_URL; ?>/attributemanagement/addnewattributes/" class="cboxElement"><button class="btn btn-mini btn-primary">Add New Attribute</button></a>&nbsp;&nbsp;<a href="<?php echo BASE_URL; ?>/attributemanagement/addnewattributestypes/" class="cboxElement"><button class="btn btn-mini btn-primary">Add New Attribute Types</button></a></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
     
						  <thead>
							  <tr>
								  <th width="47">Category Name</th>
								  <th width="67">Attribute Name</th>
								  <th width="55">Attribute Selection</th>
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
							  <td><?php echo $this->attributemanagementm->get_category_name($value->categoryid);
echo "-".$value->categoryid;
 ?>&nbsp;
  <a href="<?php echo BASE_URL; ?>/attributemanagement/editcategory/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Edit Category</button></a></td>
								<td><?php echo $value->attributename; ?></td>
<td class="center">
<?php 
$attributes = $this->attributemanagementm->get_sub_attribute_names($value->id);
if($attributes)
{
foreach($attributes as $value)
echo "<strong>".$value->name."</strong>"."<br>";
?><a href="<?php echo BASE_URL; ?>/attributemanagement/editsubtree/<?php echo $value->attributeid; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Edit Attributes</button></a>
<?php
}
?>
</td>
								<td class="center">
  <a href="<?php echo BASE_URL; ?>/attributemanagement/tree/<?php echo $value->id; ?>" class="cboxElement"><button class="btn btn-mini btn-primary">View Tree</button></a>
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
		<input type="text" class="search_init" value="Search Attribute" name="search_productname">
	</th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Selection" name="search_sku">
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

		