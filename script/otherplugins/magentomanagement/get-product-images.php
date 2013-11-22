<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	$result = true;
	
	// removing special Character data strt
			$list = get_html_translation_table(HTML_ENTITIES);
			unset($list['"']);
			unset($list['<']);
			unset($list['>']);
			unset($list['&']);		
			$search = array_keys($list);
			$values = array_values($list);
			// removing special Character data end
	
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);

$data = array();

	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);


			$contents = mysql_query("select * from direct_mossee_img_find");
			while($content = mysql_fetch_object($contents))
			{

        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
			if($product_id)
			{
			// set URL key start
			$filedata = "";
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
		
			$mediaApi = Mage::getModel("catalog/product_attribute_media_api");
			$mediaApiItems = $mediaApi->items($product_id);
			foreach($mediaApiItems as $item) {
				$filedata.= "https://www.icuracao.com/media/catalog/product/".$item['file'].",";
			}
			$data[] = array("Product Sku"=>$product->getSku(),"Product Images"=>$filedata);
			}
			}
			}
				

if(!isset($data))
$data[] = array("Result"=>"Nothing Found");

$filename = "no_image_products.xls";
	
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  header("Content-Type: application/vnd.ms-excel");

$flag = false;
	  foreach($data as $row) {
	
		if(!$flag) {
		  // display field/column names as first row
		  echo implode("\t", array_keys($row)) . "\r\n";
		  $flag = true;
		}
	   // array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\r\n";
	  }
	
	
	exit;

			
			
?>