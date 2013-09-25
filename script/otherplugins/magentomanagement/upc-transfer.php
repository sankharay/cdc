<?php
	ini_set('max_execution_time', 300);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$finaldata = mysql_query("select * from finalproductlist where product_upc=''");

	while($finaldatarow = mysql_fetch_object($finaldata))
	{
	echo $finaldatarow->product_sku."<br>";
	if($finaldatarow->product_upc == "")
	{
	$finaldata = mysql_query("select * from directmagentotable where product_sku='$finaldatarow->product_sku'");
	$datas = mysql_fetch_object($finaldata);
	mysql_query("UPDATE `finalproductlist` SET `product_upc`='$datas->product_upc' WHERE `product_sku`='$finaldatarow->product_sku'");
	}
	}
?>
<script>
setTimeout(function(){
   window.location.reload(1);
}, 2000);
</script>