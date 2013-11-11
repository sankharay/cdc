<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');
	require_once('../../dbw.php');
	require_once('../../urls.php');

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
			$contentrow = mysql_query("select * from direct_addmissing_images where status=1");
			while($content = mysql_fetch_object($contentrow))
			{
        	// $magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$content->product_sku);
			echo $content->sku."<br>";
			$product_id = Mage::getModel('catalog/product')->getIdBySku($content->sku);
			if($product_id)
			{
			// add new product
//			$product = Mage::getModel('catalog/product');
//		    $product->load($product_id);
			// images section starts
			// first removing existing images from product start
//			if($content->Image_URL != "")
//			{
//			$mediaApi = Mage::getModel("catalog/product_attribute_media_api");
//			$mediaApiItems = $mediaApi->items($product_id);
//			foreach($mediaApiItems as $item) {
//			$datatemp=$mediaApi->remove($product_id, $item['file']);
//			}
//			$product->save();
//			// first removing existing images from product ends

			// after removing image again load product start
			$product = Mage::getModel('catalog/product');
		    $product->load($product_id);
			// after removing image again load product ends
			if($content->Image_URL != "")
			{
			$imagesdata = $content->Image_URL;
			$product->addImageToMediaGallery ($imagesdata, array('image','small_image','thumbnail'), false, false);
			// images section ends
			}
			if($content->name != "")
			{
			$newurl = htmlspecialchars_decode($content->name,ENT_QUOTES);
			$creaturl = cleaningdata($newurl);
			$strlower = strtolower($creaturl);
			$url = str_replace(" ","-",$strlower);
			$url = $url.".html";
			$url = checkurlstatus($url);
			$url = str_replace(".html","","$url");
			
			$product->setName($content->name);
			$product->setorig_name($content->name);
			}
			
			if($content->QTY == "1")
			{
			
			}
			elseif($content->QTY == "0")
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = "0";
			$stockData['is_in_stock'] = 0;
			$product->setVisibility(1);
			$product->setStatus(2);
			$product->setinventorylookup("499");
			}
			 // print_r($product);
			 // exit;
			// assign product to the default website
 			try {
				
				$product->save();
				mysql_query("UPDATE direct_addmissing_images SET status=2 WHERE sku='$content->sku'");
				
			exit;
			}
			catch (Exception $ex) {
				echo $ex->getMessage();
			}
			}
			else
			{
			echo "product sku not there";
			}
			}
	}
	else
	{
	// fpl not exist so no result
	exit;
	}
	
	
function cleaningdata($string) {
$string = str_replace(" ", "-", $string); 
$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
return preg_replace('/-+/', ' ', $string);
}
	
	
?>