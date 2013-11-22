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
			
		if($result = $mysqli->query("select * from direct_samsung_products where status=1"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				$sku = trim($content->SKU);

				$magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
				if($magentoproductIds)
				{
				$imageentry = $mysqli->query("UPDATE `direct_samsung_products` SET `status`='3' WHERE `SKU`='$sku'");
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
				$noimageentry = $mysqli->query("UPDATE `direct_samsung_products` SET `imagestatus`='1' WHERE `SKU`='$sku'");
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
				$product->settv_brand($content->brand_id);
				$product->setvendorid("54559");
				$categories = explode('_',$content->category_tree);
				$product->setCategoryIds($categories);
				$product->setSku(trim($sku));
				
				$replacement = "Samsung ".$sku;
				$productnameupdate = str_replace("Samsung","$replacement",$content->product_name);
				
				$product->setMeta_title($productnameupdate);
				$updateurl = $productnameupdate;
				$newurl = htmlspecialchars_decode($updateurl,ENT_QUOTES);
				$creaturl = cleaningdata($newurl);
				$strlower = strtolower($creaturl);
				$url = str_replace(" ","-",$strlower);
				// $url = checkurlstatus($url);
				$url = str_replace(".html","","$url");


				$product->seturl_key($url);
				$product->setorig_name($productnameupdate);
				
				$metakey = $productnameupdate;

				$productdes = $content->description;
				$productdes = str_replace("’","&#39;",$productdes);
				$description = str_replace($search, $values, $productdes);
				$getmetdes = explode(".",$description);

				if(sizeof($getmetdes) >= 4)
				$getmetdes = $getmetdes[0].$getmetdes[1].$getmetdes[2].$getmetdes[3].".";
				elseif(sizeof($getmetdes) >= 3)
				$getmetdes = $getmetdes[0].$getmetdes[1].$getmetdes[2].".";
				elseif(sizeof($getmetdes) >= 2)
				$getmetdes = $getmetdes[0].$getmetdes[1].".";
				elseif(sizeof($getmetdes) >= 1)
				$getmetdes = $getmetdes[0].".";
				else
				$getmetdes = $getmetdes[0];

				$product->setmeta_keyword(htmlspecialchars_decode($metakey,ENT_QUOTES));
				$product->setmeta_description(htmlspecialchars_decode($getmetdes,ENT_QUOTES));
				$updatename = $productnameupdate;
				$product->setName($updatename);
				
								
				$product->setupc("$content->UPC");
				
				$description = str_replace($search, $values, $productdes);
				$product->setShortDescription(htmlspecialchars_decode($getmetdes,ENT_QUOTES));
				$product->setDescription(htmlspecialchars_decode($description,ENT_QUOTES));
				
				$productspecs = explode("|",$content->Specifications);
				$pspeclength = sizeof($productspecs);
				$productsp = "<ul>";
				foreach($productspecs as $values)
				$productsp.="<li>".$values."</li>";
				
				$productsp.= "<li>Dimensions: ".$content->p_length."&#34; L x ".$content->p_width."&#34; W x ".$content->p_height."&#34; H</li>";
				$productsp.= "<li>Weight: ".$content->Weight." Pounds</li>";
				
				$productsp.= "<li>Shipping Dimensions: ".$content->s_p_width."&#34; W x ".$content->s_p_height."&#34; H</li>";
				$productsp.= "<li>Shipping Weight: ".$content->Weight." Pounds</li>";
				$productsp.="</ul>";
				


				$productspr = str_replace($search, $values, $productsp);
				$productsp = str_replace("’","&#39;",$productsp);
				$product->setspec001(htmlspecialchars_decode($productsp,ENT_QUOTES));
				
				// add attributes
				if($content->refridgerator != "")
				{
echo "coming";
				$product->setrefridgerator("$content->refridgerator");
				}
				if($content->stove_type != "")
				{
				$product->setstove_type("$content->stove_type");
				}
				if($content->washer_dryer != "")
				{
				$product->setwasher_dryer("$content->washer_dryer");
				}
				// add attributes ends
				$product->setPrice($content->retail);
				$product->setcost($content->cost);
				$packingweight = $content->s_p_weight;
				$product->setweight($packingweight);
				
				// get shipping starts
				$shippingrate = $content->shipping;
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
				$imageentry = $mysqli->query("UPDATE `direct_samsung_products` SET `status`='2' WHERE `SKU`='$sku'");
				echo "Import Done".$sku;

				$j=$j+1;

if($j==50)
exit;
sleep(20);
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