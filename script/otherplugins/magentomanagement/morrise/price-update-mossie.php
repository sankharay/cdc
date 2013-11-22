<?php
ini_set('max_execution_time', 0);
ini_set('display_errors', 1);
ini_set("memory_limit","2048M");
$stocknum = 0;
// first db connection start
// $connect1 = mysql_connect("localhost","demo","demo");
// mysql_select_db("cdc",$connect1);
$connect1 = mysql_connect("192.168.100.121","curacaodata","curacaodata");
mysql_select_db("cdc",$connect1);
// first db connection ends
// second db connection start
$connect2 = mysql_connect("192.168.100.121","curacaodata","curacaodata");
mysql_select_db("curacao_staging",$connect2);
// second db connection ends

// include('Mfunctions.php');
$inventryfile_links = array (
						'1'=>"http://morris.morriscostumes.com/out/190314/available_batchyynyy_001.xml",
						'2'=>"http://morris.morriscostumes.com/out/available_batchnynyn_002.xml",
						'3'=>"http://morris.morriscostumes.com/out/available_batchnynyn_003.xml",
						'4'=>"http://morris.morriscostumes.com/out/available_batchnynyn_004.xml",
						'5'=>"http://morris.morriscostumes.com/out/available_batchnynyn_005.xml",
						'6'=>"http://morris.morriscostumes.com/out/available_batchnynyn_006.xml",
						'7'=>"http://morris.morriscostumes.com/out/available_batchnynyn_007.xml",
						'8'=>"http://morris.morriscostumes.com/out/available_batchnynyn_008.xml",
						'9'=>"http://morris.morriscostumes.com/out/available_batchnynyn_009.xml"
							);
for($i=1;$i<2;$i++){
	$xml=simplexml_load_file("$inventryfile_links[$i]");
	$xmlsize = sizeof($xml);
	$inventrydata = $xml->Available;
	foreach($inventrydata as $product){
		echo "<pre>";
		print_r($product);
		echo "</pre>";
		// $data[] = array("Part Number"=>$product->Part,"QTY"=>$product->QTY);
		$productmagid = get_product_mosse_id($product->Part);
		if($productmagid){
			if($product->Qty > 0)
			{
				$stockstatus = 1;
			}
			else
			{
				$stocknum = $stocknum+1;
				$stockstatus = 0;
			}
			echo $product->Part." - ".$productmagid;
			$pricedata = $product->Detail;
			echo $cost = $pricedata->Price;
			// create retail data
			$docublecost = floatval($cost) * 2;
			$rdata = ceil($docublecost);
			$retailprice = $rdata-0.01;
			echo $retailprice;
			// create retail data
			if($productmagid){
// echo "Update curacao_staging.catalog_product_entity_decimal  SET  value='$cost' WHERE attribute_id=79 AND entity_id='$productmagid'";
// echo "<br>";
// echo "Update curacao_staging.catalog_product_entity_decimal  SET  value='$retailprice' WHERE attribute_id=75 AND entity_id='$productmagid'";
				$database = mysql_query("Update curacao_staging.catalog_product_entity_decimal  SET  value='$cost' WHERE attribute_id='79' AND entity_id='$productmagid'") or die(mysql_error());
				$database = mysql_query("Update curacao_staging.catalog_product_entity_decimal  SET  value='$retailprice' WHERE attribute_id='75' AND entity_id='$productmagid'") or die(mysql_error());
echo "inside";
			exit;
			}
			exit;
		}
			exit;
	}
}


function get_product_mosse_id($productsku)
{
	$data = mysql_query("SELECT * FROM cdc.`direct_mosse_product_ids` WHERE `sku`='$productsku'");
	if(mysql_num_rows($data) > 0)
	{
		$dataextract = mysql_fetch_object($data);
		return $dataextract->product_id;
	}
	else
	{
		return FALSE;
	}
}
echo "numberof thems set to zero ".$stocknum;
?>