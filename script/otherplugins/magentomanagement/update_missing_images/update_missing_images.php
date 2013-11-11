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
			
		if($result = $mysqli->query("select * from direct_update_missimg_products where status=1"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				$sku = trim($content->SKU);

        		$magentoproductIds = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
				if($magentoproductIds)
				{
				$product = Mage::getModel('catalog/product');
				$product->load($magentoproductIds);
				if($content->QTY == "0")
				{
				$stockData = $product->getStockData();
				$stockData['qty'] = "0";
				$stockData['is_in_stock'] = 0;
				$product->setVisibility(1);
				$product->setinventorylookup(499);
				$product->setStatus(2);
				}
				elseif($content->QTY == "1")
				{
				if($content->name != "")
				{
				$product->setname($content->name);
				$product->setorig_name($content->name);
				$product->seturl_key($content->name);
				}
				// image updates starts
				if($content->image_URL != "")
				{
				$product = Mage::getModel('catalog/product');
				$product->load($magentoproductIds);
				// images section starts
				// first removing existing images from product start
				$mediaApi = Mage::getModel("catalog/product_attribute_media_api");
				$mediaApiItems = $mediaApi->items($magentoproductIds);
				foreach($mediaApiItems as $item) {
				$datatemp=$mediaApi->remove($product_id, $item['file']);
				}
				$product->save();
				// first removing existing images from product ends
				
				// after removing image again load product start
				$product = Mage::getModel('catalog/product');
				$product ->load($magentoproductIds);
				// after removing image again load product ends
				$imagesdata = $content->image_URL;
				$product->addImageToMediaGallery ($imagesdata, array('image','small_image','thumbnail'), false, false);
				// images section ends			
				// image updates ends
				}
				
				if($content->name != "" OR  $content->image_URL != "" OR $content->QTY == "0")
				{
					try {
					$product->save();
					$mysqli->query("UPDATE direct_update_missimg_products SET status=1 WHERE sku='$sku'");
					}
					catch (Exception $ex) {
					echo $ex->getMessage();
					}
				}
				
				
				}
				}
				else
				{
				echo "Product Not There";	
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
	


function cleaningdata($string) {
   $string = str_replace(" ", "-", $string); 
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

   return preg_replace('/-+/', ' ', $string);
}

function checkurlstatus($key)
{
static $i=0;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://www.icuracao.com/'.$key);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_exec($curl);
$status = curl_getinfo($curl);
curl_close($curl);
if($status['http_code'] == '200')
{
$number = $i+1;
$replacewith = "-".$number.".html";
$replacenum = $number-1;
$replace = "-".$replacenum.".html";
$keys = str_replace('$replace',"$replacewith",$key);
return checkurlstatus($keys);
}
else
{
return $key;
}
}


	
?>