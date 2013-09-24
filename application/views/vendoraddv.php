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
						<h2><i class="icon-list-alt"></i> Add Vendors</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <form action="<?php echo BASE_URL; ?>/managevendor/addvendor/" method="post">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						   
						  <tbody>
							  <tr>
								  <td>Vendor Name</th>
								  <td><input type="text" name="vname" required="required" placeholder="Add Vendor Name" value="<?php if($this->input->post('vname') != "") { echo $this->input->post('vname'); } ?>"  /></th>
							  </tr>
							  <tr>
								  <td>Vendor Host IP Address</td>
								  <td>
                                    <input type="text" name="vhostip" required="required" placeholder="Add Vendor Host Ip Address" value="<?php if($this->input->post('vhostip') != "") { echo $this->input->post('vhostip'); } ?>" />
                                  </td>
							  </tr>
							  <tr>
								  <td>Vendor FTP Username</td>
								  <td><input type="text" name="vusername" required="required" placeholder="Add Vendor FTP username" value="<?php if($this->input->post('vusername') != "") { echo $this->input->post('vusername'); } ?>"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor  FTP Password</td>
								  <td><input type="text" name="vpassword" required="required" placeholder="Add Vendor FTP Password" value="<?php if($this->input->post('vpassword') != "") { echo $this->input->post('vpassword'); } ?>"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Email</td>
								  <td><input type="email" name="vemail" required="required" placeholder="Add Vendor Email Address" value="<?php if($this->input->post('vemail') != "") { echo $this->input->post('vemail'); } ?>"  /></td>
							  </tr>
							  <tr>
								  <td>Vendor Details</td>
								  <td><input type="text" name="vdetails" placeholder="Add Vendor details" value="<?php if($this->input->post('vdetails') != "") { echo $this->input->post('vdetails'); } ?>"    /></td>
							  </tr>
							  <tr>
								  <td>Vendor Status</td>
								  <td>
                                <select name="vstatus" required>
                                <option value="">Please Select Vendor Status</option>
                                <option value="1"  <?php if($this->input->post('vdetails') == 1) { echo "selected='selected'"; } ?>  >Active</option>
                                <option value="2" <?php if($this->input->post('vdetails') == 2) { echo "selected='selected'"; } ?> >Not Active</option>
                                </select>
                                  </td>
							  </tr>
							  <tr>
								  <td>&nbsp;</td>
								  <td><input class="btn btn-large btn-success" type="submit" name="submit" value="Add New Vendor" />
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
				
		

		