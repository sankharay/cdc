<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$fpl_id = 208;
	require_once(MAGE_FILE_URL.'/app/Mage.php');
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
			Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$content = get_english_data($fpl_id);
			for($i=190;$i<208;$i++)
			{
			$productid = $i;
        	$product = Mage::getModel('catalog/product')->load($productid);
			if($product->getId())
			{
			$idexistornot = checkidexist($product->getId());
			if($idexistornot == FALSE)
			{
			$finaltableid = insert_finaltable_data($product);
			$spanishtableid = insert_spanish_data($product,$finaltableid);
			$doneid = insert_master_data($product,$finaltableid,$spanishtableid);
			}
			}
			else
			{
			echo $product->getSku()." - Sku Insert Not Done";
			}
			}
			
			function checkidexist($id)
			{
				$data = mysql_query("SELECT * FROM `finalproductlist` WHERE `magento_category_id`='$id'");
				if(mysql_num_rows($data) > 0)
				return TRUE;
				else
				return FALSE;
			}
			
			function insert_finaltable_data($product)
			{
			$imagesa = array();
			$productid = $product->getId();
			$cat = $product->getCategoryIds();
			$images = $product->getMediaGalleryImages();
			foreach($images as $value)
			$imagesa[] = $value->url;
			$imagecollect = implode(",",$imagesa);
			$productname = $product->getName();
			$productescription = $product->getShortDescription();
			$productgetDescription = $product->getDescription();
			$productgetSku = $product->getSku();
			$productgetupc = $product->getupc();
			$productgetcost = $product->getcost();
			$productgetStockData = $product->getStockData();
			$productgetvendorid = $product->getvendorid();
			$productgetspec001 = $product->getspec001();
			$productgetweight = $product->getweight();
			$productgetmeta_keyword = $product->getmeta_keyword();
			$productgetmeta_description = $product->getmeta_description();
			$productgetproductvideo = $product->getproductvideo();
			$productgetshprate = $product->getshprate();
			$productgetstatus = $product->getstatus();
			$productbrand = $product->gettv_brand();
			$finaldata = mysql_query("INSERT INTO `finalproductlist` (`fpl_id`, `spenish_id`, `product_category`, `prduct_name`, `short_description`, `product_description`, `product_sku`, `product_upc`, `product_cost`, `product_retail`, `product_msrp`, `product_map`, `product_qty`, `product_inventory_level`, `product_brand`, `product_img_path`, `product_features`, `product_source`, `product_user`, `product_specs`, `height`, `width`, `length`, `weight`, `product_metatags`, `product_metadescription`, `product_disclaimer`, `magento_product_id`, `eng_video`, `spanish_video`, `specialprice`, `specialfromdate`, `specialtodate`, `shippingprice`, `status`, `comment`, `magento_category_id`, `priority`, `isset`, `onlineonly`, `addons`, `attributes`, `inmagento`, `user_assign`, `engdoneby`, `dateandtime`)
VALUES (NULL,
        '',
        '$cat[0]',
        '$productname',
        '$productescription',
        '$productgetDescription',
        '$productgetSku',
        '$productgetupc',
        '$productgetcost',
        'getspecial_price',
        '0',
        '0',
        '0',
        '$productgetStockData',
        '$productbrand',
        '$imagecollect',
        'product_features',
        '$productgetvendorid',
        'product_user',
        '$productgetspec001',
        'height',
        'width',
        'length',
        '$productgetweight',
        '$productgetmeta_keyword',
        '$productgetmeta_description',
        'product_disclaimer',
        'magento_product_id',
        '$productgetproductvideo',
        'Spanish_video',
        'specialprice',
        'specialfromdate',
        'specialtodate',
        '$productgetshprate',
        '$productgetstatus',
        'comment',
        '$productid',
        'priority',
        'isset',
        'onlineonly',
        'addons',
        'attributes',
        'inmagento',
        'user_assign',
        'engdoneby',
        CURRENT_TIMESTAMP)");
			return mysql_insert_id();
			}
			
			function insert_spanish_data($product,$fplid)
			{
			$imagesa = array();
			$cat = $product->getCategoryIds();
			$images = $product->getMediaGalleryImages();
			foreach($images as $value)
			$imagesa[] = $value->url;
			$imagecollect = implode(",",$imagesa);
			$productname = $product->getName();
			$productescription = $product->getShortDescription();
			$productgetDescription = $product->getDescription();
			$productgetSku = $product->getSku();
			$productgetupc = $product->getupc();
			$productgetcost = $product->getcost();
			$productgetStockData = $product->getStockData();
			$productgetvendorid = $product->getvendorid();
			$productgetspec001 = $product->getspec001();
			$productgetweight = $product->getweight();
			$productgetmeta_keyword = $product->getmeta_keyword();
			$productgetmeta_description = $product->getmeta_description();
			$productgetproductvideo = $product->getproductvideo();
			$productgetshprate = $product->getshprate();
			$productgetstatus = $product->getstatus();
			$finaldata = mysql_query("INSERT INTO `spenishdata` (`sppr_id`, `eng_id`, `product_category`, `prduct_name`, `short_description`, `product_description`, `product_sku`, `product_upc`, `product_cost`, `product_retail`, `product_msrp`, `product_map`, `product_qty`, `product_inventory_level`, `product_brand`, `product_img_path`, `product_features`, `product_source`, `product_user`, `product_specs`, `height`, `width`, `length`, `weight`, `product_metatags`, `product_metadescription`, `product_disclaimer`, `magento_product_id`, `eng_video`, `spanish_video`, `specialprice`, `specialfromdate`, `specialtodate`, `shippingprice`, `status`, `comment`, `priority`, `isset`, `onlineonly`, `addons`, `attributes`, `inmagento`, `user_assign`, `engdoneby`)
VALUES (NULL,
        '$fplid',
        '$cat[0]',
        '$productname',
        '$productescription',
        '$productgetDescription',
        '$productgetSku',
        '$productgetupc',
        '$productgetcost',
        'getspecial_price',
        '0',
        '0',
        '0',
        '$productgetStockData',
        'product_brand',
        '$imagecollect',
        'product_features',
        '$productgetvendorid',
        'product_user',
        '$productgetspec001',
        'height',
        'width',
        'length',
        '$productgetweight',
        '$productgetmeta_keyword',
        '$productgetmeta_description',
        'product_disclaimer',
        'magento_product_id',
        '$productgetproductvideo',
        'Spanish_video',
        'specialprice',
        'specialfromdate',
        'specialtodate',
        '$productgetshprate',
        '$productgetstatus',
        'comment',
        'priority',
        'isset',
        'onlineonly',
        'addons',
        'attributes',
        'inmagento',
        'user_assign',
        'engdoneby')");
			return mysql_insert_id();
			}
			
			function insert_master_data($product,$fplid,$spid)
			{
			$imagesa = array();
			$cat = $product->getCategoryIds();
			$images = $product->getMediaGalleryImages();
			foreach($images as $value)
			$imagesa[] = $value->url;
			$imagecollect = implode(",",$imagesa);
			$productname = $product->getName();
			$productescription = $product->getShortDescription();
			$productgetDescription = $product->getDescription();
			$productgetSku = $product->getSku();
			$productgetupc = $product->getupc();
			$productgetcost = $product->getcost();
			$productgetStockData = $product->getStockData();
			$productgetvendorid = $product->getvendorid();
			$productgetspec001 = $product->getspec001();
			$productgetweight = $product->getweight();
			$productgetmeta_keyword = $product->getmeta_keyword();
			$productgetmeta_description = $product->getmeta_description();
			$productgetproductvideo = $product->getproductvideo();
			$productgetshprate = $product->getshprate();
			$productgetstatus = $product->getstatus();
			$finaldata = mysql_query("INSERT INTO `masterproducttable` (`mpt_id`,`fpl_id`, `sppr_id`, `product_category`, `prduct_name`, `short_description`, `product_description`, `product_sku`, `product_upc`, `product_cost`, `product_retail`, `product_msrp`, `product_map`, `product_qty`, `product_inventory_level`, `product_brand`, `product_img_path`, `product_features`, `product_source`, `product_user`, `product_specs`, `height`, `width`, `length`, `weight`, `product_metatags`, `product_metadescription`, `eng_video`, `spanish_video`, `specialprice`, `specialfromdate`, `specialtodate`, `status`, `comment`, `priority`, `isset`, `onlineonly`, `attributes`, `inmagento`, `user_assign`, `engdoneby`, `dateandtime`)
VALUES (NULL,
        '$fplid',
        '$spid',
        '$cat[0]',
        '$productname',
        '$productescription',
        '$productgetDescription',
        '$productgetSku',
        '$productgetupc',
        '$productgetcost',
        'getspecial_price',
        '0',
        '0',
        '$productgetStockData',
        'product_brand',
        '$imagecollect',
        'product_features',
        '$productgetvendorid',
        'product_user',
        '$productgetspec001',
        'height',
        'width',
        'length',
        '$productgetweight',
        '$productgetmeta_keyword',
        '$productgetmeta_description',
        'magento_product_id',
        '$productgetproductvideo',
        'Spanish_video',
        'specialprice',
        'specialfromdate',
        'specialtodate',
        '$productgetstatus',
        'comment',
        'priority',
        'isset',
        'onlineonly',
        'attributes',
        'inmagento',
        'user_assign',
        'engdoneby',
        CURRENT_TIMESTAMP)");
			return mysql_insert_id();
			}
			
?>