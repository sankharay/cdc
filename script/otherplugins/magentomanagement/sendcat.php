<?php
$parentId = '6';
	require_once('../urls.php');
 require_once(MAGE_FILE_URL."/app/Mage.php");
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	Mage::app('default');
$category = new Mage_Catalog_Model_Category();
$category->setName('Storybloks');
$category->setUrlKey('new-category');
$category->setIsActive(1);
$category->setDisplayMode('PRODUCTS');
$category->setIsAnchor(0);
 
$parentCategory = Mage::getModel('catalog/category')->load($parentId);
$category->setPath($parentCategory->getPath());              
 
$category->save();
unset($category);
?>