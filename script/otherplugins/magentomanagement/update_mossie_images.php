<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');

	$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");
	
	if($mysqli->connect_errno)
	{
	echo $mysqli->connect_error;
	exit;
	}

	require_once('../urls.php');
	// require_once('Mfunctions.php');
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
			// $contents = get_mossee_data();
			
		if($result = $mysqli->query("select * from direct_mosse_missing_images_data where status=1"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				$sku = trim($content->SKU);
				$product_id = Mage::getModel('catalog/product')->getIdBySku(trim($sku));

				if($product_id)
				{
				$product = Mage::getModel('catalog/product');
				$product->load($product_id);
				// update images
			$vendorid = trim($product->getvendorid());
						if($vendorid == '55676')
						{
							$img = explode(' ',$content->Images);
									for($i=0;$i<1;$i++)
									{
										if(trim($img[$i]) != '')
										{
												if(!@file_get_contents($img[$i]))
												{
												$noimageentry = $mysqli->query("UPDATE `direct_mosse_missing_images_data` SET `status`='3' WHERE `SKU`='$sku'");
												}
												else
												{
												$from = trim($img[$i]);
												$urlimg = rand(1,2000);
												$image = IMAGES_MAGENTO_LOCATION_URL.str_replace('/','_',$sku).'_'.$urlimg.'.jpg';
														if(!@copy($from,$image))
														{
														$errors= error_get_last();
														echo $errors['message'];
														exit;
														}
														else
														{						
														$product->addImageToMediaGallery ($image, array('image','small_image','thumbnail'), false, false); 
														}
												}
										}
									}
									if($vendorid == '55676')
									{
									$cat = $product->getCategoryIds();
									// check is this is contain more categories of not
									$addcat = "668";
									$cat[] = trim($addcat);
									$cat = array_unique($cat);
									$product->setCategoryIds($cat);
									}
									try {
								$product->save();
								$imageentry = $mysqli->query("UPDATE `direct_mosse_missing_images_data` SET `status`='2' WHERE `SKU`='$sku'");
								echo "Import Done".$sku;
sleep(5);
								}
								catch (Exception $ex) {
								echo $ex->getMessage();
								}
						}
				}
				else
				{
				
				echo "product not there";
				// images section starts

		}
			// while loop ends	
		}
		}
		
	}				
			
			
	}
	else
	{
	exit;
	}

?>