<?php
ini_set('max_execution_time', 0);
ini_set('display_errors', 1);
ini_set("memory_limit","2048M");

// include('../dbw.php');

$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");

// include('Mfunctions.php');
$inventryfile_links = "http://morris.morriscostumes.com/wbxml/819677/out/current_loadhistory_10232013_190004.xml";
$xml=simplexml_load_file("$inventryfile_links");

$inventrydata = $xml;
foreach($xml as $product)
{
$orderid = str_replace(".xml","",str_replace("po_","",$product->Name));
$status = $product->Status;
$reason = $product->Text;
$date = $product->Date;
if($orderid != "")
$mysqli->query("INSERT INTO `morrse_rejected` (`id`, `orderid`, `status`, `date`, `reason`) VALUES (NULL, '$orderid', '$status', '$date', '$reason')");
}
?>