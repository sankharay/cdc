<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

	require_once('../../urls.php');
	$result = true;
	
	
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
	$currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	if($result = $mysqli->query("SELECT * FROM `trush_vendorid_add` WHERE `status`=1"))
	{
	if($result->num_rows > 0)
	{
	while($content=$result->fetch_object())
	{
	echo $content->sku." ".$content->VENDOR."-";
	
	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
	if($product_id)
	{
	$product = Mage::getModel('catalog/product');
	$product->load($product_id);
	$vendorid = trim($content->VENDOR);
	$product->setvendorid($vendorid);
	if($vendorid == "6532")
	{
	$stockData = $product->getStockData();
	$stockData['qty'] = "0";
	$stockData['is_in_stock'] = 0;
	$product->setVisibility(1);
	$product->setStatus(2);
	$product->setStockData($stockData);	
	$product->setinventorylookup("499");	
	}
	// try to save start
	try {
	$product->save();
	$contents = $mysqli->query("UPDATE `trush_vendorid_add` SET `status`=2 WHERE `sku`='$content->sku'");
sleep(5);

	} catch (Exception $ex) {
	echo $ex->getMessage();
	}
	// try to save ends
	}
	else
	{
	echo "No need to do anything";
	}
	}
	}
	}
	}
 $result->close();
$mysqli->close();
?>