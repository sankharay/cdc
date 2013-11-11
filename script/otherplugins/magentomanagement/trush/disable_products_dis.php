<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");
	// $mysqli = new mysqli("localhost","demo","demo","cdc");
	if($mysqli->connect_errno)
	{
	echo $mysqli->connect_error;
	exit;	
	}
	require_once('../../urls.php');
	// require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
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
			$result = $mysqli->query("SELECT * FROM `api_discontinued` where status=1") or die(mysqli_error());

			while($content= $result->fetch_object())
			{
			if($content->VENDOR == '9876')
			{
			$result1 = $mysqli->query("SELECT * FROM `api_magento_all_products` WHERE `sku`='$content->SKU'");
			if($result1->num_rows > 0)
			$sku = $content->SKU;
			else
			$sku="";
			$result1 = $mysqli->query("SELECT * FROM `api_magento_all_products` WHERE `sku`='$content->SKU1'");
			if($result1->num_rows > 0)
			$sku = $content->SKU1;
			else
			$sku="";
			}
			else
			{
			$result1 = $mysqli->query("SELECT * FROM `api_magento_all_products` WHERE `sku`='$content->SKU'");
			if($result1->num_rows > 0)
			$sku = $content->SKU;
			else
			$sku="";			
			}
			if($sku != "")
			{
        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
			if($product_id)
			{

			// set URL key start
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			
			$product->setvisibility(1);
			$product->setstatus(2);
			$product->setinventorylookup(499);
			
			// update qty to zero
			$stockData = $product->getStockData();
			$stockData['qty'] = "0";
			$stockData['is_in_stock'] = 0;
			$product->setStockData($stockData);
			
			$realvendorid = $product->getvendorid();
			// update qty to zero

			 // try to save start
			 try {
				$product->save();
			$result1 = $mysqli->query("UPDATE `api_discontinued` SET `status`=2,`wrongvendor`='$realvendorid' WHERE `SKU`='$content->SKU'");
echo "-".$content->SKU."-";

				// exit;
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends
			}
			else
			{
			echo "not there";
			$result1 = $mysqli->query("UPDATE `api_discontinued` SET `status`=3 WHERE `SKU`='$content->SKU'");
			}
			}
			else
			{
			echo "blank";
			$result1 = $mysqli->query("UPDATE `api_discontinued` SET `status`=4 WHERE `SKU`='$content->SKU'");
			}
			}
			}
?>