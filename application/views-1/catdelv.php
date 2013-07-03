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
                  <form action="" method="post">
                    <table width="100%" class="table table-striped table-bordered ">
						   
						  <tbody>
							  <tr>
								  <td>Category Name</td>
								  <td><input type="text" readonly="readonly" name="catname" required="required" value="<?php echo $content->name; ?>" /></td>
							  </tr>
							  <tr>
    <td>Select Cat. Parent</td>
    <td><?php echo $this->categorymanagementm->listselectedcatdropdown($content->parent_id); ?></td>
						    </tr>
							  <tr>
							    <td>Mag. Eng. Category Id</td>
							    <td><input readonly="readonly" type="text" name="magengid" required="required" value="<?php echo $content->magento_category_id; ?>" /></td>
						    </tr>
							  <tr>
							    <td>Mag. Sp. Category Id</td>
							    <td><input readonly="readonly" type="text" name="magspaid" required="required" value="<?php echo $content->magento_cat_spenish_id; ?>" /></td>
						    </tr>
							  <tr>
							    <td>Spanish Name</td>
							    <td><input readonly="readonly" type="text" name="magspanishname" required="required" value="<?php echo $content->spanish_name; ?>" /></td>
						    </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td><input class="btn" type="submit" name="submit" value="Confirm Delete Category" /></td>
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
		