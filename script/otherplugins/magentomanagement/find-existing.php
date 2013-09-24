<?php
ini_set('max_execution_time', 3000);
include("../dbw.php");
$data = mysql_query("select * from directmagento_puredata");
while($datarow = mysql_fetch_object($data))
{
$cstatus = checkexist($datarow->sku);
if($cstatus == TRUE)
{
echo $datarow->sku."- Exist <br>";
mysql_query("INSERT INTO `directmagento_puredata_real` (`sku`, `instock`) VALUES ('$datarow->sku', '$datarow->instock')");
}
}

function checkexist($sku)
{
$checkstatus = mysql_query("SELECT * FROM `relatedproducts_magento` WHERE `productsku`= '$sku'");
if(mysql_num_rows($checkstatus) > 0)
{
return TRUE;	
}
else
return FALSE;
}
?>