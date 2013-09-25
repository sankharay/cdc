<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	$cat_id = $_GET['cat_id'];
	$result = check_cat_id_exist($cat_id);
	if($result == TRUE)
	{
	require_once(MAGE_FILE_URL_DEMO);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	Mage::app('default');
//get a new category object
$categorydetails =  get_category_details($cat_id);
$category = Mage::getModel('catalog/category')->setStoreId(1)->load($categorydetails->magento_category_id);

//if update
//if ($id) {
//  $category->load($id);
//}
// $category = new Mage_Catalog_Model_Category();
$category->setname("$categorydetails->name");
$getcattree = get_categories_tree($categorydetails->id);
$catsizes = sizeof($getcattree);
$catpathd="";
for($i=0;$i<$catsizes;$i++)
{
$catpathd.=$getcattree[$i]."/";
}
$category->setpath = "substr($catpathd, 0, -1)";
$category->setdescription("$categorydetails->categorydes");
$category->setmeta_title("$categorydetails->cattitle");
$category->setmeta_keywords("$categorydetails->metakeywords");
$category->setmeta_description("$categorydetails->metadescrption");
$category->setlanding_page(""); 
$category->setdisplay_mode("PRODUCTS_AND_PAGE"); 
// $category->setis_active(1);
$category->setis_anchor(1);
$category->setdisplay_mode("PRODUCTS");
$category->setinclude_in_menu("1");
$category->setcustom_apply_to_products(1);
$category->setcustom_design("base/default");
$category->setpage_layout("two_columns_left");
$category->setis_anchor(0);
$category->seturl_key("$categorydetails->name");
// $imageurl = copy_cat_image($categorydetails->image);
// echo $imageurl;
// $category->setimage("$imageurl");

$parentId = get_parentcategories($cat_id);
$parentCategory = Mage::getModel('catalog/category')->load($parentId);
$category->setPath($parentCategory->getPath());              
 


try {
	$category->save();

	$cat = Mage::getModel('catalog/category')->setStoreId(3)->load($categorydetails->magento_category_id);
	$cat->setName("$categorydetails->spanish_name");
	$cat->setmeta_title("$categorydetails->cattitle");
	$cat->setmeta_keywords("$categorydetails->spanish_metakeywords");
	$cat->setmeta_description("$categorydetails->spanish_metadescription");
	$cat->save();
	// unset($category);
	mysql_query("UPDATE `updates` SET `status` = 2 WHERE `updateid`=$cat_id AND `whatupdate`=2");
}
catch (Exception $category){
    echo $category->getMessage();
}
	}
?>