<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$vendor_id = $_GET['vendorid'];
	$result = true;
	
	if($result == TRUE)
	{
			$getvendortemp = get_vendor_templates($vendor_id);
			$template = $getvendortemp->template_dbstructure;
			$dataexport = array_filter(explode(",",$getvendortemp->template_dbstructure));
			$sizeofarray = sizeof($dataexport);
			$magentoarray = array (
						'product_sku' =>'sku',
						'product_cost' =>'price',
						'product_retail' =>'price',
						'specialprice' =>'special_price',
						'specialfromdate' =>'special_from_date',
						'specialtodate' =>'special_to_date',
						'product_metatags' =>'meta_keyword',
						'eng_video' =>'productvideo',
						'product_specs' =>'product_specs'
									);
									
			$contents = getapi_updates();
			
// magento functions starts

	require_once(MAGE_FILE_URL.'/app/MAGE.php');
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
    $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	

// magento functions ends
			
while($contentsrow = mysql_fetch_array($contents))
{
$data = array_filter($contentsrow);
$sku = $contentsrow['product_sku'];
$product_id = Mage::getModel('catalog/product')->getIdBySku($sku);
			if($product_id)
			{
					echo "Inside";
					$product = Mage::getModel('catalog/product');
					$product->load($product_id);
					

					
					for($i=0;$i<=$sizeofarray;$i++)
					{
					if($dataexport[$i] == "product_inventory_level")
					{
					$stockData = $product->getStockData();
					$stockData['qty'] = $contentsrow[$dataexport[$i]];
					$stockData['is_in_stock'] = 1;
					$product->setStockData($stockData);	
					}
					else
					{
					$setdata = $magentoarray[$dataexport[$i]];
					$vass = 'set'."$setdata";
					$realvalue = $contentsrow[$dataexport[$i]];
					call_user_func_array(array($product, "$vass"), array("$realvalue"));
					}
					$product->save();
					}

			}
			else
			{
			echo "product not found";	
			}
exit;
}
}
?>