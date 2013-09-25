<div style="float:right;">
    <?php
if($dropdown)
{
	echo "<select name='catid' onChange='getallmagidprss(this.value);' required>";
	echo "<option value=''>Select Category</option>";
	foreach($dropdown as $dropdowns)
	{
	?>
    <option value="<?php echo $dropdowns->magento_category_id; ?>"><?php echo $dropdowns->name; ?></option>
    <?php	
	}
	echo "</select>";
}
?>
<br>
<input type="button" name="addaddon" class="btn btn-primary" value="Add Addon's" onclick="return addproductsaddon();" />
</div>
<div style="height:700px;width:1200px;">
<div id="notifyproduct"></div>
</div>
<script>
function getallmagidprss(id)
{
$('#notifyproduct').load("<?php echo BASE_URL; ?>/addrelatedproducts/products/"+id);
// alert("Product send for Magento Queue");
// window.location=url+"/finaproducts/";
return false;	
}

function addproductsaddon()
{
	var url = "<?php echo PLUGINS_WEB_URL; ?>/categorytree/";
	var fplid = <?php echo $this->uri->segment(3); ?>;
	if($(':checkbox.addsons:checked').length>0){
		 var allVals = [];
				 $(':checkbox.addsons:checked').each(function() {
				   allVals.push($(this).val());
				 });
		$("#notify").load(url+'addadonsinproduct.php?vals='+allVals+'&fplid='+fplid);
	}else{
		$("#notify").html('<h4 class="alert_warning">Please select product</h4>')
	}
	return false;
}
</script>