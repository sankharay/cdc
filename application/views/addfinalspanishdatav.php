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
						<a href="#">Home</a> | Add new product
				  </li>
				</ul>
			</div>

			<div class="row-fluid sortable">
                
                
                <div id="productPage"></div>
                
                <!-- file upload starts -->
                <div id="productPage1">
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
                <div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Upload Final File</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                        <div class="sortable row-fluid ui-sortable">
				<form enctype="multipart/form-data" action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="">
  <tr>
    <td>Please Select File</td>
    <td><input type="file" name="userfile" id="file"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-primary" type="submit" name="Upload File" value="Upload File"></td>
  </tr>
</table>
</form><strong></strong>
			</div>
					</div>
				</div>
                </div>
                <!-- file upload ends -->
                <!-- user loaded Images start -->
                <div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i>Files Uploaded By <?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname'); ?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                        <div class="sortable row-fluid ui-sortable">
				
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>File Name</th>
								  <th>Date & Time</th>
								  <th>Status</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach($content as $value)
						  {
							  ?>
							  
							<tr>
								<td><?php echo $value->filename; ?></td>
								<td class="center"><?php echo $value->dateandtime; ?></td>
								<td class="center">
                                <?php echo $this->log->filestatus($value->status); ?>
                                </td>
								<td class="center">
<?php
if($value->status == 1)
{
	?>
<a href="<?php echo BASE_URL; ?>/addfinalspanishdata/processfinalfilebyuser/<?php echo $value->id; ?>">
<input type="button" class="btn btn-primary" value="Insert Spanish Content" />
</a>
<?php
}
else
{
echo "File Already Processed";
}
?>
								</td>
							</tr>
							
							  <?php
						  }
						  ?>
						  </tbody>
					  </table>
			</div>
					</div>
				</div>                
                <!-- user loaded images ends -->
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->