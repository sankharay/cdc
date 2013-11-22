<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');

	$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");
	
	if($mysqli->connect_errno)
	{
	echo $mysqli->connect_error;
	exit;
	}
$j=0;
require_once('../urls.php');
	// require_once('Mfunctions.php');
	$result = TRUE;
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			// $contents = get_mossee_data();
			
		if($result = $mysqli->query("select * from direct_watch_data where status=2"))
	{
		if($result->num_rows > 0)
		{
							while($content = $result->fetch_object())
							{
									$sku = trim($content->SKU);
									$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
									if($product_id)
									{
									// start saving
									$product = Mage::getModel('catalog/product');
									$product->load($product_id);
									$product->settv_brand($content->Brand_ID);
									try {
									$product->save();
									$imageentry = $mysqli->query("UPDATE `direct_watch_data` SET `status`='6' WHERE `SKU`='$sku'");
									echo "Import Done".$sku."-";
									sleep(1);
									}
									catch (Exception $ex) {
									echo $ex->getMessage();
									}
									// start saving ends
									}
									else
									{
									echo "product no there<br>";
							}
		}
		}
		
	}				
			
			
	}
	else
	{
	exit;
	}


	
?>