<?php
function check_fpl_id_exist($fpl_id)
{
	$query = "select fpl_id from finalproductlist where fpl_id='$fpl_id'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	return true;
	else
	return false;
}
function get_english_data($fpl_id)
{
	echo $query = "select * from finalproductlist where fpl_id='$fpl_id'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	return mysql_fetch_object($result);
	else
	return false;
}
function get_eng_info($sku)
{
$query = "select * from finalproductlist where product_sku='$sku' LIMIT 0,1";
$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
	return mysql_fetch_object($result);
	else
	return FALSE;
}
function get_categories($fplid)
{
$categoryrow = array();
$category_final_row = array();
$query_result = mysql_query("select * from finalproductlist where fpl_id=$fplid LIMIT 1");
$category = mysql_fetch_object($query_result);
$categoryrow = explode('_',$category->product_category);
$numcategories = sizeof($categoryrow);
for($j=0;$j<$numcategories;$j++)
{
$getmegid = get_catgory_tree($categoryrow[$j]);
// echo $getmegid->magento_category_id."<br>";exit;
$category_final_row[] = get_catgory_tree($categoryrow[$j]);
}
// print_r($category_final_row)."<br>";exit;
return $category_final_row;
}
function get_catgory_tree($id)
{
static $tree = array();
$data  = mysql_query("SELECT * FROM `categories` WHERE `id`='$id'");
while($datarow = mysql_fetch_object($data))
{
	if($datarow->id != 1)
	{
	$tree[]=$datarow->magento_category_id;
	get_catgory_tree($datarow->parent_id);
	}
}
return array_unique($tree);
}
function get_magento_cat_ids($id)
{
$query = mysql_query("select * from categories where id=$id");
return mysql_fetch_object($query);	
}
function get_img_name($fplid)
{
$imgname = array();
$query_result = mysql_query("select * from product_images where finalproductlist_fpl_id=$fplid");
if(mysql_num_rows($query_result) > 0 )
{
while($imagedatarow = mysql_fetch_object($query_result))
{
if($imagedatarow->fileplacement == 2 )
$imagelocation = IMAGES_LOCATION_CDC_URL."/resize/".$imagedatarow->img_name;
else
$imagelocation = IMAGES_LOCATION_CDC_URL."/images/".$imagedatarow->img_name;
$targeturl = IMAGES_MAGENTO_LOCATION_URL.''.$imagedatarow->img_name;
							// copy image section starts
							if(!@copy($imagelocation,$targeturl))
							{
								$errors= error_get_last();
								echo $errors['message'];
								exit;
							} else {
														
								$imgname[] = $targeturl;
							}
							// copy image section ends
}
return $imgname;
}
else
{
return false;
}
}

function final_stage_done($fpl_id)
{
$data = mysql_query("UPDATE finalproductlist SET status=12 where fpl_id=$fpl_id");
return true;
}

?>