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
$j=0;
	require_once('../../urls.php');
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
			
		if($result = $mysqli->query("select * from direct_shy_products where status=2 ORDER BY 'tbl_id' DESC"))
	{
		if($result->num_rows > 0)
		{
		while($content = $result->fetch_object())
		{
				$sku = trim($content->SKU);
				$magentoproductIds = Mage::getModel('catalog/product')->getIdBySku(trim($sku));
				if($magentoproductIds)
				{
						$product = Mage::getModel('catalog/product');
						$product->load($magentoproductIds);
						$producturl = $product->geturl_key();
						$findme   = '.html';
						$pos = strpos($producturl, $findme);
						
						if($pos === false)
						{

						$noimageentry = $mysqli->query("UPDATE `direct_shy_products` SET `status`='4' WHERE `SKU`='$sku'");
						echo "no work";
						}
						else
						{

						$newkey = str_replace(".html",'-2',$producturl);
						$producturl = $product->seturl_key(trim($newkey));
						try {
						$product->save();
						$noimageentry = $mysqli->query("UPDATE `direct_shy_products` SET `status`='3' WHERE `SKU`='$sku'");
						echo "-".$sku."-";
						} catch (Exception $ex) {
						echo $ex->getMessage();
						}	
						}

						
				}
				else
				{
					echo "product not there";

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
	


function cleaningdata($string) {
   $string = str_replace(" ", "-", $string); 
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

   return preg_replace('/-+/', ' ', $string);
}

function checkurlstatus($key)
{
static $i=0;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://www.icuracao.com/'.$key);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_exec($curl);
$status = curl_getinfo($curl);
curl_close($curl);
if($status['http_code'] == '200')
{
$number = $i+1;
$replacewith = "-".$number.".html";
$replacenum = $number-1;
$replace = "-".$replacenum.".html";
$keys = str_replace('$replace',"$replacewith",$key);
return checkurlstatus($keys);
}
else
{
return $key;
}
}


	
?>