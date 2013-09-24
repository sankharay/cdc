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
$attributeId = Mage::getResourceModel('eav/entity_attribute')->getIdByCode('catalog_product','brand_name');
if ($attributeId) {
	
	$attributes = Mage::getModel('eav/entity_attribute')->load($attributeId);
    echo 'label = '.$attributes->getFrontendLabel().'<br/>';
    echo 'code = '.$attributes->getAttributeCode().'<br/><br/>';
    echo $options = $attributes->getSource()->getAllOptions();
	echo "<pre>";
	print_r($options);
	echo "</pre>";
	foreach ($options as $option) {
    echo $option['label'];
    echo $option['value'];
	$fieldset->addField('brand_name', 'select', array(
	'name'       => 'brand_name',
	'label'      => Mage::helper('ressources')->__('My color'),
	'title'      => 'title_here',
	'values'     => $options,
	));
	$attributes->setSource()->setAllOptions($option);
	$attributes->save();
	}
	
    $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($attributeId);
    $attribute->setIsSearchable(0)->save();
}

?>