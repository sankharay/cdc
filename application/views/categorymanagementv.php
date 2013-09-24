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
						<h2><i class="icon-list-alt"></i>Category Management</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
				  <div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>&nbsp;
<a href="<?php echo PLUGINS_WEB_URL."/categorytree/index.php" ?>" target="_blank"><button class="btn btn-mini btn-primary">Category Tree</button></a></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="47">Category Name</th>
								  <th width="67">Parent Id</th>
								  <th width="67">Magento Category Description</th>
								  <th width="55">Magento Category Image</th>
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
<td class="center"><?php echo $value->categorydes; ?> 

 </td>
<td class="center">
<!-- <img src="<?php echo PLUGINS_WEB_URL.'/cropping/categories/'.$value->image; ?>" height="50" width="50" />-->
<img src="<?php echo $value->image; ?>" height="50" width="50" />
</td>
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
                
				<?php
				if($this->session->userdata('updated'))
				{
					?>
                    <div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							
                            <strong><?php echo $this->session->userdata('updated');
							$this->session->unset_userdata('updated');
							?> </strong>
						</div>
                    <?php
				}
				?>
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
                  <form action="" method="post" enctype="multipart/form-data">
                    <table width="100%" class="table table-striped table-bordered ">
						   
						  <tbody>
							  <tr>
								  <td>Category Name</td>
								  <td colspan="2"><input type="text" name="catname" required="required" /></td>
							  </tr>
							  <tr>
								  <td>Category Title</td>
								  <td colspan="2"><input type="text" name="cattitle" id="cattitle" required="required" /></td>
							  </tr>
							  <tr>
    <td>Select Cat. Parent</td>
    <td colspan="2"><?php echo $this->categorymanagementm->listcatdropdown(); ?></td>
						    </tr>
							  <tr>
							    <td>Category Description</td>
							    <td colspan="2">
<textarea rows="10" cols="70" name="magengDesc"  id="magengDesc" required="required" class="span9"></textarea>
							</td>
						    </tr>
							  <tr>
							    <td colspan="2">
<label>Meta Keywords</label>
  <textarea rows="8" cols="70" name="metaKeywords"  id="metaKeywords" required="required" class="span10"></textarea>						        </td>
							    <td>
<label>Spanish Meta Keywords</label>
<textarea rows="8" cols="70" name="smetaKeywords"  id="smetaKeywords" required="required" class="span10"></textarea></td>
					        </tr>
							  <tr>
							    <td colspan="2">
<label>Meta Description</label>
						        <textarea rows="8" cols="70" name="metaDescription"  id="metaDescription" required="required" class="span10"></textarea>						        </td>
							    <td>
<label>Spanish Meta Description</label>
                                <textarea rows="8" cols="70" name="smetaDescription"  id="smetaDescription" required="required" class="span10"></textarea></td>
					        </tr>
							  <tr>
							    <td>Magento Category Image</td>
							    <td colspan="2">
<input type="file" name="userfile" size="20" pattern="jpg,gif,png only">
                                </td>
						    </tr>
							  <tr>
							    <td>Spanish Name</td>
							    <td colspan="2"><input type="text" name="magspanishname" required="required" /></td>
						    </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td colspan="2"><input class="btn" type="submit" name="submit" value="Add Category" /></td>
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
		