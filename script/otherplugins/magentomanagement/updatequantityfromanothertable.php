<?php
	ini_set('max_execution_time', 3000);
	require_once('../dbw.php');
	require_once('../urls.php');
	require_once('Mfunctions.php');
	
			$contents = get_jewellery_from_table();
			while($content = mysql_fetch_object($contents))
			{
			$quantity = get_quantity($content->product_sku);
			if($content->product_inventory_level >= $quantity)
			echo $content->product_sku."<br>";
			else
			mysql_query("UPDATE `directmagentotable_jewellery` SET `product_inventory_level`='$quantity' WHERE `product_sku`='$content->product_sku'");
			}
?>