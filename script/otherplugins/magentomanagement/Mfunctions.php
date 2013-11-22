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
	$query = "select * from finalproductlist where `fpl_id`='$fpl_id'";
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
$getmegid = get_magento_cat_ids($categoryrow[$j]);
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
$query_result = mysql_query("select * from product_images where finalproductlist_fpl_id=$fplid ORDER BY `image_position` DESC");
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

function get_attributes($datas)
{
$retrunarray = array();
$realname = array();
$sizeb = sizeof($datas);
$value2 = explode('_',$datas);
$realname = get_att_save_value($value2[1]);
return $realname;
}
// string ends 
function get_att_save_value($id)
{
	$data = mysql_query("select * from `attribute_types` where id=$id");
	$val = mysql_fetch_object($data);
	return $val->attributename;
}


function check_cat_id_exist($id)
{
	$query = "select * from categories where id='$id'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	return true;
	else
	return false;
}

function get_category_details($id)
{
	$query = "select * from categories where id='$id'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	return mysql_fetch_object($result);
	else
	return false;
}
function copy_cat_image($imagename)
{
$imagelocation = PLUGINS_URL.'/cropping/categories/'.$imagename;
$targeturl = IMAGES_MAGENTO_CAT_LOCATION_URL.''.$imagename;

$realwebpath = IMAGES_MAGENTO_CAT_WEB_LOCATION_URL.''.$imagename;
if(!@copy($imagelocation,$targeturl))
							{
								$errors= error_get_last();
								echo $errors['message'];
								exit;
							}
$imagerealurl = IMAGES_MAGENTO_CAT_WEB_LOCATION_URL.''.$imagename;
return $imagename;
}



function get_categories_tree($catid)
{
static $tree = array();
$data  = mysql_query("SELECT * FROM `categories` WHERE `id`='$catid'");
while($datarow = mysql_fetch_object($data))
{
	if($datarow->id != 1)
	{
	$datareturn = get_catgory_trees($datarow->parent_id);
	}
}
return array_unique($datareturn);
}
function get_catgory_trees($id)
{
static $tree = array();
$data  = mysql_query("SELECT * FROM `categories` WHERE `id`='$id'");
while($datarow = mysql_fetch_object($data))
{
	$tree[]=$datarow->magento_category_id;
	get_catgory_trees($datarow->parent_id);
}
return $tree;
}
function get_spanish_data($fpl_id)
{
	$query = "select * from spenishdata where `eng_id`='$fpl_id'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	return mysql_fetch_object($result);
	else
	return false;
}
function productaddons($value)
{
	$skus = array();
	$data = explode('_',$value);
	$valuedata = array_values(array_filter($data));
	$num = sizeof($valuedata);
	for($i=0;$i<$num;$i++)
	{
	$getsku = mysql_query("SELECT * FROM `finalproductlist` WHERE `fpl_id`='$valuedata[$i]'");
	while($getskurow = mysql_fetch_object($getsku))
	$skus[] = $getskurow->product_sku;
	}
return $skus;
}


function cleaningdata($string) {
   $string = str_replace(" ", "-", $string); 
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

   return preg_replace('/-+/', ' ', $string);
}

function get_parentcategories($id)
{
$categoryrow = array();
$category_final_row = array();
$query_result = mysql_query("select * from `categories` WHERE `id`='$id' LIMIT 1");
$category = mysql_fetch_object($query_result);
$ids = get_parentmagentoid($category->parent_id);
return $ids;
}

function get_parentmagentoid($id)
{
$categoryrow = array();
$category_final_row = array();
$query_result = mysql_query("select * from `categories` WHERE `id`='$id' LIMIT 1");
$category = mysql_fetch_object($query_result);
return $category->magento_category_id;
}

function get_cosmetices_data()
{
$myquery = mysql_query("select * from directmagentotable where product_category=38");
return $myquery;
}

function get_qty_data()
{
$myquery = mysql_query("select * from directmagento_quantity");
return $myquery;
}

function get_qty_data_real()
{
$myquery = mysql_query("select * from directmagento_inventory_real");
return $myquery;
}

function get_qty_data_petra()
{
$myquery = mysql_query("select * from directmagento_inventry_12sept");
return $myquery;
}

function get_qty_data_petra_datas()
{
$myquery = mysql_query("select * from directmagento_petrainventry_12sept where status=1");
return $myquery;
}

function getfilename($id)
{
$myquery = mysql_query("SELECT * FROM `files_foraddproduct` WHERE `id`=$id");
return mysql_fetch_object($myquery);
}

function get_price_from_table($sku)
{
$myquery = mysql_query("SELECT * FROM `directmagentotable_jewellery` WHERE `product_sku`='$sku' LIMIT 1");
return mysql_fetch_object($myquery);
}

function get_rosetta_data()
{
$myquery = mysql_query("select * from directmagento_rosetta");
return $myquery;	
}

function get_price_data()
{
$myquery = mysql_query("select * from direct_price");
return $myquery;
}

function get_jewellery_from_table()
{
$myquery = mysql_query("SELECT * FROM `directmagentotable_jewellery`");
return $myquery;
}

function get_quantity($sku)
{
$myquery = mysql_query("SELECT * FROM `directmagento_quantity` WHERE `sku`='$sku'");
if(mysql_num_rows($myquery) > 0)
{
$data = mysql_fetch_object($myquery);
return $data->qty;
}
else
return 0;
}

function get_jewellery_from_table_data()
{
$myquery = mysql_query("SELECT * FROM `directmagentotable_jewellery`");
return $myquery;
}

function insert_data_status($sku,$status)
{
$myquery = mysql_query("SELECT * FROM `magentoproduct_status` where `sku`='$sku'");
if(mysql_num_rows($myquery) > 0)
{
$updatedata = mysql_query("UPDATE `magentoproduct_status` SET `status`='$status' WHERE `sku`='$sku'");	
}
else
{
$insertdata = mysql_query("INSERT INTO `magentoproduct_status` (`sku`, `status`) VALUES ('$sku', '$status')");
}
}

function addrelatedcontent($product_category,$productId,$prduct_name,$sku,$prduct_upc,$price)
{
$catsize = sizeof($product_category);
for($i=0;$i<$catsize;$i++)
{
$sizesub = sizeof($product_category[$i]);
foreach($product_category[$i] as $val)
$newarray[] = $val;
}
$new = array_values(array_unique($newarray));
$catsizes = sizeof($new);
for($j=0;$j< $catsizes;$j++)
{
$productcategory = $new[$j];
echo "INSERT INTO `relatedproducts_magento` (`id`, `catmagid`, `magproductid`, `productname`, `productsku`, `productupc`, `productPrice`, `productStatus`, `dateandtime`) VALUES (NULL, $productcategory, '$productId', '$prduct_name', '$sku', '$prduct_upc', '$price', '1', CURRENT_TIMESTAMP)";
mysql_query("INSERT INTO `relatedproducts_magento` (`id`, `catmagid`, `magproductid`, `productname`, `productsku`, `productupc`, `productPrice`, `productStatus`, `dateandtime`) VALUES (NULL, $productcategory, '$productId', '$prduct_name', '$sku', '$prduct_upc', '$price', '1', CURRENT_TIMESTAMP)");
}
}

function get_catalog_data()
{
$myquery = mysql_query("SELECT * FROM `directmagento_catalog`");
return $myquery;
}

function get_catalog_special_data()
{
$myquery = mysql_query("SELECT * FROM `directmagento_catalog_price`");
return $myquery;
}

function get_missing_data()
{
$myquery = mysql_query("SELECT * FROM `directmagento_datamissing`");
return $myquery;
}

function get_disclaimer($id)
{
$discl = mysql_query("SELECT * FROM `disclaimermanagement` WHERE `id`=$id");
if(mysql_num_rows($discl) > 0)
{
$data = mysql_fetch_object($discl);
return $dis = '<div id="detail_shipping">'.$data->english.'</div>';
}
else
return false;
}

function checkurlstatus($key)
{
static $i=0;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://www.icuracao.com/'.$key);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_exec($curl);
$status = curl_getinfo($curl);
curl_close($curl);
if($status['http_code'] == '200')
{
$number = $i+1;
$replacewith = $number."-1.html";
$keys = str_replace('.html',"$replacewith",$key);
return checkurlstatus($keys);
}
else
{
return $key;
}
}

function checkurlstatus_staging($key)
{
static $i=0;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://staging.icuracao.com/'.$key);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_exec($curl);
$status = curl_getinfo($curl);
curl_close($curl);
if($status['http_code'] == '200')
{
$number = $i+1;
$replacewith = "-".$number.".html";
$keys = str_replace('.html',"$replacewith",$key);
return checkurlstatus_staging($keys);
}
else
{
return $key;
}
}

function final_staging_done($fpl_id)
{
$data = mysql_query("UPDATE finalproductlist SET status=17 where fpl_id=$fpl_id");
return true;
}

function get_qty_sku_update_vendorid_real()
{
$myquery = mysql_query("SELECT * FROM `direct_vendoridupdate`");
return $myquery;
}

function get_disabled_real()
{
$myquery = mysql_query("SELECT * FROM `directmagento_disable`");
return $myquery;
}

function get_pure_disabled_real()
{
$myquery = mysql_query("SELECT * FROM `directmagento_puredata_real`");
return $myquery;
}

function get_pure_disabled_real_data()
{
$myquery = mysql_query("SELECT * FROM `directmagento_disableskudata`");
return $myquery;
}

function checkin_addrelated($productsku)
{
$myquery = mysql_query("SELECT * FROM `relatedproducts_magento` WHERE `productsku`='$productsku'");
$checkthere = mysql_num_rows($myquery);
if($checkthere > 0)
return TRUE;
else
return FALSE;
}


function get_staging_data()
{
	$mysqlquery = mysql_query("SELECT * FROM `finalproductlist` WHERE `status`=17 AND `inmagento`=1");
	$stagingnum = mysql_num_rows($mysqlquery);
	if($stagingnum > 0)
	{
	return $mysqlquery;
	}
	else
	{
	echo "0";
	exit;
	}
}

function get_qty_data_api_dandh()
{
$myquery = mysql_query("SELECT * FROM `api_inventry` WHERE `status`=1");
return $myquery;
}

function updatedatainventryid($sku)
{
$myquery = mysql_query("UPDATE cdc.`api_inventry` SET `status`=2 where `sku`='$sku'");
return $myquery;
}

function updatedatainventryids($sku)
{
$myquery = mysql_query("UPDATE cdc.`api_inventry` SET `status`=3 where `sku`='$sku'") or die(mysql_error());
return $myquery;
}

function get_qty_data_updateqty()
{
$myquery = mysql_query("SELECT * FROM `directmagento_catupdate`");
return $myquery;
}

function get_data_template_datainqueue_masterproducttable()
{
$myquery = mysql_query("select * from update_queue_masterproducttable where status=1 GROUP BY `templateid`");
return $myquery;
}

function get_data_in_queue_masterproducttable()
{
$myquery = mysql_query("select * from update_queue_masterproducttable where status=1 GROUP BY `product_source`");
return $myquery;
}

function get_data_update_queue_masterproducttable($templateid)
{
$myquery = mysql_query("select * from update_queue_masterproducttable where status=1 AND `templateid`=$templateid");
return $myquery;
}

function get_product_content_template($templateid)
{
$template = mysql_query("select * from update_vendortemplate where id=$templateid");
$templatedada = mysql_fetch_object($template);
return $templatedada->template_dbstructure;
}

function updateapimater_table_status($sku)
{
// echo "UPDATE `update_queue_masterproducttable` SET `status`=2 where `product_sku`='$sku'";
$myquery = mysql_query("UPDATE `update_queue_masterproducttable` SET `status`=2 where `product_sku`='$sku'");
return TRUE;
}
function get_mossee_data()
{
$myquery = mysql_query("select * from direct_mosse_products WHERE  `status`='1'");
return $myquery;
}

function update_mossie_status($sku)
{
$mysqlupdate = mysql_query("UPDATE `direct_mosse_products` SET `status`='2' WHERE `SKU`='$sku'");
return TRUE;
}

function update_mossie_statuss($sku)
{
$mysqlupdate = mysql_query("UPDATE `direct_mosse_products` SET `status`='3' WHERE `SKU`='$sku'");
return TRUE;
}
function get_mossee_translation_data()
{
$myquery = mysql_query("SELECT * FROM `direct_mosse_products` WHERE `status`=1")or die("Error in :" . mysql_error());
return $myquery;
}

function updatespanishdata($spname,$description,$productspecs,$sku)
{
echo "UPDATE `direct_mosse_products` SET `spanish_Product_Name`='$spname',`spanish_Product_Description`='$description',`spanish_specification`='$productspecs' WHERE `SKU`='$sku'";
$mysqlupdate = mysql_query("UPDATE `direct_mosse_products` SET `spanish_Product_Name`='$spname',`spanish_Product_Description`='$description',`spanish_specification`='$productspecs' WHERE `SKU`='$sku'");
return TRUE;
}
function get_mossee_data_puretext()
{
$myquery = mysql_query("select * from direct_mosse_products WHERE `status`=2");
return $myquery;
}
function getshipping($weight)
{
$shippingfirst = "9.99";
$shippingsecond = "19.99";
$shippingthird = "29.99";
$shippingfourth = "39.99";
$shippingfive = "49.99";
$shippingsixth = "Domestic";

if($weight < 10)
return $shippingfirst;
elseif($weight >= 10 AND $weight < 20)
return $shippingsecond;
elseif($weight >= 20 AND $weight < 30)
return $shippingthird;
elseif($weight >= 30 AND $weight < 40)
return $shippingfourth;
elseif($weight >= 40 AND $weight < 69 )
return $shippingfive;
elseif($weight >= 69)
return $shippingsixth;	
}

function get_vendorid($vendorid)
{
$template = mysql_query("select * from vendormanagement where vmID=$vendorid");
$templatedada = mysql_fetch_object($template);
return $templatedada->vendorID;
}


function checkskuinmagento($sku)
{
$mysqliconnect = mysql_connect("192.168.100.121","curacaodata","curacaodata");
$database = mysql_select_db("curacao_magento");
$result1 = mysql_query("SELECT * FROM curacao_magento.`catalog_product_entity` WHERE `sku`='$sku'") or die(mysql_error());
if(mysql_num_rows($result1) > 0)
{
return TRUE;
}
else
return FALSE;
mysql_close($mysqliconnect);
}

?>