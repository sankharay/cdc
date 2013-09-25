<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	$result = true;
	
	
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = get_pure_disabled_real();

			while($content = mysql_fetch_object($contents))
			{
			echo $content->sku."<br>";

        	$product_id = Mage::getModel('catalog/product')->getIdBySku($content->sku);
			if($product_id)
			{
			// set URL key start

			echo $content->sku." SKU Updated<br>";
		
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			
			$product->setVisibility(1);
			$product->setStatus(2);
			
			 // try to save start
			 try {
				$product->save();
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends
			}
			else
			{
			echo $content->sku." SKU Not Exist<br>";
			}

			}
			}
?>