<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$result = TRUE;
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL."/app/Mage.php");
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = get_mossee_data();
			while($content = mysql_fetch_object($contents))
			{
        	$magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',trim($content->SKU));
			if($magentoproductIds)
			{
			echo "product already there";	
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
						if(file_get_contents(trim($img[$i]))){	
							$from = $img[$i];
							$image = IMAGES_MAGENTO_LOCATION_URL.str_replace('/','_',$sku).'_'.$i.'.jpg';
							if(!@copy($from,$image))
							{
								$errors= error_get_last();
								echo $errors['message'];
							
							} else {
														
								$product->addImageToMediaGallery ($image, array('image','small_image','thumbnail'), false, false); 
							}
							/*$url = trim($img[$i]);
							$image = 'media/images/'.str_replace('/','_',$sku).'_'.$i.'.jpg';
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
			 $categories = explode(',',$content->category_tree);
			 $product->setCategoryIds($categories);
			 
			
			 
			$product->setSku($content->SKU);
			$product->setupc($content->UPC);
			$product->setMeta_title($content->Product_Name);
			 
			$newurl = htmlspecialchars_decode($content->Product_Name,ENT_QUOTES);
			$creaturl = cleaningdata($newurl);
			$strlower = strtolower($creaturl);
			$url = str_replace(" ","-",$strlower);
			$url = $url.".html";
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
			$product->settv_brand($content->Brand);
			$product->setvendorid($content->source);

$productspecs = "<ul><li>Size:".$content->Size."</li><li>Dimensions:".$content->Dimensions_Height." H x ".$content->Dimensions_Width." W x ".$content->Dimensions_Depth." L </li><li>Weight:".$content->Weight." Pounds</li></ul>";
$productspecs = htmlspecialchars($productspecs);
exit;
			 $product_specs = str_replace($search, $values, $productspecs);
			 $product->setspec001(htmlspecialchars_decode($productspecs,ENT_QUOTES));
			 
			 $newlink = "<iframe width='560' height='315' src=".$content->Video_Link." frameborder='0' allowfullscreen></iframe>";
			 
			 
			 
			 $eng_video = str_replace($search, $values, $newlink);
			 $product->setproductvideo(htmlspecialchars_decode($eng_video,ENT_QUOTES));
			 
			 $retailprice = floatval($product->price)*2;
			$dropship = "5.50";
			$retailprice = ceil($retailprice+$dropship);
			$retailprice = $retailprice - 0.1;
			 
			 $product->setPrice($retailprice);
			 $product->setcost($content->Cost);
			 $product->setweight(ceil($content->Weight));
			 
			 if($content->Inventory == "")
			 $stock=0;
			 else
			 $stock=$content->Inventory;
			 
			 $product->setStockData(array('is_in_stock' => 1, 'qty' => $stock));
			 $product->setstatus("1");


 			try {
				
				$product->save();
				// $processingdone = final_stage_done($fpl_id);
				echo "Import Done";	
			}
			catch (Exception $ex) {
				echo $ex->getMessage();
			}
			}
	}
			}
	else
	{
	exit;
	}
	
	
?>