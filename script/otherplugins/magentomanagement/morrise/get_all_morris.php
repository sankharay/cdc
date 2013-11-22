<?php
	// INI setting
	ini_set('max_execution_time', 0);
	ini_set('display_errors', 1);
	ini_set("memory_limit","1024M");
	//server DB connection
	$server = '192.168.100.121';
	$user = 'curacaodata';
	$pass = 'curacaodata';
	$db = 'curacao_magento';
	$link = mysql_connect($server,$user,$pass);
	$db1 = mysql_select_db($db,$link);	
	
	// new added content start
	$link1 = mysql_connect("192.168.100.121",$user,$pass);
	$db2 = mysql_select_db("cdc",$link1);	
	// new added content end


$getallorders = mysql_query("SELECT * FROM  curacao_magento.`sales_flat_order` WHERE hasmc=1");
while($getallordersrow = mysql_fetch_object($getallorders))
{
	$orderid = $getallordersrow->increment_id;
	$dateid = $getallordersrow->created_at;
	$vendorid = "55676";
	echo $cdcquery = "INSERT INTO `cdc`.`vendor_dailyhistory` (`id`, `orderId`, `billing`, `shipping`, `vendorid`, `dateandtime`) VALUES (NULL, '$orderid', '', '', '$vendorid', '$dateid')";
	$done = mysql_query($cdcquery) or die(mysql_error());

}

?>