<?php
	ini_set('display_errors',1);
	ini_set('max_execution_time', 300);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
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
	require_once(MAGE_FILE_URL.'/app/mage.php');
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);


	umask(0);
	Mage::app('default'); 
        $currentStore = Mage::app()->setCurrentStore(1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        	$collection = Mage::getModel('catalog/product')->getCollection();
			 foreach ($collection as $product) 
			 {
				echo $product->getSku()."<br>"; 
				if($product->getvendorid() == 2139)
				$price = get_price_from_ar($sku);
				else
				$price =get_price_from_table($sku);
				
				$product->setprice($price['product_retail']);
				$product->setcost($price['product_cost']);
				try {
				$product->save();
			 	} catch (Exception $ex) {
				echo $ex->getMessage();
				}
			 }
			 			 
			 // try to save ends
			}
			
			
			
			// get price from AR
			function get_price_from_ar($sku)
			{
			$proxy = new SoapClient('https://exchangeweb.lacuracao.com:2007/ws1/eCommerce/Main.asmx?WSDL');
			$ns = 'http://lacuracao.com/WebServices/eCommerce/';
			$headerbody = array('UserName' => 'mike', 
								'Password' => 'ecom12'); 
			$header = new SOAPHeader($ns, 'TAuthHeader', $headerbody);  
			$h = $proxy->__setSoapHeaders($header); 
			
			$credit = $proxy->GetSkuPrice(array('Sku'=>$sku));
			
			$result = $credit->GetSkuPriceResult;
			
			$price_info = explode('|',$result);
			if($price_info[0]=='OK'){
				
				if($price_info[2]>0){
					$rebate_price = $price_info[1]-$price_info[3];
					if($rebate_price<$price_info[2]){
						$price = $rebate_price;
					}else{
						$price = $price_info[2];
					}
				}else{
					$price = $price_info[1]-$price_info[3];
				}
				
				$product['product_retail'] = $price;
				$product['product_cost'] = $price_info[6];
				return $product;
			}
			}
			
			// get price from AR
			
			
?>