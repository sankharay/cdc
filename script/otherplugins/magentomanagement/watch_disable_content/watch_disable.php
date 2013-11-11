<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../../dbw.php');
	require_once('../../urls.php');
	require_once('../Mfunctions.php');
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
			$contents = mysql_query("select * from direct_watch_disable where status=1") or die(mysql_error());
			while($content = mysql_fetch_object($contents))
			{
			echo $content->sku."<br>";
        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
			if($product_id)
			{
			// set URL key start

		
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			
			$vendorid = $product->getvendorid();
			if($vendorid == 6987)
			{
			$brandid = $product->gettv_brand();
			if($brandid == 528 OR $brandid == 49 OR $brandid == 895 OR $brandid == 683 OR $brandid == 705 OR $brandid == 896 )
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
				mysql_query("UPDATE direct_watch_disable SET status=2 WHERE sku='$content->sku'");
echo $content->sku."-";

			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			}
			else
			mysql_query("UPDATE direct_watch_disable SET status=4 WHERE sku='$content->sku'");
			}
			else
			{
			mysql_query("UPDATE direct_watch_disable SET status=3 WHERE sku='$content->sku'");	
			}
			 // try to save ends
			}
			else
			{
			echo "Updated";
			}
			}
			}
?>