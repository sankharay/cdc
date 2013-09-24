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
                            <td>Enter  Attribute Field Numbers </td>
                            <td><input type="text" name="attributes" id="attributes" value="" />&nbsp;&nbsp;<a data-content="ADD fields suprated by Comma's" data-rel="popover" class="label label-success" href="#" >?</a></td>
                          </tr>
                          <tr>
                            <td>File Name</td>
                            <td><?php echo $filename->filename; ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" class="btn btn-primary" value="Process File" onclick="return processdata();" /></td>
                          </tr>
                        </table>
                 </div>
				</div>
			</div><!--/row-->
<div id="resutingdata"></div>
<div id="waiting" class="waiting" ><img src="<?php echo BASE_URL; ?>/img/loader.gif" width="32" height="32" /></div>
            <style>
.waiting
{
	display:none;
}
.waitings
{
			display: block;	
			visibility: visible;
			position: absolute;
			z-index: 999;
			top: 0px;
			left: 0px;
			width: 105%;
			height: 105%;
			background-color: #ccc;
			text-align: center;
			padding-top: 20%;
			filter: alpha(opacity=75);
			opacity: 0.75;
}
</style>
<script language="javascript">
			function processdata()
			{
            var vendorid=$('#vendorid').val();
            var fileid=<?php echo $this->uri->segment(3); ?>;
            var attributes = $('#attributes').val();
			if(vendorid != "0")
			{
			$("#waiting").removeClass("waiting");
			$("#waiting").addClass("waitings");
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL."/processfilebyuser/useraccessingapi/"; ?>?vendorid='+vendorid+'&fileid='+fileid+'&attributes='+attributes,
                success: function(data) {
                $('#resutingdata').html(data);
			
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
          }
        });
			}
		  else
		  {
			alert("Please select vendor");  
		  }
			}
</script>

			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		