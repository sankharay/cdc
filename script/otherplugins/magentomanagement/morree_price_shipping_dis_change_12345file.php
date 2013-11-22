<?php
	ini_set('display_errors',1);
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

			// removing special Character data strt
			$list = get_html_translation_table(HTML_ENTITIES);
			unset($list['"']);
			unset($list['<']);
			unset($list['>']);
			unset($list['&']);		
			$search = array_keys($list);
			$values = array_values($list);
			// removing special Character data end

	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = mysql_query("SELECT * FROM `direct_mosse_pricechange1234_file` where status='1'") ;
			while($content = mysql_fetch_object($contents))
			{ 
        	// $magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$content->SKU);
			$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->SKU));
			if($product_id)
			{
			$sku = $content->SKU;

			// add new product
			$product = Mage::getModel('catalog/product');
		    $product->load($product_id);


			// set retail price
			$retailprice = floatval($content->Cost)*2;
			$retailprice = ceil($retailprice);
			$retailprice = $retailprice - 0.01;			
			$product->setPrice($retailprice);
			// set retail price again

			// set shipping rate
			$packingweight = ceil($content->Weight);
			$shippingrate = getshipping($packingweight);
			$product->setshprate($shippingrate);
			// set shipping rate
			
			// reset disclaimer
			if($content->Size != "")
			{
			$productspecs = "<ul><li>Size: ".$content->Size."</li><li>Shipping Dimensions: ".$content->Dimensions_Height." H x ".$content->Dimensions_Width." W x ".$content->Dimensions_Depth." L </li><li>Shipping Weight: ".ceil($content->Weight)." Pound</li></ul><br> <br> <div id='detail_shipping'>*Not intended for commercial use. Curacao® is not responsible for the improper use of licensed costumes.</div>";
			$productspecs = htmlspecialchars($productspecs);
			}
			else
			{
			$productspecs = "<ul><li>Shipping Dimensions: ".$content->Dimensions_Height." H x ".$content->Dimensions_Width." W x ".$content->Dimensions_Depth." L </li><li>Shipping Weight: ".ceil($content->Weight)." Pound</li></ul><br><br> <div id='detail_shipping'>*Not intended for commercial use. Curacao® is not responsible for the improper use of licensed costumes.</div>";
			$productspecs = htmlspecialchars($productspecs);
			}
			 $product_specs = str_replace($search, $values, $productspecs);
			 $product->setspec001(htmlspecialchars_decode($productspecs,ENT_QUOTES));
			// reset disclaimer
			// set vendor id
			$product->setvendorid($content->source);
			// set vendor id

 			try {
				
				$product->save();
				$processingdone = mysql_query("update `direct_mosse_pricechange1234_file` SET status=2 WHERE sku='$content->SKU'");
				echo $sku."<br>";

			}
			catch (Exception $ex) {
				echo $ex->getMessage();
			}

			}
			else
			{
			echo "product sku not there".$content->SKU."<br>";
				$processingdone = mysql_query("update `direct_mosse_pricechange1234_file` SET `notfound`= 1,status=2 WHERE sku='$content->SKU'");
			}
			}
	}
	else
	{
	// fpl not exist so no result
	exit;
	}
	
	
?>