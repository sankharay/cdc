<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	// $fpl_id = $_GET['fpl_id'];
	include(PLUGINS_URL.'/excelreader/reader.php');
	$result = true;
	
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	
	function senddatatodb($file)
	{
		$dbdataarray = array();
		$skudup = array();
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
			$tabelfields = array (
						'1' => 'sku',
						'2' => 'upc',
						'3' => 'cost',
						'4' => 'retail',
						'5' => 'specialprice',
						'6' => 'fromspecial',
						'7' => 'tospecial',
						'8' => 'metakeywords',
						'9' => 'qty',
						'10' => 'cat'
									);
			for($i=2;$i<=$numrows;$i++){
				$dbdataarray = array();
			for($j=0;$j<11;$j++){
				if(isset($excel->sheets[0]['cells'][$i][$j]))
		   		$dbdataarray[$tabelfields[$j]] = htmlspecialchars($excel->sheets[0]['cells'][$i][$j]);
				}
				$datasku = trim($dbdataarray['sku']);
				// check sku in add related table
				$skuinaddrelated = checkin_addrelated($datasku);				
				// check sku in add related table
				$datasend = firetomagento($dbdataarray);
			}
	}
	
	function firetomagento($dbdataarray)
	{

			$product_id = Mage::getModel('catalog/product')->getIdBySku($dbdataarray['sku']);
			if($product_id)
			{
			// set URL key start
			$product = Mage::getModel('catalog/product');
			$product ->load($product_id);
			if($dbdataarray['qty'] != "~")
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = $dbdataarray['qty'];
			$stockData['is_in_stock'] = 1;
			
			$product->setStockData($stockData);
			}
			// other updates start
			if($dbdataarray['cat'] != "~")
			{
			$cat = $product->getCategoryIds();
			$cat[] = $dbdataarray['cat'];
			$product->setCategoryIds($cat);
			}
			if($dbdataarray['cost'] != "~")
			$product->setcost($dbdataarray['cost']);
			if($dbdataarray['retail'] != "~")
			 $product->setPrice($dbdataarray['retail']);
			if($dbdataarray['specialprice'] != "~")
			 $product->setspecial_price($dbdataarray['specialprice']);

			if($dbdataarray['fromspecial'] != "~")
			{
			 $fromdate = date('m/d/Y', strtotime($dbdataarray['fromspecial']));
			 $product->setspecial_from_date($dbdataarray['fromspecial']);
			}

			if($dbdataarray['tospecial'] != "~")
			{
			 $todate = date('mm/dd/yyyy', strtotime($dbdataarray['tospecial']));
			 $product->setspecial_to_date($dbdataarray['tospecial']);
			}
			if($dbdataarray['metakeywords'] != "~")
			{
			$metainfo = $product->getmeta_keyword();
			$newmeta = $metainfo." ".$dbdataarray['metakeywords'];
			$product->setmeta_keyword($newmeta);
			}
			// other updates ends
			
			 // try to save start
			 try {
				$product->save();
				return TRUE;
			 	} catch (Exception $ex) {
				// echo $ex->getMessage();
				return FALSE;
			}
			 // try to save ends
			}
			else
			{
			echo "No need to do anything";
			}
	}
	
	$filename = getfilename($_GET['fileid']);
	if($filename->filename)
	$updatemagengtoquantity = senddatatodb($filename->filename);
	else
	exit;
	// $updatemagengtoquantity = senddatatodb($filename);
	
	
echo "Data Updated";

?>