<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
set_time_limit(0);
ini_set('display_errors',1);
error_reporting(E_ALL);
include '../dbw.php';
include '../urls.php';
	
	require_once(MAGE_FILE_URL."/app/Mage.php");
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	
	
	umask(0);
	Mage::app('admin'); 
	
	
	function get_categories(){
	
	$category = Mage::getModel('catalog/category'); 
	$tree = $category->getTreeModel(); 
	$tree->load();
	$ids = $tree->getCollection()->getAllIds(); 
	$arr = array();
	$status = array();
	if ($ids){
	foreach ($ids as $id){ 
	$cat = Mage::getModel('catalog/category'); 
	$cat->load($id);
	echo $cat->getid()." ";
	echo $cat->getName()." ";
	echo $cat->getis_active()." ";
	echo $cat->getmeta_keywords()." ";
	echo $cat->getmeta_description()." ";
	echo $cat->getImageUrl()." ";
	echo $cat->getparent_id()."<br>";
	} 
	}
	return $arr;
	
	}

  
  $arr =  get_categories();
 
	exit;	
?>
</body>
</html>