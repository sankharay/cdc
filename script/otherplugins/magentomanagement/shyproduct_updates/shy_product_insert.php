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
			
		if($result = $mysqli->query("select * from direct_shy_products where status=1"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				$sku = trim($content->SKU);

				$magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
				if($magentoproductIds)
				{
				$imageentry = $mysqli->query("UPDATE `direct_shy_products` SET `status`='3' WHERE `SKU`='$sku'");
				echo "product SKU already there".$sku;
				}
				else
				{
				// removing special Character data strt
				$list = get_html_translation_table(HTML_ENTITIES);
				unset($list['"']);
				unset($list['<']);
				unset($list['>']);
				unset($list['&']);		
				$search = array_keys($list);
				$values = array_values($list);
				// removing special Character data end	
				
				$product = new Mage_Catalog_Model_Product();
				// images section starts
				$img = explode(',',$content->Images);
				$numimages = sizeof($img);
				for($i=0;$i<$numimages;$i++){
				if(trim($img[$i]) != ''){
				//if(file_exists(trim($img[$i]))){
				//echo 'here';
				if(!@file_get_contents(trim($img[$i]))){
				$noimageentry = $mysqli->query("UPDATE `direct_shy_products` SET `imagestatus`='1' WHERE `SKU`='$sku'");
				}
				else
				{
				$from = trim($img[$i]);
				$urlimg = rand(1,2000);
				$image = IMAGES_MAGENTO_LOCATION_URL.str_replace('/','_',$sku).'_'.$urlimg.'.jpg';
				if(!@copy($from,$image))
				{
				$errors= error_get_last();
				echo $errors['message'];
				exit;
				
				}
				else
				{						
				$product->addImageToMediaGallery ($image, array('image','small_image','thumbnail'), false, false); 
				}
				}
				}
				}
				// images section ends			
				
				$product->setTypeID("simple");
				$product->setVisibility(4);
				$product->setStatus(1);
				$product->setWebsiteIds(array(1));
				$product->setStoreIds(array(1));
				$product->setAttributeSetId(4);
				$product->setTaxClassId(2);
				// $product->settv_brand($content->brand_id);
				$product->setvendorid($content->vendor_id);
				$categories = explode('_',$content->category_tree);
				$categories[] = "10";
				$product->setCategoryIds($categories);
				$product->setSku(trim($sku));
				
				$product->setMeta_title($content->product_name);
				$updateurl = $content->product_name;
				$newurl = htmlspecialchars_decode($updateurl,ENT_QUOTES);
				$creaturl = cleaningdata($newurl);
				$strlower = strtolower($creaturl);
				$url = str_replace(" ","-",$strlower);
				$urlcode = rand(3,3);
				$url = $url."-".$urlcode;
				// $url = checkurlstatus($url);
				$url = str_replace(".html","","$url");


				$product->seturl_key($url);
				$product->setorig_name($content->product_name);
$metakey = $content->product_name." ".$content->Metatags;
				$product->setmeta_keyword(htmlspecialchars_decode($metakey,ENT_QUOTES));
				$product->setmeta_description(htmlspecialchars_decode($content->description,ENT_QUOTES));
				$updatename = $content->product_name;
				$product->setName($updatename);
				
				$productdes = explode(",",$content->description);
				$dessize = sizeof($productdes);
				$desciption = "<ul>";
				for($i=0;$i<$dessize;$i++)
				{
					$desciption.="<li>".$productdes[$i]."</li>";
				}
				$desciption.= "</ul>";
				
				$short_description = str_replace($search, $values, $desciption);
				$short_descriptions = str_replace($search, $values, $content->description);
				$product->setShortDescription(htmlspecialchars_decode($short_descriptions,ENT_QUOTES));
				
				$product->setDescription(htmlspecialchars_decode($short_description,ENT_QUOTES));
				
				$product->setPrice($content->retail);
				$product->setcost($content->cost);
				$packingweight = $content->Weight;
				$product->setweight($packingweight);
				
				// get shipping starts
				$shippingrate = $content->Shipping;
				$product->setshprate($shippingrate);
				
				if($content->Inventory == "")
				$stock=0;
				else
				$stock=$content->Inventory;
			 
				$product->setStockData(array('is_in_stock' => 1, 'qty' => $stock));
				$product->setstatus("1");
				$product->setonline_only("1");
				$product->setinventorylookup("499");

				try {
				$product->save();
				$imageentry = $mysqli->query("UPDATE `direct_shy_products` SET `status`='2' WHERE `SKU`='$sku'");
				echo "Import Done".$sku;
				$j=$j+1;

if($j==50)
exit;
sleep(2);
				}
				catch (Exception $ex) {
				echo $ex->getMessage();
				}

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