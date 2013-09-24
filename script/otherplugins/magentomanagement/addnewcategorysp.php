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
	require_once(MAGE_FILE_URL);
	Varien_Profiler::enable();
	Mage::setIsDeveloperMode(true);
	Mage::app('default');
//get a new category object
$category = Mage::getModel('catalog/category');
$category->setStoreId(3); 
$categorydetails =  get_category_details($cat_id);
print_r($categorydetails);
//if update
//if ($id) {
//  $category->load($id);
//}

$general['name'] = $categorydetails->spanish_name;
$getcattree = get_categories_tree($categorydetails->id);
print_r($getcattree);
$catsizes = sizeof($getcattree);
$catpathd="";
for($i=0;$i<$catsizes;$i++)
{
$catpathd.=$getcattree[$i]."/";
}
$general['path'] = "substr($catpathd, 0, -1)";
$general['description'] = $categorydetails->categorydes;
$general['meta_title'] = $categorydetails->name; //Page title
$general['meta_keywords'] = $categorydetails->metakeywords;
$general['meta_description'] = $categorydetails->metadescrption;
$general['landing_page'] = ""; //has to be created in advance, here comes id
$general['display_mode'] = "PRODUCTS_AND_PAGE"; //static block and the products are shown on the page
$general['is_active'] = 1;
$general['is_anchor'] = 0;
$general['display_mode'] = "PRODUCTS";
$general['is_anchor'] = 0;
$general['url_key'] = $categorydetails->name;
$imageurl = copy_cat_image($categorydetails->image);
$general['image'] = $imageurl;


$category->addData($general);

try {
    $category->save();
    echo "Success! Id: ".$category->getId();
	$catiid = $category->getId();
	mysql_query("UPDATE `categories` SET `magento_category_id` = $catiid WHERE `id` =".$cat_id);
	echo "<pre>";
	print_r($category);
	echo "</pre>";
}
catch (Exception $e){
    echo $e->getMessage();
}
	}
?>