<?php
	ini_set('max_execution_time', 300);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$finaldata = mysql_query("SELECT * FROM `finalproductlist` WHERE `product_img_path`=''");

	while($finaldatarow = mysql_fetch_object($finaldata))
	{
	echo $finaldatarow->product_sku."<br>";
	if($finaldatarow->product_img_path == "")
	{
	$finaldata = mysql_query("select * from directmagentotable where product_sku='$finaldatarow->product_sku'");
	$datas = mysql_fetch_object($finaldata);
	mysql_query("UPDATE `masterproducttable` SET `product_img_path`='$datas->product_img_path' WHERE `product_sku`='$finaldatarow->product_sku'");
	}
	exit;
	}
?>