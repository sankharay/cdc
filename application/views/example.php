<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
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
						<h2><i class="icon-list-alt"></i> Add New User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
		<?php echo $output; ?>
        
    </div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable">
<table class="table table-striped table-bordered bootstrap-datatable">
					    <thead>
							  <tr>
								  <td width="25%"><button class="btn btn btn-primary" onclick="return processthridapicontent('<?php echo BASE_URL; ?>')"><i class="icon-arrow-up icon-white"></i><span>Send Data to India</span></button></td>
								  <td width="10%">&nbsp;</td>
								  <td width="10%">&nbsp;</td>
								  <td width="10%">
<?php
$allusers = $this->addcontentm->all_users();
		?>
                                  <select id="user" style="width:100px;" name="user">
                                  <option value="">Select User</option>
                                  <?php
								  foreach($allusers as $uservalue)
								  {
								  ?>
                                        <option value="<?php echo $uservalue->user_id; ?>"><?php echo $uservalue->fname." ".$uservalue->lname; ?></option>
                                        <?php
								  }
								  ?>
           						    </select>
                                  </td>
								  <td width="15%"><select id="priority" style="width:100px;" name="priority">
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Normal</option>
                                        <option value="4">High</option>
                                        <option value="5">Critical</option>
            						  </select>
                                      <div id="notify"></div></td>
								  <td width="30%"><button class="btn btn btn-primary" onclick="return processAllapicontent('<?php echo BASE_URL; ?>')"><i class="icon-arrow-up icon-white"></i><span>Process Content</span></button></td>
							  </tr>
					  </thead> 
                      </table> 
            </div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
<script>


function processthridapicontent(url){
	
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src='+url+'/img/loader.gif>');
	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
	var userid = "24";
	if(allVals == "")
	{
		alert("Select User");
		$("#notify").html('<h4 class="alert_warning">Please select user</h4>')
	}
	else
	{
		$("#notify").load(url+'/apiassigndata/processassignthird?vals='+allVals+'&priority='+$("#priority").val()+'&userid='+userid);
		return false;
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}



function processAllapicontent(url){
	
	$("#ajaxcontentbg").hide('slow')
	$("#prioritydiv").hide('slow')
	$("#notify").html('<img src='+url+'/img/loader.gif>');
	if($(':checkbox.productcheck:checked').length>0){
		 var allVals = [];
				 $(':checkbox.productcheck:checked').each(function() {
				   allVals.push($(this).val());
				 });
	var userid = $("#user").val();
	if(userid == "")
	{
		alert("Select User");
		$("#notify").html('<h4 class="alert_warning">Please select user</h4>')
	}
	else
	{
		$("#notify").load(url+'/apiassigndata/processassign?vals='+allVals+'&priority='+$("#priority").val()+'&userid='+userid);
		return false;
	}
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}
</script>
		