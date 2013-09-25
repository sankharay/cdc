<?php
	ini_set('max_execution_time', 300);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$result = TRUE;
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);

	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = get_catalog_special_data();
			while($content = mysql_fetch_object($contents))
			{
			echo $content->ItemID."<br>";
        	echo $product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->ItemID));
			if($product_id)
			{
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			$cat = $product->getCategoryIds();
			$cat[] = $content->Category;

			$product->setCategoryIds($cat);
			$product->setspecial_price($content->Special);
			$fromdate = date('m/d/Y',strtotime($content->From_date));
			$product->setspecial_from_date($fromdate);
			$todate = date('m/d/Y',strtotime($content->To_date));
			$product->setspecial_to_date($todate);

			try {
				$product->save();
				echo $content->ItemID." Updated<br>";
			}
			catch (Exception $ex) {
				echo $ex->getMessage();
				echo $content->ItemID."Not Updated<br>";
			}

			}
			else
			{
			echo $content->ItemID."Product SKU not exist";
			}
			}
			}	
?>