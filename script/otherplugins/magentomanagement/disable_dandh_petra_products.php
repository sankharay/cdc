<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	$result = true;
	
	$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");
	if($mysqli->connect_errno)
	{
	echo $mysqli->connect_error;
	exit;	
	}
	$skudata = FALSE;
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	umask(0);
	Mage::app('default'); 
    $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			if($contents = $mysqli->query("select * from api_discontinued where status=1"))
			{
			if($contents->num_rows > 0)
			{
			while($content = $contents->fetch_object())
			{
			echo $sku = trim($content->SKU);
			$sku1contents = $mysqli->query("select * from api_magento_all_products where sku='$sku'");
			if($sku1contents->num_rows > 0 )
			$skudata = TRUE;
			if($skudata == FALSE)
			{
			// means product not with us
			$sku2contents = $mysqli->query("UPDATE api_discontinued SET status=3 where SKU='$sku'");
			echo "no sku";
			}
			if($sku !="" AND $skudata == TRUE)
			{
        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
			if($product_id)
			{
		exit;
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			if((trim($product->getvendorid()) == trim($content->VENDOR)) AND (trim($product->getupc()) == trim($content->UPC)) )
			{
			$product->setvisibility(1);
			$product->setstatus(2);
			$product->setinventorylookup(499);
			// update qty to zero
			$stockData = $product->getStockData();
			$stockData['qty'] = "0";
			$stockData['is_in_stock'] = 0;
			$product->setStockData($stockData);
			// update qty to zero
			 // try to save start
			 try {
				$product->save();
				// status 2 means product disabled
			$sku2contents = $mysqli->query("UPDATE api_discontinued SET status=2 where SKU='$sku'");
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends
			}
			}
			else
			{
			echo "Updated";
			}
			}
			}
			}
			}
?>