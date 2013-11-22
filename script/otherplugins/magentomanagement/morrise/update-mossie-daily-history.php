<?php
ini_set('max_execution_time', 0);
ini_set('display_errors', 1);
ini_set("memory_limit","2048M");

// include('../dbw.php');

$mysqli = new mysqli("192.168.100.121","curacaodata","curacaodata","cdc");
// $mysqli = new mysqli("localhost","demo","demo","cdc");
// include('Mfunctions.php');
$inventryfile_links = "http://morris.morriscostumes.com/wbxml/819677/out/daily_summary_10292013.xml";
$xml=simplexml_load_file("$inventryfile_links");

$count =0;
foreach ($xml as $OrderDetail) {
    if($OrderDetail->count() > 0)
	$count=$count+1;
}


for($i=0;$i<$count;$i++)
{
$inventrydata = $xml->OrderDetail[$i];

foreach($inventrydata as $product){

		
		// status date
		$Status = $product->Status;
		$statusdate = $product->StatusDate;
		// status date
		$order_header = get_object_vars($product->Header);
		// get billing to starts
		$billingadd = get_object_vars($order_header['BillTo']);
		$billingadds = get_object_vars($billingadd['Address']);

		foreach($billingadds as $billingaddress)
		{
		$billingaddress = "Line :".$billingadds['Line1'];
		$billingaddress.= ", Street :".$billingadds['Street1'];
		$billingaddress.= ", City :".$billingadds['City'];
		$billingaddress.= ", State :".$billingadds['State'];
		$billingaddress.= ", Zip :".$billingadds['Zip'];
		}
		// echo $billingaddress;
		// get billing to ends
		// get billing to starts
		$shipadd = get_object_vars($order_header['ShipTo']);
		$shipadds = get_object_vars($shipadd['Address']);
		foreach($shipadds as $shipaddress)
		{
		$shipaddress = "Line :".$shipadds['Line1'];
		$shipaddress.= ", Street :".$shipadds['Street1'];
		$shipaddress.= ", City :".$shipadds['City'];
		$shipaddress.= ", State :".$shipadds['State'];
		$shipaddress.= ", Zip :".$shipadds['Zip'];
		}
		// echo $shipaddress;
		// get billing to ends
		// get all order details include payment
		$orderdetails= "<br>OrderNum : ".$order_header['OrderNum'];
		$orderdetails.= "<br>Location : ".$order_header['Location'];
		$orderdetails.= "<br>po : ".$order_header['po'];
		$orderdetails.= "<br>Total Amount : ".$order_header['Total'];
		$orderdetails.= "<br>Transection Type : ".$order_header['Terms'];
		$orderdetails.= "<br>Shipping Details : ".$order_header['Via'];
		$orderid = $order_header['po'];
		// get all order details incldue payment
		// get all items in this order
		$itemsadd = get_object_vars($product->LineItems);
		$skudata = get_object_vars($itemsadd['Line']);
		$sku= $skudata['Sku'];
		$orderdetails.="<br>SKU in Order :".$sku;
		// get all items in this order
$vendorid = "55676";
		if($orderid !="")
		$mysqli->query("INSERT INTO `vendor_daily_reporting` (`id`, `orderId`, `paymentdetails`, `billing`, `shipping`, `vendorid`, `date`, `status`) VALUES (NULL, '$orderid', '$orderdetails', '$billingaddress', '$shipaddress', '$vendorid', '$statusdate', '$Status')") or die(mysql_error());

}
}
?>