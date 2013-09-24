<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = 208;
	require_once(MAGE_FILE_URL_DEMO);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
			Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        	$products = Mage::getModel('catalog/product')
    ->getCollection()
    ->addAttributeToSelect('*')
    ->addAttributeToFilter(array(
        array (
            'attribute' => 'image',
            'like' => 'no_selection'
        ),
        array (
            'attribute' => 'image', // null fields
            'null' => true
        ),
        array (
            'attribute' => 'image', // empty, but not null
            'eq' => ''
        ),
        array (
            'attribute' => 'image', // check for information that doesn't conform to Magento's formatting
            'nlike' => '%/%/%'
        ),
    ));
			foreach($products as $product)
{
    $data[] = array("Product Sku"=>$product->getSku(),"Product UPC"=>$product->getUPC(),"Product Name"=>$product->getname());
	echo  $product->getSku() . " has no image \n<br />\n";
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