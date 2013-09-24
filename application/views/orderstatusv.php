<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
	<!-- jQuery -->
	<script src="<?php echo BASE_URL; ?>/js/jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
	<script src="<?php echo BASE_URL; ?>/js/jquery-ui-1.8.21.custom.min.js"></script>	
    	
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
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Search Products</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
<div class="advancesearchdata">
<div style="float:left; width:50%;">
<input type="text" placeholder="From Date" class="input-xlarge datepicker" id="pSpecialFromDate" name="pSpecialFromDate" style="width:160px;"> To 
                        <input type="text" placeholder="To Date" class="input-xlarge datepicker" id="pSpecialToDate" name="pSpecialToDate" style="width:160px;">
                        <input type="submit" name="searchorderid" class="btn btn-primary" value="Search" id="searchorderid" onclick="searchdate();" />
                        
<script>
	function searchdate(){
	var fromdate = $('#pSpecialFromDate').val();
	fromdate = fromdate.replace("/", "-");
	fromdate = fromdate.replace("/", "-");
	var todate = $('#pSpecialToDate').val();
	todate = todate.replace("/", "-");
	todate = todate.replace("/", "-");
	var url = "<?php echo BASE_URL; ?>";
	$("#searchdataresult").html('<img src="'+url+'/img/loading.gif">');
	$("#searchdataresult").load(url+"/orderstatus/seacrhresultdate/"+fromdate+"/"+todate);
	return false;
	}
</script>	
</div>
<div style="float:right; width:50%;">	
<input type="text" id="orderid" placeholder="Enter Order Number" name="orderid" />
<input type="submit" name="searchorderid" class="btn btn-primary" value="Search" id="searchorderid" onclick="searchdataee();" />
<script>
	function searchdataee(){
	var abc = $('#orderid').val();
	var url = "<?php echo BASE_URL; ?>";
	$("#searchdataresult").html('<img src="'+url+'/img/loading.gif">');
	$("#searchdataresult").load(url+"/orderstatus/seacrhresult/"+abc);
	return false;
	}
function resetdata()
{
location.reload();	
}
</script>	
<input type="reset" class="btn btn-primary" onclick="return resetdata();" />
</div>
</div>
<div style="clear:both;"></div>
<div id="searchdataresult">
						<table class="table table-striped table-bordered bootstrap-datatable datatables" id="datatables">
                        
                          
						  <thead>
							  <tr>
								  <th width="200px">Order Id</th>
								  <th>
<div style="width:60%; float:left">Comments</div>
<div style="width:20%; float:left">Status</div>
<div style="width:20%; float:left">Date</div>
</th>
							  </tr>
						  </thead>


  
						  <tbody>
                          <?php
						  if($content)
						  {
						  foreach($content as $value)
						  {
$style = $this->orderstatusm->getstatus($value->parent_id,$days);
							  ?>
							  
							<tr>
								<td><?php $numorder = $this->orderstatusm->checkorderid($value->parent_id,$value->entity_id);
if($numorder)
{
						  ?>
<div class="plussign plus<?php echo $value->parent_id; ?>" style="float:left; padding-right:10px;" id="plus<?php echo $value->parent_id; ?>"></div>  
<div class="minussign hidden" style="float:left; padding-right:10px;" id="minus<?php echo $value->parent_id; ?>"></div>                      
<?php
}
else
{?>
<div class="minussign minus<?php echo $value->parent_id; ?>" style="float:left; padding-right:10px;" id="minus<?php echo $value->parent_id; ?>"></div>
<?php
}
echo $value->parent_id;	?></td>
								<td style="background:<?php echo $style; ?>">
<div style="width:60%; float:left"><?php echo "Comment".$value->comment; ?></div>
<div style="width:20%; float:left"><?php echo $value->status; ?></div>
<div style="width:20%; float:left"><?php echo $value->created_at; ?>
</div>
<div style="clear:both;"></div>
<div class="datahide" id="ex<?php echo $value->parent_id; ?>">
<table width="100%" border="0">
<?php
$underexist = $this->orderstatusm->getallorderunderid($value->parent_id,$value->entity_id);

foreach($underexist as $undervalue)
{
	?>
  <tr>
  <td width="44%"><?php echo $undervalue->comment; ?></td>
    <td width="19%">
	<?php 
	if($undervalue->status != "")
	echo $undervalue->status;
	else
	echo "no Comments";
	 ?></td>
    <td width="16%"><?php echo $undervalue->created_at; ?></td>
    <td width="21%">
		<?php 
        if($lastunderdate != "")
		{
        echo $this->orderstatusm->getinterval($undervalue->created_at,$lastunderdate);
		}
        $lastunderdate = $undervalue->created_at;
        ?>
    </td>
  </tr>
<script>
$(".plus<?php echo $value->parent_id; ?>").click(function() {
$("#ex<?php echo $value->parent_id; ?>").show('slow');
$("#plus<?php echo $value->parent_id; ?>").addClass("hidden");
$("#minus<?php echo $value->parent_id; ?>").removeClass("hidden");
});
$("#minus<?php echo $value->parent_id; ?>").click(function() {
$("#ex<?php echo $value->parent_id; ?>").hide('slow');
$("#plus<?php echo $value->parent_id; ?>").removeClass("hidden");
$("#minus<?php echo $value->parent_id; ?>").addClass("hidden");
});
</script>
<?php
}
$lastunderdate = "";
?>
</table>
</div>
</td>
							</tr>
							  <?php
						  }
						  ?>
						  </tbody>
                         
<?php
						  }
						  ?>

  <tr>
    <td><?php echo $links; ?></td>
    <td>&nbsp;</td>
  </tr>

					  </table>
                      </div>
					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

	