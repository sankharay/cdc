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
			$contents = mysql_query("SELECT * FROM `direct_dorel_qty` WHERE `status`=1 ORDER BY `id` DESC");

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
			$qtyStock = trim($content->qty);
			if($qtyStock > 0 )
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = $qtyStock;
			$stockData['is_in_stock'] = 1;
			$product->setVisibility(4);
			$product->setStatus(1);
			}
			else
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = $qtyStock;
			$stockData['is_in_stock'] = 0;
			$product->setVisibility(1);
			$product->setStatus(2);
			}
			$product->setStockData($stockData);
			
			 // try to save start
			 try {
				$product->save();
				$update = mysql_query("UPDATE `direct_dorel_qty` SET `status`=2 WHERE `sku`='$content->sku'");

			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends

			}
			else
			{
			$update = mysql_query("UPDATE `direct_dorel_qty` SET `status`=3 WHERE `sku`='$content->sku'");
			echo $content->sku." Not Found<br>";
			}

			}
			}
?>