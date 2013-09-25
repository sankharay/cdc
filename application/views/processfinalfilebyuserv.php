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
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Process Your File</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table width="100%" border="0" cellpadding="5">
                          <tr>
                            <td>Select Vendor</td>
                            <td>
                            <select name="vendorid" id="vendorid" required="required">
                            <option value="0">Please Select Vendor</option>
                            <?php foreach($vendors as $value)
							{
								?>
								<option value="<?php echo $value->vmID; ?>"><?php echo ucfirst($value->vendorName); ?></option>
                                <?php
							}
							?>
                            </select>
                            </td>
                          </tr>
                          <tr>
                            <td>File Name</td>
                            <td><?php echo $filename->filename; ?></td>
                          </tr>
                          <tr>
                            <td>Enter  Attribute Field Numbers </td>
                            <td><input type="text" name="attributes" id="attributes" value="" />&nbsp;&nbsp;<a data-content="ADD fields seprated by Comma" data-rel="popover" class="label label-success" href="#" >?</a></td>
                          </tr>
                          <tr>
                            <td>Select User</td>
                            <td><select id="user" style="width:100px;" name="user">
                                  <option value="">Select User</option>
                                  <?php
								  foreach($allusers as $uservalue)
								  {
								  ?>
                                        <option value="<?php echo $uservalue->user_id; ?>"><?php echo $uservalue->fname." ".$uservalue->lname; ?></option>
                                        <?php
								  }
								  ?>
            						  </select></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" class="btn btn-primary" value="Process File" onclick="return processfinaldata('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);" /></td>
                          </tr>
                        </table>
                 </div>
				</div>
			</div><!--/row-->
<div id="resutingdata"></div>
<div id="waiting" class="waiting" ><img src="<?php echo BASE_URL; ?>/img/loader.gif" width="32" height="32" /></div>

			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		