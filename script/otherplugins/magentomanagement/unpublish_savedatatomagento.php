<?php
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$fpl_id = $_GET['fpl_id'];
	$result = check_fpl_id_exist($fpl_id);
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL_DEMO);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	$status = $_GET['status'];

	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$content = get_english_data($fpl_id);
        	$magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$content->product_sku);
			if($magentoproductIds)
			{
			$productId = $magentoproductIds->getId();
			if ($productId) {
				$magentoproductIds->setStoreIds(array(1));
				$magentoproductIds->setStatus($status);
				$magentoproductIds->save();
			echo "Product Unpublished";
			$setstatus = insert_data_status($content->product_sku,$status);
			}
			}
			else
			{
			echo "Product Not Exist";
			}
	}
	else
	{
	exit;
	}
	
	
?>

