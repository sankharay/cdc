<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');

		$myquery = mysql_query("UPDATE `direct_mosse_products` SET `status`='5' WHERE `Image_path`='http://icuracao.com/cdc/script/uploadedfiles/images/mosseimages/fw112591t.jpg'");
exit;

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


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = get_mossee_data_puretext();

			while($content = mysql_fetch_object($contents))
			{
			echo $content->SKU."<br>";

        	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->SKU));
			if($product_id)
			{
			// set URL key start

			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
		
			
			
			$spec001 = $product->getspec001();
			$spec001pure = str_replace("{--text--}","",$spec001);
			$product->setspec001($spec001pure);
			
			 // try to save start
			 try {
				$product->save();
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
			}
			 // try to save ends

			}
			else
			{
			echo $content->sku." Not Found<br>";
			}

			}
			}
?>