<?php
function get_product_details($fpl_id)
{
$query = mysql_query("SELECT * FROM `finalproductlist` WHERE `fpl_id`= '$fpl_id'");
$data = mysql_num_rows($query);
if($data > 0)
return mysql_fetch_object($query);
else
return FALSE;
}
function get_product_details_spanish($fpl_id)
{
$query = mysql_query("SELECT * FROM `spenishdata` WHERE `eng_id`= '$fpl_id'");
$data = mysql_num_rows($query);
if($data > 0)
return mysql_fetch_object($query);
else
return FALSE;
}
function get_product_english_images($fpl_id)
{
$query = mysql_query("SELECT * FROM `product_images` WHERE (`image_lanauage` = 3 OR `image_lanauage`=0 OR `image_lanauage`=1) AND `finalproductlist_fpl_id`= '$fpl_id'");
$data = mysql_num_rows($query);
if($data > 0)
return $query;
else
return FALSE;
}
function get_product_spanish_images($fpl_id)
{
$query = mysql_query("SELECT * FROM `product_images` WHERE (`image_lanauage` = 3 OR `image_lanauage`=0 OR `image_lanauage`=2) AND `finalproductlist_fpl_id`= '$fpl_id'");
$data = mysql_num_rows($query);
if($data > 0)
return $query;
else
return FALSE;
}
function fisclaimer($id)
{
$query = mysql_query("SELECT * FROM `disclaimermanagement` WHERE `id`= '$id' LIMIT 1");
$data = mysql_num_rows($query);
if($data > 0)
return mysql_fetch_object($query);
else
return FALSE;
}
?>