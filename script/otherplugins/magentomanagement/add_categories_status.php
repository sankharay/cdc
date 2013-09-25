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
	
	require_once(MAGE_FILE_URL);
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
	$notthere = array();
	if ($ids){ 
	foreach ($ids as $id){ 
	$cat = Mage::getModel('catalog/category'); 
	$cat->load($id);
	echo $cat->getid()."<br>";
	$catthere = get_category_there($cat->getid());
	if(!$catthere)
	{
	// insert category in table strt
	$catinsert = missingcat_insert($cat);
	// insert category in tabel ends
	$notthere[$cat->getid()] = $cat->getName();
	}
	}
	}
	echo "<pre>";
	print_r($notthere);
	echo "</pre>";
	return $arr;
	}

	function missingcat_insert($cat)
	{
	$catmagentoid = $cat->getid();
	$catdescription = htmlspecialchars($cat->getDescription(),ENT_QUOTES);
	$catname = $cat->getName();
	$catstatus = $cat->getis_active();
	$catmetakeywords = $cat->getmeta_keywords();
	$catmetadescription = $cat->getmeta_description();
	$caturl = $cat->getImageUrl();
	$catmagentoparentid = $cat->getparent_id();
	$parentcdcid = get_parentid_cdcid($catmagentoparentid);
	echo $query  = "INSERT INTO `categories_copy` (
	`id`,
	 `name`,
	 `categorydes`,
	 `image`,
	 `metakeywords`,
	 `metadescrption`,
	 `parent_id`,
	 `magentoparentid`,
	 `magento_category_id`,
	 `magento_cat_spenish_id`,
	 `spanish_name`,
	 `updatedateandtime`,
	 `status`)
		VALUES (NULL,
        '$catname',
        '$catdescription',
        '',
        '$catmetakeywords',
        '$catmetadescription',
        '$parentcdcid',
        '$catmagentoparentid',
        '$catmagentoid',
        '$catmagentoid',
        '$catname',
        CURRENT_TIMESTAMP,
        '1')";
mysql_query($query);
		echo "<br>";
	}



	function get_parentid_cdcid($magentoid)
	{
	$iid = mysql_query("SELECT * FROM `categories_copy` WHERE `magento_category_id`='$magentoid'");
	if(mysql_num_rows($iid) > 0)
	{
	$data = mysql_fetch_object($iid);
	return $data->id;
	}
	else
	{
	return false;	
	}
	}


	// check category id is there or not strt
	function get_category_there($magentoid)
	{
echo "SELECT * FROM `categories_copy` WHERE `magento_category_id`='$magentoid'";
	$get = mysql_query("SELECT * FROM `categories_copy` WHERE `magento_category_id`='$magentoid'");
	if(mysql_num_rows($get) > 0)
	return TRUE;
	else
	return FALSE;
	}
	// check category id is there or not end


  
  $arr =  get_categories();
 
	exit;	
?>
</body>
</html>