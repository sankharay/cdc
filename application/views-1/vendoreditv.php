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
						<h2><i class="icon-list-alt"></i> Edit Vendors</h2>
						<div class="box-icon">
							
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <form action="<?php echo BASE_URL; ?>/managevendor/editvendors/<?php echo $this->uri->segment(3); ?>" method="post">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						   
						  <tbody>
							  <tr>
								  <td>Vendor Name</th>
								  <td><input type="text" name="vname" value="<?php echo $content->vendorName; ?>"  required="required" /></th>
							  </tr> 
								  <td>Vendor ID</th>
								  <td><input type="text" name="vid" value="<?php echo $content->vendorID; ?>" disabled="disabled"  required="required" /></th>
							  </tr> 
							  <tr>
								  <td>Vendor Host IP Address</td>
								  <td><input type="text" name="vhostip" value="<?php echo $content->hostip; ?>"  required="required"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Username</td>
								  <td><input type="text" name="vusername" value="<?php echo $content->username; ?>"  required="required"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Pasword</td>
								  <td><input type="text" name="vpassword" value="<?php echo $content->password; ?>"  required="required"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Email</td>
								  <td><input type="email" name="vemail" value="<?php echo $content->vendoremail; ?>"  required="required"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Details</td>
								  <td><input type="text" name="vdetails" value="<?php echo $content->vendorextradetails; ?>"  required="required"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Status</td>
								  <td>
<select name="vstatus"  required="required">
<option value="1" <?php if($content->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($content->status == 2) { ?> selected="selected" <?php } ?>>De-Active</option>
</select>
                                  </td>
							  </tr>
							  <tr>
								  <td>&nbsp;</td>
								  <td><input class="btn btn-large btn-success" type="submit" name="submit" value="Update" />
                                  </td>
							  </tr>
						  </tbody>
					  </table> 
                      </form>
					</div>
				</div>
			</div><!--/row-->
						<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		