<?php
include("../dbw.php");
$myquery = mysql_query("select * from directmagentotable where product_category=38");
while($myqueryrow = mysql_fetch_object($myquery))
{
	echo $myqueryrow->product_sku."<br>";
	echo $newsku = str_replace("<br>","",$myqueryrow->product_sku);
	mysql_query("UPDATE `directmagentotable` SET `product_sku`='$newsku' where `fpl_id`='$myqueryrow->fpl_id'");
}
?>