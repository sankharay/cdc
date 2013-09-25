<table class="table table-striped table-bordered bootstrap-datatable datatable" id="datatables">
                        
                          
						  <thead>
							  <tr>
								  <th width="200px">Order Id</th>
								  <th>
<div style="width:60%; float:left">Comments</div>
<div style="width:20%; float:left">Date</div>
<div style="width:20%; float:left">Date</div>
</th>
							  </tr>
						  </thead>


  
						  <tbody>
                          <?php
//$orid = 388;
//echo $results = $this->orderstatusm->getstatus($orid,$days);
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
<div style="width:69%; float:left"><?php echo $value->comment; ?></div>
<div style="width:29%; float:left"><?php echo $value->created_at; ?>
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
    <td width="70%">
	<?php 
	if($undervalue->comment != "")
	echo $undervalue->comment;
	else
	echo "no Comments";
	 ?></td>
    <td><?php echo $undervalue->created_at; ?></td>
    <td>
		<?php 
        if(isset($lastunderdate) != "")
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
						  else
						  {
							?>
<tr>
    <td colspan="2">No Record Found</td>
  </tr>
                            <?php  
						  }
						  ?>

  

					  </table>