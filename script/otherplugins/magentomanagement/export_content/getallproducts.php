<?php
	ini_set('max_execution_time', 0);
	ini_set('display_errors', 1);
	ini_set("memory_limit","2048M");
	
	include('../../urls.php');
	
	require_once MAGE_FILE_URL;
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
			
	
			$data[] = array( "vendor_id"=>$product->getvendorid(),"sku"=>$product->getSku(),"Status"=>$product->getStatus());
			
			  $j++;

		}
	

	  $filename = "Magento_Active_Products.xls";
	  $content = '';
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