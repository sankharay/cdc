<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	ini_set('max_execution_time', 0);
	ini_set("memory_limit","5024M");
	ini_set('apc.cache_by_default','Off');

	$mageFilename = '/var/www/upgrade/app/Mage.php';
	
	require_once $mageFilename;
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
	
	
	$currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	
	$collection = Mage::getModel('catalog/product')->getCollection()
		->addAttributeToSelect('*') // select all attributes
		->setCurPage(4); // set the offset (useful for pagination)
		
		// we iterate through the list of products to get attribute values
		$j = 1;
		foreach ($collection as $product) {
			$stockData = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product)->getQty();
			// $stockData = $stockItem->getQty();
			
			$data[] = array( "product_id"=>$product->getId(),"name"=>$product->getName(), "sku"=>$product->getSku(),"Vendor"=>$product->getVendorid(),"Quantity"=>$stockData,"Status"=>$product->getStatus());
			
			  $j++;



		}
	

	  $filename = "Magento_All_Products.xls";
	
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  header("Content-Type: application/vnd.ms-excel");
	
	  $flag = false;
	  foreach($data as $row) {
	
		if(!$flag) {
		  // display field/column names as first row
		  echo implode("\t", array_keys($row)) . "\r\n";
		  $flag = true;
		}
	   // array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\r\n";
	  }
	
	
	exit;	
	
	
