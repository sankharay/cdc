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
						<a href="#">Home</a> 
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<?php
				if($this->session->userdata('updated'))
				{
				?>
                <div class="alert">
							<?php echo $this->session->userdata('updated'); 
							$this->session->unset_userdata('updated'); 
							?>
						</div>
                <?php
				}
				?>
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Add New User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form action="<?php echo BASE_URL; ?>/adduser" method="post" onsubmit="return chkform()">
                	<table class="table table-striped table-bordered bootstrap-datatable datatable">
						   
						  <tbody>
							  <tr>
								  <td>First Name
							      <td><input type="text" name="fName" id="fName" required="required"></th>
						    </tr> 
								    <td>Last Name
							        <td></th>
							          <input type="text" name="lName" id="lName" required>
							        </tr> 
							  <tr>
								  <td>Email</td>
								  <td><input type="email" name="email" id="email" required></td>
							  </tr>
							  <tr>
								  <td>User Name</td>
								  <td><input type="text" name="uName" id="uName" required onchange="return chkuser()"></td>
							  </tr>
							  <tr>
								  <td>Password</td>
								  <td><input type="password" name="pass" id="pass" required></td>
							  </tr>
							  <tr>
								  <td>Access Level</td>
								  <td><select name="aLevel" required>
                            <option value="">Please select Access Level</option>
                            <?php if($this->session->userdata('accesslevel') == 1)
							{
							?>
                            <option value="1">Adminstrator</option>
                            <?php
							}
							?>
                            <option value="2">Manager</option>
                            <option value="3">User</option>
                            <option value="4">Other Company</option>
                            </select></td>
							  </tr>
							  <tr>
								  <td>&nbsp;</td>
								  <td><input type="submit" value="Submit" class="btn btn-primary">
                            <input type="submit" value="Reset" class="btn btn-small btn-warning">
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

		