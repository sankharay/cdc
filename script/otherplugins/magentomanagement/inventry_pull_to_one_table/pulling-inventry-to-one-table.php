<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	// first db connection start
	$connect1 = mysql_connect("192.168.100.121","curacaodata","curacaodata");
	mysql_select_db("cdc",$connect1);
	// first db connection ends
	// second db connection start
	$connect2 = mysql_connect("192.168.100.121","curacaodata","curacaodata");
	mysql_select_db("curacao_magento",$connect2);
	// second db connection ends
	
	$qtyvalue = mysql_query("select * from cdc.update_queue_masterproducttable where status=1");
	while($qtyvaluerow = mysql_fetch_object($qtyvalue))
	{
	echo $productsku = trim($qtyvaluerow->product_sku);
	echo "<br>";
	$vendorid = get_vendorid($qtyvaluerow->product_source);
	echo "<br>";
	echo $productid = get_product_id($qtyvaluerow->product_sku);
	$checkidintable = check_pid($productid,$qtyvaluerow->product_sku);
	$qty = trim($qtyvaluerow->product_qty);
	if($checkidintable == TRUE)
	{
	mysql_query("UPDATE cdc.`inventry_intertable` SET  `qty`='$qty', `status`=1 WHERE `productsku`='$productsku' AND `vendorid`='$vendorid'") or die(mysql_error());
	}
	else
	{
	mysql_query("INSERT INTO `cdc`.`inventry_intertable` (`id`, `productid`, `productsku`, `vendorid`, `qty`, `status`, `dateandtime`) VALUES (NULL, '$productid', '$productsku', '$vendorid', '$qty', '1', CURRENT_TIMESTAMP)") or die(mysql_error());
	}
	mysql_query("UPDATE cdc.`update_queue_masterproducttable` SET `status`=1 WHERE `product_sku`='' AND `product_source`=''") or die(mysql_error());
	}
	
	
	
	function get_vendorid($vid)
	{
	$template = mysql_query("select * from cdc.vendormanagement where vmID=$vid") or die(mysql_error());
	$templatedada = mysql_fetch_object($template);
	return $templatedada->vendorID;
	}
	
	function get_product_id($psku)
	{
	$productid = mysql_query("select * from curacao_magento.catalog_product_entity where sku='$psku'") or die(mysql_error());
	$productidqueryfetch = mysql_fetch_object($productid);
	return $productid =$productidqueryfetch->entity_id;
	}
	
	function check_pid($pid,$psku)
	{
	$productidcheck = mysql_query("SELECT * FROM cdc.`inventry_intertable` WHERE productid='$pid' AND productsku='$psku'");
	if(mysql_num_rows($productidcheck) > 0)
	return TRUE;
	else
	return FALSE;
	}
	
	
?>