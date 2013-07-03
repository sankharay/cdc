<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
			</div>

			<div class="row-fluid sortable">
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
						<h2><i class="icon-list-alt"></i> Delete Vendors</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <form action="<?php echo BASE_URL; ?>/managevendor/delvendors/<?php echo $this->uri->segment(3); ?>" method="post">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<input type="hidden" name="delvee" value="<?php echo $content->vendorName; ?>"  />	   
						  <tbody>
							  <tr>
								  <td>Vendor Name</th>
								  <td><input type="text" name="vname" value="<?php echo $content->vendorName; ?>" disabled="disabled"  /></th>
							  </tr> 
								  <td>Vendor ID</th>
								  <td><input type="text" name="vid" value="<?php echo $content->vendorID; ?>" disabled="disabled" /></th>
							  </tr> 
							  <tr>
								  <td>Vendor Host IP Address</td>
								  <td><input type="text" name="vhostid" value="<?php echo $content->hostip; ?>" disabled="disabled"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Username</td>
								  <td><input type="text" name="vusername" value="<?php echo $content->username; ?>" disabled="disabled"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Email</td>
								  <td><input type="text" name="vemail" value="<?php echo $content->vendoremail; ?>" disabled="disabled"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Details</td>
								  <td><input type="text" name="vdetails" value="<?php echo $content->vendorextradetails; ?>" disabled="disabled"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Status</td>
								  <td><input type="text" name="vstatus" value="<?php echo $content->status; ?>" disabled="disabled"  /></td>
							  </tr>
							  <tr>
								  <td>&nbsp;</td>
								  <td><input class="btn btn-large btn-success" type="submit" name="submit" value="Delete" />
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

		