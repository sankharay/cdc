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
                    <div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							
							<p><?php echo $this->session->userdata('update');$this->session->unset_userdata('update'); ?></p>
						</div>
                    <?php
				}
				?>
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Manage Common Content</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="advancesearchdata"><button class="btn btn-mini btn-primary" id="asearch">Advance Search</button>
&nbsp;&nbsp;<a href="<?php echo BASE_URL; ?>/attributemanagement/addnewcommoncontent/" class="cboxElement"><button class="btn btn-mini btn-primary">Add New Content</button></a>
                    </div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
     
						  <thead>
							  <tr>
								  <th width="67">What Update</th>
								  <th width="47">Update ID</th>
								  <th width="55">Date &amp; Time</th>
								  <th width="66">Action</th>
							    <th width="51">Status</th>
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
								<td><?php echo $this->log->whatupdate($value->whatupdate); ?></td>
							  <td><?php echo $value->updateid; ?></td>
<td class="center">
<?php 
echo $value->updatedatetime;

?>
</td>
								<td class="center">
<?php if($value->whatupdate == 1 ) { ?>
<button class="btn btn-mini btn-primary" onclick="return addcatnew('<?php echo PLUGINS_WEB_URL; ?>',<?php echo $value->updateid; ?>);">Send to magento</button>
<?php } else { ?>
<button class="btn btn-mini btn-primary" onclick="return updatecatnew('<?php echo PLUGINS_WEB_URL; ?>',<?php echo $value->updateid; ?>);">Update to magento</button>
<?php } ?>
&nbsp;&nbsp;
							    </td>
								<td class="center">
                                <span class="label label-success">
									<?php echo $this->log->whatupdatestatus($value->status); ?> </span>   
									</a>
								</td>
							</tr>
							
							  <?php
						  }
						  ?>
						  </tbody>
                          <tfoot>
<tr>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Cat." name="search_platform">
	  </th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Keywords" name="search_productname">
	</th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Description" name="search_sku">
	  </th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	  </th>
	<th rowspan="1" colspan="1">
		<input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	</th>
</tr>
</tfoot>
<?php
						  }
						  ?>
					  </table>
<div id="resutingdata"></div>
<div id="waiting" class="waiting" ><img src="<?php echo BASE_URL; ?>/img/loader.gif" width="32" height="32" /></div>
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

	<script language="javascript">
function updatecatnew(url,id)
{
	
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	$.ajax({
		  type: "GET",
		  url: url+"/magentomanagement/updatecategory.php",
		  data: { cat_id: id }
		}).done(function( msg ) {
		  alert( "Data Send: " + msg );
		 if(msg = 1){
			alert("Data send to magento")
			$("#updating").hide();
			$("#magentoupdatedone").show();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");			
			window.location.reload(true);
		}
		else if(msg = 2)
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");			
			window.location.reload(true);
		}else
		{
			alert("Data Not send Please try after some time");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}
		
		 
		});
}
</script>	