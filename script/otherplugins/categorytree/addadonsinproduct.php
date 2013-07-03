<?php
include("dbw.php");
include("functions.php");
$values = $_GET['vals'];
$fpl_id = $_GET['fplid'];
$getexiting = mysql_query("select addons from finalproductlist where fpl_id=$fpl_id");
while($getexitingrow = mysql_fetch_object($getexiting))
$exisitngaddons = $getexitingrow->addons;
$exisitngaddon = explode(',',$exisitngaddons);
$newaddon = explode(',',$values);
$newlist = array_merge($exisitngaddon,$newaddon);
$newunique = array_unique($newlist);
$numberelements = sizeof($newunique);
$value = "";
for($i=0;$i<$numberelements;$i++)
$value.=$newlist[$i]."_";
mysql_query("UPDATE finalproductlist SET addons='$value' where fpl_id=$fpl_id");
echo "Product Addons Updated";
?>