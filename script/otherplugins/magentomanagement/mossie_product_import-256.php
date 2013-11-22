<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
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
			$contents = mysql_query("SELECT * FROM `direct_mosse_products_256` WHERE `status`=1");
			while($content = mysql_fetch_object($contents))
			{
        	$magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',trim($content->SKU));
			if($magentoproductIds)
			{
			$productalready_there = mysql_query("UPDATE `direct_mosse_products_256` SET `status`='3' WHERE `SKU`='$content->SKU'");
			echo "product already there".$content->SKU."<br>";	
			}
			else
			{
			
			$sku = $content->SKU;
				
			// removing special Character data strt
			$list = get_html_translation_table(HTML_ENTITIES);
			unset($list['"']);
			unset($list['<']);
			unset($list['>']);
			unset($list['&']);		
			$search = array_keys($list);
			$values = array_values($list);
			// removing special Character data end
			// add new product
			$product = new Mage_Catalog_Model_Product();
			// images section starts
			
			$img = explode(',',$content->Image_path);
			
			for($i=0;$i<sizeof($img);$i++){
			if(trim($img[$i]) != ''){
					
					//if(file_exists(trim($img[$i]))){
					//echo 'here';
						if(!@file_get_contents($img[$i])){
							$noimageentry = mysql_query("UPDATE `direct_mosse_products_256` SET `spanish_Product_Name`='5' WHERE `SKU`='$content->SKU'");

						}
						else
						{
							$from = $img[$i];
							$urlimg = rand(1,2000);
							echo $image = IMAGES_MAGENTO_LOCATION_URL.str_replace('/','_',$sku).'_'.$urlimg.'.jpg';
							if(!@copy($from,$image))
							{
								$errors= error_get_last();
								echo $errors['message'];
								exit;
							
							} else {
														
								$product->addImageToMediaGallery ($image, array('image','small_image','thumbnail'), false, false); 
							}
							/*$url = trim($img[$i]);
							$urlkey = rand(2,1000);
							$image = 'media/images/'.str_replace('/','_',$sku).'_'.$urlkey.'.jpg';
							file_put_contents($image, file_get_contents($url));*/
							
						//}
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
			 $categories = explode('_',$content->category_tree);
			 $product->setCategoryIds($categories);
			 
			
			 
			$product->setSku(trim($content->SKU));
			$product->setupc($content->UPC);
			$product->setMeta_title($content->Product_Name);
			 
			$newurl = htmlspecialchars_decode($content->Product_Name,ENT_QUOTES);
			$creaturl = cleaningdata($newurl);
			$strlower = strtolower($creaturl);
			$url = str_replace(" ","-",$strlower);
			$url = $url."-4.html";
			$url = checkurlstatus($url);
			$url = str_replace(".html","","$url");

			$product->seturl_key($url);
			$product->setorig_name($content->Product_Name);
			// $product->setshprate($content->shippingprice);
			$product->setmeta_keyword(htmlspecialchars_decode($content->Meta_tags,ENT_QUOTES));
			$product->setmeta_description(htmlspecialchars_decode($content->Product_Description,ENT_QUOTES));
			$product->setName($content->Product_Name);
			$short_description = str_replace($search, $values, $content->Product_Description);
			$product->setShortDescription(htmlspecialchars_decode($short_description,ENT_QUOTES));
			$product_description = str_replace($search, $values, $content->Product_Description);
			$product->setDescription(htmlspecialchars_decode($product_description,ENT_QUOTES));
			// $product->settv_brand($content->Brand);
			$product->setvendorid($content->source);
if($content->Size != "")
{
$productspecs = "<ul><li>Size: ".$content->Size."</li><li>Shipping Dimensions: ".$content->Dimensions_Height." H x ".$content->Dimensions_Width." W x ".$content->Dimensions_Depth." L </li><li>Shipping Weight: ".ceil($content->Weight)." Pounds</li></ul><br> <br> <div id='detail_shipping'>*Not intended for commercial use. Curacao® is not responsible for the improper use of licensed costumes.</div>";
$productspecs = htmlspecialchars($productspecs);
}
else
{
$productspecs = "<ul><li>Shipping Dimensions: ".$content->Dimensions_Height." H x ".$content->Dimensions_Width." W x ".$content->Dimensions_Depth." L </li><li>Shipping Weight: ".ceil($content->Weight)." Pounds</li></ul><br><br> <div id='detail_shipping'>*Not intended for commercial use. Curacao® is not responsible for the improper use of licensed costumes.</div>";
$productspecs = htmlspecialchars($productspecs);
}

			 $product_specs = str_replace($search, $values, $productspecs);
			 $product->setspec001(htmlspecialchars_decode($product_specs,ENT_QUOTES));
			 

			if($content->Video_Link != "")
			{
			 $newlink = '<iframe width="560" height="315" src="'.$content->Video_Link.'" frameborder="0" allowfullscreen></iframe>';
			 $eng_video = str_replace($search, $values, $newlink);
			 // $product->setproductvideo(htmlspecialchars_decode($eng_video,ENT_QUOTES));
			}

			 
			$retailprice = floatval($content->Cost)*2;
			$dropship = "0";
			$retailprice = ceil($retailprice+$dropship);
			$retailprice = $retailprice - 0.01;
			 
			 $product->setPrice($retailprice);


			 $product->setcost($content->Cost);
			 $packingweight = ceil($content->Weight);
			 $product->setweight($packingweight);
			 
			 // get shipping starts
			 $shippingrate = getshipping($packingweight);
			 $product->setshprate($shippingrate);	 
			 // get shipping ends
			 
			 if($content->Inventory == "")
			 $stock=0;
			 else
			 $stock=$content->Inventory;
			 
			 $product->setStockData(array('is_in_stock' => 1, 'qty' => $stock));
			 $product->setstatus("1");
			 $product->setonline_only("1");

 			try {
				
				$product->save();
				$updateproduct_successfully = mysql_query("UPDATE `direct_mosse_products_256` SET `status`='2' WHERE `SKU`='$content->SKU'");
				echo "Import Done".$sku;

			}
			catch (Exception $ex) {
				echo $ex->getMessage();
			}
// sleep(3);


			}
	}
			}
	else
	{
	exit;
	}
	
	
?>