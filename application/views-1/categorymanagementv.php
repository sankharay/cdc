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
						<h2><i class="icon-list-alt"></i>Category Management</h2>
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
								  <th width="47">Category Name</th>
								  <th width="67">Parent Id</th>
								  <th width="67">Mag. Eng. Category Id</th>
								  <th width="55">Mag. Sp. Category Id</th>
								  <th width="55">Spanish Name</th>
							    <th width="51">Action</th>
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
				<td><?php echo $value->name; ?></td>
<td>
<?php echo $this->categorymanagementm->gatcatname($value->parent_id); ?>
                                
                              </td>
<td class="center"><?php echo $value->magento_category_id; ?> 

 </td>
<td class="center"><?php echo $value->magento_cat_spenish_id; ?></td>
								<td class="center">
  <?php echo $value->spanish_name; ?>
							    </td>
								<td class="center">
<?php if($this->categorymanagementm->findsubcatexist($value->id))
{
	?>
<button onclick="return alert('Please delete first sub Categories');" class="btn btn-mini btn-primary">Delete</button>	
    <?php
}
else
{
 ?>
<a href="<?php echo BASE_URL; ?>/categorymanagement/catdel/<?php echo $value->id; ?>">
<button class="btn btn-mini btn-primary">Delete</button></a>	
 <?php
}
?>
<a href="<?php echo BASE_URL; ?>/categorymanagement/catedit/<?php echo $value->id; ?>">
 <button class="btn btn-mini btn-primary">Edit</button></a>					
								</td>
							</tr>
							
							  <?php
						  }
						  }
						  ?>
						  </tbody>
                          <tfoot>
<tr>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Category Name" name="search_platform">
	  </th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Parent Cat. Name" name="search_images">
	</th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Mag. Eng. id" name="search_sku">
	</th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Mag. Sp. id" name="search_upc">
	  </th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Sp. Name" name="search_sorting">
	  </th>
	<th rowspan="1" colspan="1">
	  <input type="hidden" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	  </th>
</tr>
</tfoot>
					  </table>
					</div>
				</div>
                
                <div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Add New Category</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
				  <div class="box-content">
                  <form action="" method="post">
                    <table width="100%" class="table table-striped table-bordered ">
						   
						  <tbody>
							  <tr>
								  <td>Category Name</td>
								  <td><input type="text" name="catname" required="required" /></td>
							  </tr>
							  <tr>
    <td>Select Cat. Parent</td>
    <td><?php echo $this->categorymanagementm->listcatdropdown(); ?></td>
						    </tr>
							  <tr>
							    <td>Mag. Eng. Category Id</td>
							    <td><input type="text" name="magengid" required="required" /></td>
						    </tr>
							  <tr>
							    <td>Mag. Sp. Category Id</td>
							    <td><input type="text" name="magspaid" required="required" /></td>
						    </tr>
							  <tr>
							    <td>Spanish Name</td>
							    <td><input type="text" name="magspanishname" required="required" /></td>
						    </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td><input class="btn" type="submit" name="submit" value="Add Category" /></td>
						    </tr>
                              </tbody>
                              </table>
                              </form>
				</div>
                
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
<script type="text/javascript">
<!--
function myPopup2(url) {
window.open( url, "myWindow", "status = 1, height = 700, width = 800, resizable = 0" )
}
//-->
</script>
		