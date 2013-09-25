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
						<h2><i class="icon-list-alt"></i> Edit Category</h2>
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
								  <td colspan="2"><input type="text" name="catname" required="required" value="<?php echo $content->name; ?>" /></td>
							  </tr>
							  <tr>
								  <td>Category Title</td>
								  <td colspan="2"><input type="text" name="cattitle" id="cattitle" required="required" value="<?php echo $content->cattitle; ?>" /></td>
							  </tr>
							  <tr>
    <td>Select Cat. Parent</td>
    <td colspan="2"><?php 
	echo $this->categorymanagementm->listcatdropdownselected($content->parent_id);
	?></td>
						    </tr>
							  <tr>
							    <td>Category Description</td>
							    <td colspan="2">
<textarea rows="10" cols="70" name="magengDesc"  id="magengDesc" required="required" class="span9"><?php echo $content->categorydes; ?></textarea>
							</td>
						    </tr>
							  <tr>
							    <td colspan="2">
<label>Meta Keywords</label>
  <textarea rows="8" cols="70" name="metaKeywords"  id="metaKeywords" required="required" class="span10"><?php echo $content->metakeywords; ?></textarea>						        </td>
							    <td>
<label>Spanish Meta Keywords</label>
<textarea rows="8" cols="70" name="smetaKeywords"  id="smetaKeywords" required="required" class="span10"><?php echo $content->	spanish_metakeywords; ?></textarea></td>
					        </tr>
							  <tr>
							    <td colspan="2">
<label>Meta Description</label>
						        <textarea rows="8" cols="70" name="metaDescription"  id="metaDescription" required="required" class="span10"><?php echo $content->metadescrption; ?></textarea>						        </td>
							    <td>
<label>Spanish Meta Description</label>
                                <textarea rows="8" cols="70" name="smetaDescription"  id="smetaDescription" required="required" class="span10"><?php echo $content->spanish_metadescription; ?></textarea></td>
					        </tr>
							  <tr>
							    <td>Magento Category Image</td>
							    <td colspan="2">
<input type="file" name="userfile" size="20" pattern="jpg,gif,png only">
                                </td>
						    </tr>
							  <tr>
							    <td>Spanish Name</td>
							    <td colspan="2"><input type="text" name="magspanishname" required="required" value="<?php echo $content->spanish_name; ?>" /></td>
						    </tr>
							  <tr>
							    <td>Status</td>
							    <td colspan="2">
<select name="catstatus">
<option value="">Please Select Status</option>
<option value="1" <?php if($content->status == 1 ) echo "selected='selected'"; ?>>Active</option>
<option value="0" <?php if($content->status == 0 ) echo "selected='selected'"; ?>>De-Active</option>
</select>
                                </td>
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
		