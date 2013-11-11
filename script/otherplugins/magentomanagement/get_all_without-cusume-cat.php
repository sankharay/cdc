<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	$result = true;

	$updatenon = false;
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	$que = 1;

	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);


			$contents = mysql_query("SELECT * FROM direct_mosse_products_missing_cat WHERE status=1") or die(mysql_error());

			while($content = mysql_fetch_object($contents))
			{

				echo $sku = trim($content->SKU);
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
echo "<pre>";
print_r($cat);
echo "<pre>";
			// check is this is contain more categories of not
			if(in_array("668", $cat))
			{
	echo "exist";
			mysql_query("UPDATE cdc.direct_mosse_products_missing_cat SET status=2 where SKU='$sku'") or die(mysql_error());
			}
			else
			{
	echo "not exist";
			mysql_query("UPDATE cdc.direct_mosse_products_missing_cat SET status=3 where SKU='$sku'") or die(mysql_error());
			}

			}
			}
			}
			}
?>