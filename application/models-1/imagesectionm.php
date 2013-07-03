<?php

class imagesectionm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	function imagelang($id)
	{
	if($id == 1)
	{
	return "English";
	}
	elseif($id == 2)
	{
	return "Spanish";	
	}
	else
	{
	return "All";
	}
	}
	
	function imagedetails($id)
	{
        $this->db->select('*');
        $this->db->from('product_images');
		$this->db->where('img_id',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->row();
		}
		else
		{
		return FALSE;
		}
	}
	
	function editingimg($data,$id)
	{
	$this->db->where('img_id',$id);
	$this->db->update('product_images',$data);
	if($this->db->affected_rows() > 0 )
	return TRUE;
	else
	return FALSE;
	}
	
	function confirmproductreadym($fplid)
	{
			// get Spainish ID of data to update done start
			$this->db->select('spenish_id');
			$this->db->where('fpl_id',$fplid);
			$this->db->from('finalproductlist');
			$spanishid = $this->db->get();
			if($spanishid->num_rows())
			{
			$spanid = $spanishid->row()->spenish_id;
			$data = array(
					'inmagento' => '1'
						  );
			$this->db->where('eng_id',$fplid);
			$this->db->update('spenishdata',$data);
			}
			// get Spanish ID of data to update done ends
			$data = array(
					'inmagento' => '1'
						  );
			$this->db->where('fpl_id',$fplid);
			$this->db->update('finalproductlist',$data);
			if($this->db->affected_rows() > 0)
			{
			return TRUE;
			}
			else
			{
			return FALSE;
			}
	}
	
	function getvendorname($id)
	{
        $this->db->select('*');
        $this->db->from('vendormanagement');
		$this->db->where('status',1);
		$this->db->where('vmID',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->row()->vendorName;
		}
		else
		{
		return FALSE;
		}
	}
	
    function getimage_mastertable($fpl_id,$product_sku,$vendor_id)
    {
        $this->db->select("product_img_path");
        $this->db->from("masterproducttable");
		$this->db->where("product_source",$vendor_id);
		$this->db->where("product_sku",$product_sku);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		$images = $data->row();
		$dataimages = $images->product_img_path;
		if($dataimages == "")
		{
		return FALSE;
		}
		else
		{
		$data = explode(",",$dataimages);
		// print_r($data);
		foreach($data as $imgvalue)
		{
		$pos = strrchr("http://",strtolower($imgvalue));
		$pos1 = strrchr("www.",strtolower($imgvalue));
		if($pos or $pos1)
		{
		$imagename = $this->copyimgto_local($imgvalue,$vendor_id);
		$datainsert = array (
						'finalproductlist_fpl_id'=>$fpl_id,
						'img_name'=>"$imagename"
						);
		$this->db->insert("product_images",$datainsert);
		// image resize start
		$resized_path = PLUGINS_URL.'/cropping/autoresizeimages/';
		$imagesource =  PLUGINS_URL.'/cropping/images/'.$imagename;
		$config = array(
		'source_image'      => $imagesource,
		'new_image'         => $resized_path, //path to
		'maintain_ratio'    => true,
		'width'             => IMAGE_RESIZE_WIDTH,
		'height'            => IMAGE_RESIZE_HEIGHT
		);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->fitimage($imagesource);
		// image resize ends
		}
		else
		{
		// echo $imgvalue;
		}
		}
		return $dataimages;
		}
		}
		else
		{
		return FALSE;
		}
	}
	
    function get_content_mastertable($mpt_id)
    {
        $this->db->select("*");
        $this->db->from("masterproducttable");
		$this->db->where("mpt_id",$mpt_id);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->result();
		}
		else
		{
		return FALSE;
		}
	}
	
    function get_content_englishtables($fpl_id)
    {
        $this->db->select("*");
        $this->db->from("finalproductlist");
		$this->db->where("fpl_id",$fpl_id);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->row();
		}
		else
		{
		return FALSE;
		}
	}
	
	function get_vendor_name($vendorid)
	{
		$this->db->select("*");
		$this->db->where("vmID",$vendorid);
		$this->db->limit(1);
		$this->db->from("vendormanagement");
		$data = $this->db->get();
		$vendorname = $data->row()->vendorName;
		if($vendorname)
		{
			return $vendorname;
		}
		else
		{
		return "Undefined Vendor";
		}
	}
	
	function copyimgto_local($url,$vendor_id)
	{
	$contents=file_get_contents($url);
	$filename = $vendor_id."_".date("D-M-YY-h-m-s").".jpg";
	$save_path=PLUGINS_URL."/cropping/images/".$filename;
	file_put_contents($save_path,$contents);
	return $filename;
	}
	
	function getimage_vendor_id($mpt_id)
	{
        $this->db->select("*");
        $this->db->from("masterproducttable");
		$this->db->where("mpt_id",$mpt_id);
		$data = $this->db->get();
		$vendorid = $data->row()->product_source;
		if($vendorid)
		{
			return $vendorid;
		}
		else
		{
		return "Undefined Vendor";
		}
	}
	
	function get_product_images($fpl_id)
	{
        $this->db->select("*");
        $this->db->from("product_images");
		$this->db->where("finalproductlist_fpl_id",$fpl_id);
		$data = $this->db->get();
		return $data->result();
	}
	
	function delimg($imageid)
	{
	$this->db->where('img_id',$imageid);
	$this->db->delete('product_images');
	$update = $this->db->affected_rows();
	$msg = 0;
	if($update)
	return $msg;
	}
	
	function checkimg($fpl_id)
	{
	$this->db->select('*');
	$this->db->from('product_images');
	$this->db->where('finalproductlist_fpl_id',$fpl_id);
	$result = $this->db->get();
	if($result->num_rows() > 0 )
	return TRUE;
	else
	return FALSE;
	}
	
	
	function fitimage($imagelocation)
	{
	// Input parametres check
	$w = 500;
	$h = 500;
	$mode = 'fit';
	if ($w <= 1 || $w >= 1000) $w = 100;
	if ($h <= 1 || $h >= 1000) $h = 100;
	 
	$src = imagecreatefromjpeg($imagelocation);
	 
	$dst = imagecreatetruecolor($w, $h);
	imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
	 
	// All Magic is here
	$this->scale_image($imagelocation,$src, $dst, $mode);
	}

	function scale_image($imagelocation,$src_image, $dst_image, $op = 'fit') {
		$jpeg_quality = 90;
		$src_width = imagesx($src_image);
		$src_height = imagesy($src_image);
	 
		$dst_width = imagesx($dst_image);
		$dst_height = imagesy($dst_image);
	 
		// Try to match destination image by width
		$new_width = $dst_width;
		$new_height = round($new_width*($src_height/$src_width));
		$new_x = 0;
		$new_y = round(($dst_height-$new_height)/2);
	 
		// FILL and FIT mode are mutually exclusive
		if ($op =='fill')
			$next = $new_height < $dst_height;
		 else
			$next = $new_height > $dst_height;
	 
		// If match by width failed and destination image does not fit, try by height 
		if ($next) {
			$new_height = $dst_height;
			$new_width = round($new_height*($src_width/$src_height));
			$new_x = round(($dst_width - $new_width)/2);
			$new_y = 0;
		}
		
		// Copy image on right place
		imagecopyresampled($dst_image, $src_image , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);
		header('Content-type: image/jpeg');
		imagejpeg($dst_image,$imagelocation,$jpeg_quality);
	}
	
	
}
?>
