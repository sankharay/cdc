<?php
set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
include("../dbw.php");
$getcontent = mysql_query("SELECT * FROM `direct_mosse_products`");
while($content = mysql_fetch_object($getcontent))
{
	$size = str_replace("{--text--}","",$content->Size);
	mysql_query("UPDATE `direct_mosse_products` SET `Size`='$size' WHERE `SKU`='$content->SKU'");
}
?>