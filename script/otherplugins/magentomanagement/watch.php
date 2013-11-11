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
			
		if($result = $mysqli->query("select * from direct_watch_data where status=1"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				$sku = trim($content->SKU);

				$magentoproductIds = Mage::getModel('catalog/product')->getIdBySku($sku);
				if($magentoproductIds)
				{
				$imageentry = $mysqli->query("UPDATE `direct_watch_data` SET `status`='3' WHERE `SKU`='$sku'");
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
				$img = explode(' ',$content->ImageLink);
				
				for($i=0;$i<1;$i++){
				if(trim($img[$i]) != ''){
				//if(file_exists(trim($img[$i]))){
				//echo 'here';
				if(!@file_get_contents(trim($img[$i]))){
				$noimageentry = $mysqli->query("UPDATE `direct_watch_data` SET `imagestatus`='1' WHERE `SKU`='$sku'");
				}
				else
				{
				$from = trim($img[$i]);
				$urlimg = rand(2000,5000);
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
				$product->settv_brand($content->Brand_ID);
				$product->setvendorid(6987);
				$categories = explode('_',$content->category_tree);
				$product->setCategoryIds($categories);
				$product->setSku(trim($sku));
				$product->setupc($content->UPC);
				$product->setMeta_title($content->Product_Name);
				$updateurl = $content->Product_Name." ".$content->StraporBraceletColor;
				$newurl = htmlspecialchars_decode($updateurl,ENT_QUOTES);
				$creaturl = cleaningdata($newurl);
				$strlower = strtolower($creaturl);
				$url = str_replace(" ","-",$strlower);
				$randurl=rand(15,50);
				$url = $url."-".$randurl.".html";
				// $url = checkurlstatus($url);
				$url = str_replace(".html","","$url");


				$product->seturl_key($url);
				$product->setorig_name($content->Product_Name);
				$product->setmeta_keyword(htmlspecialchars_decode($content->Meta_tags,ENT_QUOTES));
				$product->setmeta_description(htmlspecialchars_decode($content->Description,ENT_QUOTES));
				$updatename = $content->Product_Name." - ".$content->StraporBraceletColor;
				$product->setName($updatename);
				$short_description = str_replace($search, $values, $content->Description);
				$product->setShortDescription(htmlspecialchars_decode($short_description,ENT_QUOTES));
				
;

				$productdescription  = htmlspecialchars("$content->Description");
				$product_description = str_replace($search, $values, "$productdescription");
				$product->setDescription(htmlspecialchars_decode($product_description,ENT_QUOTES));
				
				$specification = htmlspecialchars("<ul><li>Gender: $content->Gender</li><li>Dial: $content->Dial</li><li>Movement: $content->Movement</li><li>Clasp: $content->Clasp</li><li>Strap or Bracelet: $content->StraporBracelet</li><li>Strap or Bracelet Color: $content->StraporBraceletColor</li><li>Case Shape: $content->CaseShape</li><li>Measurement: $content->Measurement</li><li>Bracelet Measurement: $content->Bracelet_Measurement</li><li>Bracelet Length (in inches): $content->Bracelet_Length</li><li>Crystal: $content->Crystal</li><li>Crown: $content->Crown</li><li>Water Resistance: $content->Water_resistance</li><li>$content->Specifications</li></ul>");
				
				$product_specs = str_replace($search, $values, $specification);
				$product->setspec001(htmlspecialchars_decode($product_specs,ENT_QUOTES));
					
				$product->setPrice($content->Retail);
				$product->setcost($content->cost);
				$packingweight = "1.00";
				$product->setweight($packingweight);
				
				// get shipping starts
				$shippingrate = "6.99";
				$product->setshprate($shippingrate);
				
				if($content->Inventory == "")
				$stock=0;
				else
				$stock=$content->Inventory;
			 
				$product->setStockData(array('is_in_stock' => 1, 'qty' => $stock));
				$product->setstatus("1");
				$product->setonline_only("1");
				try {
				$product->save();
				$imageentry = $mysqli->query("UPDATE `direct_watch_data` SET `status`='2' WHERE `SKU`='$sku'");
				echo "Import Done".$sku;
				$j=$j+1;
if($j==50)
exit;
sleep(2);exit;
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