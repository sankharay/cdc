<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');

	require_once(MAGE_FILE_URL_STAGING);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	$productsku = $_GET['sku'];
	if($productsku == "")
	exit;
	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
			Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			// $content = get_english_data($fpl_id);
			
			
			
        	$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$productsku);
			if($product->getId())
			{
			echo $productgetSku = $product->getSku();
			$finaltableid = update_finaltable_data($product);
			}
			else
			{
			echo $product->getSku()." - Sku Insert Not Done";
			}
			
			function update_finaltable_data($product)
			{// removing special Character data strt
			$list = get_html_translation_table(HTML_ENTITIES);
			unset($list['"']);
			unset($list['<']);
			unset($list['>']);
			unset($list['&']);		
			$search = array_keys($list);
			$values = array_values($list);
			$productgetSku = $product->getSku();	
			$productname = str_replace("'","&#39;",htmlspecialchars($product->getName()));
			$productescription = str_replace("'","&#39;",htmlspecialchars($product->getShortDescription()));
			$productgetDescription = str_replace("'","&#39;",htmlspecialchars($product->getDescription()));
			$productgetspec001 = str_replace("'","&#39;",htmlspecialchars($product->getspec001()));
		
			mysql_query("UPDATE `finalproductlist` SET `prduct_name`='$productname',`short_description`='$productescription',`product_description`='$productgetDescription',`product_specs`='$productgetspec001' WHERE `product_sku`='$productgetSku'");
			}
			
?>