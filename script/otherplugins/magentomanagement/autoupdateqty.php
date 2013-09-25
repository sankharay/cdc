<?php
	set_time_limit(0);
	ini_set('memory_limit','1024M');
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');
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
    $currentStore = Mage::app()->getStore()->getId();
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
		   		$dbdataarray[$tabelfields[$j]] = trim(htmlspecialchars($excel->sheets[0]['cells'][$i][$j]));
				}
				// check sku in add related table
				$datasku = trim($dbdataarray['sku']);
				// $skuinaddrelated = checkin_addrelated($datasku);				
				// check sku in add related table
				// if($skuinaddrelated == TRUE)
				$datasend = firetomagento($dbdataarray);
			}
	}
	
			function firetomagento($dbdataarray)
				{
			$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($dbdataarray['sku']));
			if($product_id)
			{
			// set URL key start
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
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
			if($dbdataarray['retail'] != "~" AND $dbdataarray['retail'] != "")
			 $product->setPrice($dbdataarray['retail']);
			if($dbdataarray['specialprice'] != "~")
			 $product->setspecial_price($dbdataarray['specialprice']);

			if($dbdataarray['fromspecial'] != "~")
			{
			 $fromdate = date('mm/dd/yyyy', strtotime($dbdataarray['fromspecial']));
			 $product->setspecial_from_date($dbdataarray['fromspecial']);
			 $product->setSpecialFromDateIsFormated(true);
			}

			if($dbdataarray['tospecial'] != "~")
			{
			 $todate = date('mm/dd/yyyy', strtotime($dbdataarray['tospecial']));
			 $product->setspecial_to_date($dbdataarray['tospecial']);
			 $product->setSpecialToDateIsFormated(true);
			}
			if($dbdataarray['metakeywords'] != "~")
			{
			$metainfo = $product->getmeta_keyword();
			$newmeta = $metainfo." ".$dbdataarray['metakeywords'];
			$product->setmeta_keyword($newmeta);
			}
			if($dbdataarray['qty'] != "~" AND $dbdataarray['qty'] != "")
			{
			$stockData = $product->getStockData();
			$stockData['qty'] = $dbdataarray['qty'];
			$stockData['is_in_stock'] = 1;
			
			$product->setStockData($stockData);
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
			echo "<br>".$dbdataarray['sku']." - Sku's not found";
			}
	}
	
	$filename = getfilename($_GET['fileid']);
	if($filename->filename)
{
	$updatemagengtoquantity = senddatatodb($filename->filename);
	// echo "1";
	echo "<br>Sku's update done";
?>
<script>
alert("SKU updated in Magento");
</script>
<?php
}
	else
{
	exit;
}
	// $updatemagengtoquantity = senddatatodb($filename);

?>