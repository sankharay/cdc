<?php
	ini_set('max_execution_time', 0);
	ini_set('display_errors', 1);
	ini_set("memory_limit","1024M");
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
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
			$contents = get_staging_data();
			while($content = mysql_fetch_object($contents))
			{
				$fpl_id = $content->fpl_id;
        	$magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$content->product_sku);
			if($magentoproductIds)
			{
			echo "product already there";	
			// product already there ends	
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
				// add new product
				$product = new Mage_Catalog_Model_Product();
				// images section starts
				$imagesdata = get_img_name($fpl_id);
				$getnumimages = sizeof($imagesdata);
				for($i=0;$i<$getnumimages;$i++)
				$product->addImageToMediaGallery ($imagesdata[$i], array('image','small_image','thumbnail'), false, false);
				// images section ends		
				$product->setTypeID("simple");
				$product->setVisibility(4);
				$product->setStatus(1);
				$product->setWebsiteIds(array(1));
				$product->setStoreIds(array(1));
				$product->setAttributeSetId(4);
				$product->setTaxClassId(2);
				$categories = get_categories($fpl_id);
				$product->setCategoryIds($categories);
				
				// subattribute seting starts in magento
				if($content->attributes != "")
				{
				$subattsrting=$content->attributes;
				$data = explode(')(',$subattsrting);
				$size = sizeof($data);
				for($i=0;$i<$size;$i++)
				{
				$value = str_replace(')','',$data[$i]);
				$value1= str_replace('(','',$value);
				$datas = explode('-',$value1);
				$setdata = get_attributes($datas[0]);
				$setvalue = $datas[1];
				if(strchr($setvalue,","))
				{
				$arraysetvalue = explode(',',$setvalue);
				$e = $setdata."(".$arraysetvalue.")";
				$vass = 'set'."$setdata";
				call_user_func_array(array($product, "$vass"), array("$setvalue"));
				}
				else
				{
				// $product->settv_screen_size( 18);
				$e=$setdata."(".$setvalue.")";
				// echo '$product->set'."$e";
				$vass = 'set'."$setdata";
				// call_user_func($vass, $setvalue);
				call_user_func_array(array($product, "$vass"), array("$setvalue"));
				}
				}
				}
				// subattribute seting ends in magento
				if($content->product_inventory_level == "")
				$stock=0;
				else
				$stock=$content->product_inventory_level;
				$sku = $content->product_sku;
				$product->setSku($content->product_sku);
				$product->setupc($content->product_upc);
				$product->setMeta_title($content->prduct_name);
				
				
				$newurl = htmlspecialchars_decode($content->prduct_name,ENT_QUOTES);
				$creaturl = cleaningdata($newurl);
				$strlower = strtolower($creaturl);
				$url = str_replace(" ","-",$strlower);
				$url = $url.".html";
				$url = checkurlstatus($url);
				$url = str_replace(".html","","$url");
				
				$product->seturl_key($url);
				$product->setorig_name($content->prduct_name);
				$product->setshprate($content->shippingprice);
				$product->setmeta_keyword(htmlspecialchars_decode($content->product_metatags,ENT_QUOTES));
				$product->setmeta_description(htmlspecialchars_decode($content->product_metadescription,ENT_QUOTES));
				$product->setspecial_price($content->specialprice);
				$product->setspecial_from_date($content->specialfromdate);
				$product->setspecial_to_date($content->specialtodate);
				$product->setName($content->prduct_name);
				$short_description = str_replace($search, $values, $content->short_description);
				$product->setShortDescription(htmlspecialchars_decode($short_description,ENT_QUOTES));
				$product_description = str_replace($search, $values, $content->product_description);
				$product->setDescription(htmlspecialchars_decode($product_description,ENT_QUOTES));
				$product->settv_brand($content->product_brand);
				$product->setvendorid($content->product_source);
				$product_specs = str_replace($search, $values, $content->product_specs);
				$product->setspec001(htmlspecialchars_decode($product_specs,ENT_QUOTES));
				$eng_video = str_replace($search, $values, $content->eng_video);
				$product->setproductvideo(htmlspecialchars_decode($eng_video,ENT_QUOTES));
				$product->setPrice($content->product_retail);
				$product->setcost($content->product_cost);
				$product->setweight($content->weight);
				$product->setStockData(array('is_in_stock' => 1, 'qty' => $stock));
				$product->setstatus("1");
				
				
				
				// print_r($product);
				// exit;
				// assign product to the default website
				try {
				
				$product->save();
				$processingdone = final_stage_done($fpl_id);
				// start adding addons
				
				
				// add product to local table for addons starts
				$productId = Mage::getModel('catalog/product')->getIdBySku($sku);
				$contentdatarelated  = addrelatedcontent($categories,$productId,$content->prduct_name,$sku,$content->product_upc,$content->product_retail);
				// add product to local table for addons ends
				
				if($content->addons != "")
				{
				$product = Mage::getModel('catalog/product');
				$productId = $product->getIdBySku($sku);
				$product->load($productId);
				$productaddonId = array();
				$allsku = explode("_",$content->addons);
				$allskuva = array_values(array_filter($allsku));
				$allskusize = sizeof($allskuva);
				for($vv=0;$vv<$allskusize;$vv++)
				{
				$productaddonId = $allskuva[$vv];
				$add[$productaddonId] = array('position'=>$vv+1);
				}
				print_r($add);
				$product->setRelatedLinkData($add);
				$product->save();
				// $product->setUpSellLinkData($add);
				// $product->setCrossSellLinkData($add);
				}
				
				
				
				// ends adding addons
				echo "1";	
				}
				catch (Exception $ex) {
				echo $ex->getMessage();
				}		
			}
			}
	}
	else
	{
	// fpl not exist so no result
	exit;
	}
	
?>