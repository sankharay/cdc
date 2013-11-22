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


			$contents = mysql_query("SELECT * FROM cdc.mosse_real_missing_cat_list WHERE status=1") or die(mysql_error());

			while($content = mysql_fetch_object($contents))
			{

				echo $sku = trim($content->sku);
        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
			if($product_id)
			{
			// set URL key start
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			
			$vendorid = trim($product->getvendorid());
			if($vendorid == '55676')
			{
			if($content->category_tree  != "")
			{
			$cat = $product->getCategoryIds();
			// check is this is contain more categories of not
			$findcat = explode('_',$content->category_tree);
			$catsize = sizeof($findcat);
			if($catsize > 1)
			{
			for($f=0;$f<$catsize;$f++)
			$cat[] = $findcat[$f];
			$cat = array_values(array_unique($cat));
			$product->setCategoryIds($cat);
			}
			}
			}
			else
			{
			$contents = mysql_query("UPDATE cdc.mosse_real_missing_cat_list SET `status`=3 WHERE `sku`='$sku'");
			$updatenon = TRUE;
			}

				if($updatenon != TRUE)
{	
			 try {
				$product->save();
			$contents = mysql_query("UPDATE cdc.mosse_real_missing_cat_list SET `status`=2 WHERE `sku`='$sku'");
sleep(1);
exit;
			
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
}
			}
			else
			{
			echo $content->sku." Not Found<br>";
			}
			}
			echo "All Sku's Updated";
			}
?>