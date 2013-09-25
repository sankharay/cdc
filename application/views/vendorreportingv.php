<?php
if($rejections)
{
$rejectionscontent = array();
$contents = array();
	$i=0;
	$rejetionsize = sizeof($rejections);
	foreach($rejections as $value)
	{
	$rejectionscontent = $this->vendorreportingm->get_realcontent($value->mpt_id);
$data[] = array( "name"=>htmlspecialchars_decode($rejectionscontent->prduct_name),"description"=>preg_replace("/[\n\r]/"," ", $rejectionscontent->product_description), "sku"=>$rejectionscontent->product_sku,"UPC"=>$rejectionscontent->product_upc,"Image_URL"=>$rejectionscontent->product_img_path,"Brand"=>$rejectionscontent->product_brand,"Specs"=>preg_replace("/[\n\r]/"," ", $rejectionscontent->product_specs),"Height"=>$rejectionscontent->height,"width"=>$rejectionscontent->width,"Velengthndor"=>$rejectionscontent->length,"weight"=>$rejectionscontent->weight,"comment"=>preg_replace("/[\n\r]/"," ", htmlspecialchars_decode($value->comment)),"dateandtime"=>$rejectionscontent->dateandtime);
	++$i;
	}
	$filename = "Magento_Active_Products.xls";
	
	  header("Content-Disposition: attachment; filename=\"$filename\"");
	  header("Content-Type: application/vnd.ms-excel");
	
	  $flag = false;
	  foreach($data as $row) {
	
		if(!$flag) {
		  // display field/column names as first row
		  echo implode("\t", array_keys($row)) . "\r\n";
		  $flag = true;
		}
	   // array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\r\n";
	  }
	
	
	exit;
}
else
{
$this->session->set_userdata('updated','No Content Found');
redirect(BASE_URL.'/reporting');
exit;	
}
	
?>