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
	$notfound = array();
	$qtyvalue = mysql_query("select * from cdc.api_inventry where status=1 AND (vendorid!='' AND vendorid!='~')");
	while($qtyvaluerow = mysql_fetch_object($qtyvalue))
	{
	$productsku = trim($qtyvaluerow->sku);
	$vendorid = $qtyvaluerow->vendorid;
	$productid = get_product_id($qtyvaluerow->sku);
	$checkidintable = check_pid($productid,$qtyvaluerow->sku);
	$qty = trim($qtyvaluerow->qty);
	if($productid != FALSE)
	{
	if($checkidintable == TRUE)
	{
	mysql_query("UPDATE cdc.`inventry_intertable` SET  `qty`='$qty', `status`=1 WHERE `productsku`='$productsku' AND `vendorid`='$vendorid'") or die(mysql_error());
	}
	else
	{
	mysql_query("INSERT INTO `cdc`.`inventry_intertable` (`id`, `productid`, `productsku`, `vendorid`, `qty`, `status`, `dateandtime`) VALUES (NULL, '$productid', '$productsku', '$vendorid', '$qty', '1', CURRENT_TIMESTAMP)") or die(mysql_error());
	}
	// mysql_query("UPDATE cdc.`api_inventry` SET `status`=1 WHERE `sku`='$qtyvaluerow->sku' AND `vendorid`='$vendorid'") or die(mysql_error());
	}
	else
	{
	$notfound[] = $qtyvaluerow->sku;
	}
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
	if(mysql_num_rows($productid) > 0)
	{
	$productidqueryfetch = mysql_fetch_object($productid);
	return $productid =$productidqueryfetch->entity_id;
	}
	else
	return FALSE;
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