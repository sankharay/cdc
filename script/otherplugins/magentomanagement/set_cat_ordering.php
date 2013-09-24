<?php
include("../dbw.php");
$setparent = mysql_query("select * from `categories`");
while($setparentrow = mysql_fetch_object($setparent))
{
	$getparentid = mysql_query("select * from  `categories` where `magento_category_id`='$setparentrow->magentoparentid'");
	while($data = mysql_fetch_object($getparentid))
	{
	echo "UPDATE `categories` SET `parent_id`='$data->id' WHERE `id`='$setparentrow->id'";
	mysql_query("UPDATE `categories` SET `parent_id`='$data->id' WHERE `id`='$setparentrow->id'");
	}
}
?>