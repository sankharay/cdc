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
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?php echo $this->session->userdata('update');
							$this->session->unset_userdata('update'); ?>
						</div>
                        <?php
				}
				?>
                
				<?php
				if($this->session->userdata('dup'))
				{
					?>
                    <div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							
                            <strong><?php echo $this->session->userdata('dup'); 
							$this->session->unset_userdata('dup');
							?> </strong>
						</div>
                    <?php
				}
				?>
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i>Upload Vendor Files</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <form action="<?php echo BASE_URL; ?>/manageupdatevendor/vdbtemplate/" method="post" enctype="multipart/form-data">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						   
						  <tbody>
							  <tr>
								  <td>Select Vendor
								  <td>
<?php
$select = "<select name='vname' required>";
$select.= "<option value=''>Please select Vendor</option>";
foreach($dropdown as $value)
{
$select.= "<option value=".$value->vmID.">".$value->vendorName."</option>";
}
$select.="</select>";
echo $select;
?>
                                  </th>
							  </tr> 
								      
							  <tr>
								  <td>
Vendor File URL
                                  </td>
								  <td>
<input type="file" name="userfile" />                          
                                  </td>
							  </tr>
							  <tr>
								  <td>&nbsp;</td>
								  <td><input class="btn btn-large btn-success" type="submit" name="submit" value="Upload" />
                                  </td>
							  </tr>
							  <tr>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
							  </tr>
						  </tbody>
					  </table> 
                      </form>
					</div>
				</div>
			</div><!--/row-->
			<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i>Vendor Update Files</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    
						<table width="1000px" class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Vendor File</th>
								  <th>Status</th>
								  <th>Update</th>
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
								<td class="center">
  <a href="<?php echo BASE_URL; ?>/uploadedfiles/vendorfiles/<?php echo $value->filename; ?>" target="_blank"><?php echo $value->filename; ?></a>
							    </td>
								<td class="center">
									<?php echo $this->manageupdatevendorm->templatestatus($value->status); ?>
								</td>
                                <td>
                                <?php
								if($value->status == 1)
								{
								?>
<!-- <input type="button"  value="Process File" class="btn btn-small btn-primary" onClick="return myPopup22('<?php echo $value->filename; ?>','<?php echo $value->vendor_id; ?>')" /> -->
<a href="<?php echo BASE_URL; ?>/manageupdatevendor/processupdatefile/<?php echo $value->id; ?>"><input type="button"  value="Process File" class="btn btn-small btn-primary" /></a>
                                <?php	
								}
								else
								{
								?>
File already processed
                                <?php
								}
								?>
                                </td>
							</tr>
							
							  <?php
						  }
						  }
						  ?>
						  </tbody>
					  </table> 
                      <script type="text/javascript">
<!--
function myPopup22(file,vendorid) {
window.open( "<?php echo BASE_URL; ?>/vendorupdateprocessor/?file="+file+"&vendorid="+vendorid, "myWindow", 
"status = 1, height = 600, width = 800,resizable=yes,scrollbars=yes" )
}
//-->
</script>
					</div>
			  </div>
			</div>
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		

		