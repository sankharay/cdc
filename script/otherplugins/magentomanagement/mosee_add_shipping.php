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
			$contents = mysql_query("SELECT * FROM `direct_mosse_addshipping_1stfile` where status='1'") ;
			while($content = mysql_fetch_object($contents))
			{ 
			$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
			if($product_id)
			{
			$sku = $content->sku;
			$product = Mage::getModel('catalog/product');
		    $product ->load($product_id);
			// shipping correction start
			 $productweight = $product->getweight();
			 $shippingcharges = getshipping($productweight);
			 $product->setshprate($shippingcharges);
			 // shipping update
			 
			 // get specification for update
			 $specification = $product->getspec001();
			 $newspeci = str_replace('Dimensions','Shipping Dimensions',$specification);
			 $newspeci = str_replace('Weight','Shipping Weight',$newspeci);
			 $speciwithdesc = $newspeci."<br> <br> <div id='detail_shipping'>*Not intended for commercial use. Curacao® is not responsible for the improper use of licensed costumes.</div>";
			 
			
			 $product_specs = str_replace($search, $values, $speciwithdesc);
			 $product->setspec001(htmlspecialchars_decode($product_specs,ENT_QUOTES));
			 
			 
			 // get specification for update
 			try {
				
				$product->save();
				$processingdone = mysql_query("update `direct_mosse_addshipping_1stfile` SET status=2 WHERE sku='$content->sku'");
				echo $sku."<br>";

			}
			catch (Exception $ex) {
				echo $ex->getMessage();
			}

			}
			else
			{
			echo "product sku not there".$content->sku."<br>";
			}

			}
	}
	else
	{
	// fpl not exist so no result
	exit;
	}
	
	
?>