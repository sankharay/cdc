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
			$contents = mysql_query("SELECT * FROM `direct_dorel_activation` WHERE `status`=1");

			while($content = mysql_fetch_object($contents))
			{
			// echo $content->sku." ".$content->qty."<br>";

        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
			if($product_id)
			{
			// set URL key start
			
			echo $content->sku."<br>";
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			$qtyStock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product)->getQty();
			if($qtyStock > 0 )
			{
			$stockData = $product->getStockData();
					$stockData['qty'] = 2;
			$stockData['is_in_stock'] = 1;
			$product->setVisibility(4);
			$product->setStatus(1);
			}
			else
			{
			$stockData = $product->getStockData();
					$stockData['qty'] = 2;
			$stockData['is_in_stock'] = 1;
			$product->setVisibility(4);
			$product->setStatus(1);
			}
			$product->setStockData($stockData);
			
			 // try to save start
			 try {
				$product->save();
				$update = mysql_query("UPDATE `direct_dorel_activation` SET `status`=2 WHERE `sku`='$content->sku'");
// exit;
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends

			}
			else
			{
			echo $content->sku." Not Found<br>";
			}

			}
			}
?>