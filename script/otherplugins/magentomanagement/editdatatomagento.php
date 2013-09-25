<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$fpl_id = $_GET['fpl_id'];
	$result = check_fpl_id_exist($fpl_id);
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL_DEMO);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
			Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$content = get_english_data($fpl_id);

        	$product_id = Mage::getModel('catalog/product')->getIdBySku($content->product_sku);

			if($product_id)
			{
			$product = new Mage_Catalog_Model_Product();
			$product = Mage::getModel('catalog/product');
			
			 $product ->load($product_id);
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
			// subattribute seting ends in magento 
			 $sku = $content->product_sku;
			 $product->setSku($content->product_sku);
			 $product->setupc($content->product_upc);
			 $product->setMeta_title($content->prduct_name);
			 $product->setorig_name($content->prduct_name);
			 $product->setshprate($content->shippingprice);
			 $product->setmeta_keyword($content->product_metatags);
			 $product->setmeta_description($content->product_metatags);
			 $product->setspecial_price($content->specialprice);
			 $product->setspecial_from_date($content->specialfromdate);
			 $product->setspecial_to_date($content->specialtodate);
			 $product->setName($content->prduct_name);
			 $product->setShortDescription($content->short_description);
			 $product->setDescription($content->product_description);
			 $product->setspec001($content->product_specs);
			 $product->setproductvideo($content->eng_video);
			 $product->setPrice($content->product_retail);
			 $product->setcost($content->product_cost);
			 $product->setweight($content->weight);
			 $product->setStockData(array('is_in_stock' => 1, 'qty' => 10));
			 $product->setstatus("1");
			 // print_r($product);
			 // exit;
			// assign product to the default website
 			try {
				
				 $product->getResource()->save($product); 
				$processingdone = final_stage_done($fpl_id);
				// start adding addons
			/*	$productaddonId = array();
				$allsku = productaddons($content->addons);
				$allskusize = sizeof($allsku);
				$product = Mage::getModel('catalog/product');
				for($vv=0;$vv<$allskusize;$vv++)
				{
				$productaddonId = $product->getIdBySku($allsku[$vv]);
				$add[$productaddonId] = array('position'=>$vv+1);
				}
				$product->setRelatedLinkData($add); */
				// ends adding addons
				echo "1";	
			}
			catch (Exception $ex) {
				echo $ex->getMessage();
			}	

			// spanish send start 

			$product = Mage::getModel('catalog/product');
			$productId = $product->getIdBySku($sku);
			$contents = get_spanish_data($fpl_id);
			if ($productId) {
				$product->setStoreId(3)->load($productId);
				$product->setName(htmlspecialchars($contents->prduct_name));
				$product->setshort_description(htmlspecialchars($contents->short_description));
				$product->setdescription(htmlspecialchars($contents->product_description));
				$product->setspec001(htmlspecialchars($contents->product_specs));
			 	$product->setproductvideo(htmlspecialchars($contents->spanish_video));
				 $product->getResource()->save($product); 
			}	
			}
			else
			{
			echo "This Product not exist in Magento";

			// $categorys = explode('_',$content->product_category);
			}
	}
	else
	{
	// fpl not exist so no result
	exit;
	}
	
	
?>

