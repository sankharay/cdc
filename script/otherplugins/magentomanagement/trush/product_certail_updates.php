<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

	require_once('../../urls.php');
	$result = true;
	
	
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
	$currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	if($result = $mysqli->query("SELECT * FROM `trush_update_productthings` WHERE `status`=1"))
	{
	if($result->num_rows > 0)
	{
	while($content=$result->fetch_object())
	{
	echo $content->sku."-";
	
	$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
	if($product_id)
	{
	$product = Mage::getModel('catalog/product');
	$product->load($product_id);
	$product->setMeta_title($content->name);
	
	$updateurl = $content->name;
	$creaturl = cleaningdata($updateurl);
	$strlower = strtolower($creaturl);
	$url = str_replace(" ","-",$strlower);
	$product->seturl_key($url);
	$product->setorig_name($content->name);
	$productdescription = $product->getDescription();				
	$product->setMeta_title($content->name);

	$removep = str_replace("<p>","",$productdescription);
	$removep = str_replace("</p>","",$removep);

	$shortdes = $product->getshort_description();
	if($shortdes == "")
	$product->setshort_description($productdescription);


	$product->setmeta_keyword($removep);
	$product->setmeta_description($removep);
	$shippingrate = $content->shipping;
	$product->setshprate($shippingrate);
	
	
	// try to save start
	try {
	$product->save();
	$contents = $mysqli->query("UPDATE `trush_update_productthings` SET `status`=2 WHERE `sku`='$content->sku'");
sleep(5);

	} catch (Exception $ex) {
	echo $ex->getMessage();
	}
	// try to save ends
	}
	else
	{
	$contents = $mysqli->query("UPDATE `trush_update_productthings` SET `status`=3 WHERE `sku`='$content->sku'");
	echo "No need to do anything";
	}
	}
	}
	}
	}


function cleaningdata($string) {
   $string = str_replace(" ", "-", $string); 
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

   return preg_replace('/-+/', ' ', $string);
}

?>