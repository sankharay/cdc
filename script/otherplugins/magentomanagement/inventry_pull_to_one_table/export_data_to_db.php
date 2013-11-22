<?php
ini_set('max_execution_time', 0);
ini_set('display_errors', 1);
ini_set("memory_limit","2048M");
$stocknum = 0;
// first db connection start
$connect1 = mysql_connect("192.168.100.121","curacaodata","curacaodata");
mysql_select_db("cdc",$connect1);
// first db connection ends
// second db connection start
$connect2 = mysql_connect("192.168.100.121","curacaodata","curacaodata");
mysql_select_db("curacao_magento",$connect2);
// second db connection ends
$getdata = mysql_query("select * from inventry_intertable where status=1");
while($getdatarow = mysql_fetch_object($getdata)){
		// $data[] = array("Part Number"=>$product->Part,"QTY"=>$product->QTY);
		$productmagid = checkproduct_vendorid($getdatarow->productskum,$getdatarow->vendorid);
		if($productmagid){
			$magentoid = $getdatarow->productid;
			if($product->qty > 0 AND is_numeric($product->qty))
			{
				$qty = $product->qty;
				$stockstatus = 1;
			}
			else
			{
				$qty = 0;
				$stocknum = $stocknum+1;
				$stockstatus = 0;
			}
			if($productmagid){
				$database = mysql_query("UPDATE curacao_magento.cataloginventory_stock_item item_stock, curacao_magento.cataloginventory_stock_status status_stock  SET item_stock.qty = '$qty', item_stock.is_in_stock = $stockstatus, status_stock.qty = '$qty', status_stock.stock_status = $stockstatus WHERE item_stock.product_id = '$magentoid' AND item_stock.product_id = status_stock.product_id ") or die(mysql_error());
			}
		}
}


function checkproduct_vendorid($productsku,$vendorid)
{
	$data = mysql_query("SELECT * FROM cdc.`inventry_intertable_vendorid` WHERE `sku`='$productsku' AND `vendorid`='$vendorid'");
	if(mysql_num_rows($data) > 0)
		return TRUE;
	else
		return FALSE;
}
?>