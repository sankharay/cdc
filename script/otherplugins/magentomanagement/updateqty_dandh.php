<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	$result = true;
	
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	$que = 1;

	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = get_qty_data_api_dandh();

			while($content = mysql_fetch_object($contents))
			{
			if(($que % 100) == 0)
			sleep(900);

        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
			if($product_id)
			{
			// set URL key start
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			// inventry data update start
			if(is_numeric($content->qty) AND $content->qty != "~" AND $content->qty != "")
			{
			if($content->qty > 0)
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = $content->qty;
			$stockData['is_in_stock'] = 1;
			$product->setVisibility(4);
			$product->setStatus(1);
			}
			else
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = "0";
			$stockData['is_in_stock'] = 0;
			$product->setVisibility(1);
			$product->setStatus(2);
			}
			$product->setStockData($stockData);
			}
			// inventry data update ends
			if($content->cat != "~" AND $content->cat != "")
			{
			$cat = $product->getCategoryIds();
			// check is this is contain more categories of not
			$findcat = explode('_',$content->cat);
			$catsize = sizeof($findcat);
			if($catsize > 1)
			{
			for($f=0;$f<$catsize;$f++)
			$cat[] = $findcat[$f];
			$cat = array_filter($cat);
			}
			else
			$cat[] = $content->cat;
			$product->setCategoryIds($cat);
			}
			if($content->cost != "~" AND $content->cost != "")
			$product->setcost($content->cost);
			
			if($content->retail != "~" AND $content->retail != "")
			 $product->setPrice($content->retail);
			 
			if($content->specialprice != "~" AND $content->specialprice != "")
			 $product->setspecial_price($content->specialprice);

			if($content->fromdate != "~" AND $content->fromdate != "")
			{
			 $fromdate = date('mm/dd/yyyy', strtotime($content->fromdate));
			 $product->setspecial_from_date($content->fromdate);
			 $product->setSpecialFromDateIsFormated(true);
			}
			if($content->todate != "~" AND $content->todate != "")
			{
			 $todate = date('mm/dd/yyyy', strtotime($content->todate));
			 $product->setspecial_to_date($content->todate);
			 $product->setSpecialToDateIsFormated(true);
			}
			if($content->metainfo != "~" AND $content->metainfo != "")
			{
			$metainfo = $product->getmeta_keyword();
			$newmeta = $metainfo." ".$content->metainfo;
			$product->setmeta_keyword($newmeta);
			}
			 // try to save start
			 try {
				$product->save();
				$dataprocessed = updatedatainventryid($content->sku);
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends

			}
			else
			{
			echo $content->sku." Not Found<br>";
			}
$que = $que+1;
echo "SKU -  ".$content->sku." Updated<br>";
			}
			echo "All Sku's Updated";
			}
?>