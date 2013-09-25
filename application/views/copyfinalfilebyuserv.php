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
                    <form action="<?php echo BASE_URL; ?>/copyimages/getimages/" method="get">
						<table width="100%" border="0" cellpadding="5">
                          <tr>
                            <td width="35%">Select Vendor</td>
                            <td width="31%">
                            <input type="hidden" value="<?php echo $this->uri->segment(3); ?>" name="fileid" />
                            <select name="vendorid" id="vendorid" required="required">
                            <option value="">Please Select Vendor</option>
                            <?php foreach($vendors as $value)
							{
								?>
								<option value="<?php echo $value->vmID; ?>"><?php echo ucfirst($value->vendorName); ?></option>
                                <?php
							}
							?>
                            </select>
                            </td>
                            <td width="34%" rowspan="3" valign="top"><strong>Details :</strong><br />
                              <strong>File Type :</strong> .xls<br />
                              <strong>No of column :</strong> one ( sku )</td>
                          </tr>
                          <tr>
                            <td>File Name</td>
                            <td><?php echo $filename->filename; ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" class="btn btn-primary" value="Get Images" /></td>
                          </tr>
                        </table>
                        </form>
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
		