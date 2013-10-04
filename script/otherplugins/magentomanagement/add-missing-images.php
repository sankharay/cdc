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


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->getStore()->getId();
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
			$contents = mysql_query("SELECT * FROM `direct_mosee_missing_images` where status='1'") ;
			while($content = mysql_fetch_object($contents))
			{ 
        	// $magentoproductIds = Mage::getModel('catalog/product')->loadByAttribute('sku',$content->sku);
			$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($content->sku));
			if($product_id)
			{
			$sku = $content->sku;
			// add new product
			$product = Mage::getModel('catalog/product');
		    $product ->load($product_id);
			// images section starts
			// first removing existing images from product start
			$mediaApi = Mage::getModel("catalog/product_attribute_media_api");
			$mediaApiItems = $mediaApi->items($product_id);
			foreach($mediaApiItems as $item) {
				$datatemp=$mediaApi->remove($product_id, $item['file']);
			}
			$product->save();
			// first removing existing images from product ends

			// after removing image again load product start
			$product = Mage::getModel('catalog/product');
		    $product->load($product_id);
			// after removing image again load product ends
			$img = explode(',',$content->Image_Link);
			
			for($i=0;$i<sizeof($img);$i++){
			if(trim($img[$i]) != ''){
					
					//if(file_exists(trim($img[$i]))){
					//echo 'here';
						if(file_get_contents(trim($img[$i]))){	
							$from = $img[$i];
							$randimg = rand(22,20000);
							$image = IMAGES_MAGENTO_LOCATION_URL_STAGING.str_replace('/','_',$sku).'_'.$randimg.'.jpg';
							if(!@copy($from,$image))
							{
								$errors= error_get_last();
								echo $errors['message'];
							
							} else {
														
								$product->addImageToMediaGallery ($image, array('image','small_image','thumbnail'), false, false);
							}
							/*$url = trim($img[$i]);
							$image = 'media/images/'.str_replace('/','_',$sku).'_'.$i.'.jpg';
							file_put_contents($image, file_get_contents($url));*/
							
						//}
					}
				}
			}
			// images section ends		

			// $spec001 = $product->getspec001();
			// $spec001pure = $spec001."<br> <br> <div id='detail_shipping'>*Not intended for commercial use. CuracaoÂ® is not responsible for the improper use of licensed costumes.</div>";
			// $product->setspec001($spec001pure);


 			try {
				
				$product->save();
				$processingdone = mysql_query("update `direct_mosee_missing_images` SET status=2 WHERE sku='$content->sku'");
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