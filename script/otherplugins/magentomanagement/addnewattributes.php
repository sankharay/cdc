<?php
//Get the eav attribute model

	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
require_once(MAGE_FILE_URL."/app/Mage.php");
umask(0);
Mage::app('default'); 
$currentStore = Mage::app()->setCurrentStore(1);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
$attr_model = Mage::getModel('eav/entity_attribute');

$attr_model->load(137);
    
  $values = array();
$valuesCollection = Mage::getResourceModel('eav/entity_attribute_option_collection')->setAttributeFilter(137)->setStoreFilter( Mage_Core_Model_App::ADMIN_STORE_ID, false)->load();
 
foreach ($valuesCollection as $item) {
	$values[$item->getValue()] = $item->getId();
}
 	$values = array(0 => 'Apple',1 =>  'Nexus',2 =>  'HTC');
$attr_model->addData( array('Samsung' => $values['0']),array('Samsungs' => $values['1']),array('Samsungss' => $values['2']) );
$attr_model->save();
echo "<pre>";
print_r($attr_model);
echo "<pre>";
exit;
	
	
	//Create an array to store the attribute data
	$data = array();
	
	//Create options array
	$values = array(0 => 'Apple',1 =>  'Nexus',2 =>  'HTC');
	//Add the option values to the data
	$data['option']['value'] = $values;
	//Add data to our attribute model
	$attr_model->addData($data);
echo "<pre>";
print_r($attr_model);
echo "<pre>";
        
//Save the updated model
try {
 $attr_model->save();
echo "inside";
 return;
} catch (Exception $attr_model) {
echo "not save";
 return;
}

?>