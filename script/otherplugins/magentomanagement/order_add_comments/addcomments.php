<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ini_set('apc.cache_by_default','Off');
	require_once('../../urls.php');
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

// Increment ID of the order to add the comment to
echo $orderIncrementID = $_GET['incrementid'];
echo "<br>";
$username = $_GET['username'];
echo "<br>";
$comments =$_GET['comments']." by ".$username;
echo "<br>";
// exit;
// Get the order - we could also use the internal Magento order ID and the load() method here
$order = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementID);
// Add the comment and save the order
$order->addStatusToHistory($order->getStatus(), $comments, false);
$order->save();
			
			
	}
	
	
?>