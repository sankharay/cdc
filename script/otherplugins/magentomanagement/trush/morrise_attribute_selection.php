<?php
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		ini_set('apc.cache_by_default','Off');
		// require_once('../dbw.php');
		$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");
		if($mysqli->connect_errno)
		{
		echo $mysqli->connect_error;
		exit;	
		}
		require_once('../urls.php');
		require_once(MAGE_FILE_URL);
		Varien_Profiler::enable();
		Mage::setIsDeveloperMode(true);
		umask(0);
		Mage::app('default'); 
		$currentStore = Mage::app()->getStore()->getId();
		Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
		if($data = $mysqli->query("select * from direct_mosse_attributes where status=1"))
		{
			while($content = $data->fetch_object())
			{				
			$sku = $content->sku;
			$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
			if($product_id)
			{
			$product = Mage::getModel('catalog/product');
			$product->load($product_id);
			if($content->attributeid == "")
			{
			if($content->attributename == "costumes_woman_size")
			$product->setcostumes_woman_size(trim($content->attributeid));
			
			if($content->attributename == "costumes_baby_toddler_size")
			$product->setcostumes_baby_toddler_size(trim($content->attributeid));
			}
			if($content->category != "")
			{
			$cat = explode("_",$content->category);
			$cat = array_unique($cat);
			$product->setCategoryIds($cat);
			}
			
				try
				{
				$product->save();
				$mysqli->query("UPDATE direct_mosse_attributes SET status=2 WHERE sku='$sku'");
				echo "-".$sku."-";
				}
				catch (Exception $ex) {
				echo $ex->getMessage();
				}
			}
			else
			echo "product not found";
			}
		}
		else
		{
		echo "query not running";
		}
?>