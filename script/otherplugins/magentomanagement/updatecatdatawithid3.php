<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	ini_set('max_execution_time', 0);
	ini_set("memory_limit","5024M");
	ini_set('apc.cache_by_default','Off');

$connection = mysqli_connect("192.168.100.121","curacaodata","curacaodata","cdc");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

	include('../urls.php');
	include('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	$result = true;

	$updatenon = false;
	include(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$j=0;

$obj = mysqli_query($connection,"SELECT * FROM `direct_mosse_products_missing_cat` WHERE `status`='3'") or die(mysqli_error($connection));
			// echo mysqli_num_rows($contents);
			while($content=mysqli_fetch_object($obj))
			{
$j=$j+1;
			$sku = trim($content->SKU);
        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
			if($product_id)
			{
			// set URL key start
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			
			$vendorid = trim($product->getvendorid());
			if($vendorid == '55676')
			{
			$cat = $product->getCategoryIds();
			// check is this is contain more categories of not
			$addcat = "668";
			$cat[] = trim($addcat);
			$cat = array_unique($cat);
			$product->setCategoryIds($cat);
			}	
					try {
					$product->save();
					// 6 status update successfully
					echo "- ".$sku."-";
					$contents = mysqli_query($connection,"UPDATE direct_mosse_products_missing_cat SET `status`=6 WHERE `SKU`='$sku'");
if($j == "5000")
exit;
					} catch (Exception $ex) {
					echo $ex->getMessage();
					}
			}
			}
?>