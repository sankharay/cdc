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
	require_once('../../urls.php');
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
			
		if($result = $mysqli->query("select * from direct_skycreations_update_retail where status=1"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				echo $sku = trim($content->sku);

				$magentoproductIds = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
				if($magentoproductIds)
				{
						$product = Mage::getModel('catalog/product');
						$product->load($magentoproductIds);
						$producturl = $product->setprice($content->retail);
						
						try {
						$product->save();
						$noimageentry = $mysqli->query("UPDATE `direct_skycreations_update_retail` SET `status`='2' WHERE `sku`='$sku'");
						echo "-".$sku."-";
						} catch (Exception $ex) {
						echo $ex->getMessage();	
						}

						
				}
				else
				{
					echo "product not there";

		}
			// while loop ends	
		}
		}
		
	}				
			
			
	}
	else
	{
	exit;
	}


	
?>