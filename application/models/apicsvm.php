<?php
class apicsvm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/csvreader/parsecsv.lib.php');
		$this->load->library('image_lib');
		$process = 1;
    }
	
    function verifyvendor($vendorid)
    {
        $this->db->select("*");
		$this->db->where("vmID",$vendorid);
		$this->db->where("status",1);
        $this->db->from("vendormanagement");
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
			return TRUE;
		}
		else
		{
		redirect(BASE_URL."/unauthorized");
		exit;
		}
	}
	
	function getvendordetails($vid)
	{
        $this->db->select("*");
		$this->db->where("vmID",$vid);
        $this->db->from("vendormanagement");
		$data = $this->db->get();
		return $data->row();
	}
	
	function getvendortemplate($vid)
	{
        $this->db->select("*");
		$this->db->where("vendor_id",$vid);
        $this->db->from("update_vendortemplate");
		$data = $this->db->get();
		return $data->row();
	}
	
	function copyfile($url,$vendorid)
	{
	// copy file to new location starts
	$contents=file_get_contents($url);
	$filename = $vendorid."_".date("D-M-YY-h-m-s").".xls";
	$save_path=UPLOADEDFILES_URL."/vendorfiles/remoteftp/".$filename;
	file_put_contents($save_path,$contents);
	return $filename;
	// copy file to new location ends
	}
	
	function ftpcopyfile($vendordetails,$vendorid)
	{
	// copy file from vendor FTP location starts
	$filename = $this->ftptransfer($vendordetails);
	return $filename;
	// copy file from vendor FTP location ends
	}
	
	public function ftptransfer($vendordetails)
	{
	$this->load->library('ftp');
	$config['hostname'] = "$vendordetails->hostip";
	$config['username'] = "$vendordetails->username";
	$config['password'] = "$vendordetails->password";
	$config['port']     = 21;
	$config['passive']  = TRUE;
	$config['debug']	= TRUE;
	$filelocation  = $vendordetails->filelocation."".$vendordetails->filename;
	$vendorName  = $vendordetails->username."-".$vendordetails->vmID;
	$this->ftp->connect($config);
	$list = $this->ftp->list_files('ProductFeed');
	//echo $this->ftp->chmod('/', DIR_WRITE_MODE); 
	//echo $this->ftp->mkdir("ProductFeed/dasda");
	print_r($list);
	$clave = array_search("ProductFeed/ProdList.xls", $list);
	if(isset($list[0]))
	{
	$filename = explode('/',$list[0]);
	$sourcepath=$filelocation;
	$newfilename = date("D-M-Y-H-s")."-".$vendorName.".csv";
	$copypath = UPLOADEDFILES_URL."/vendorfiles/remoteftp/".$newfilename;
	$destinationpath = "ProductFeed/Archive/".$newfilename;
	$this->ftp->download($sourcepath, $copypath, 'auto');
	$this->ftp->move($sourcepath, $destinationpath);
	$this->ftp->close();
	return $newfilename;
	}
	else
	{
	echo "Folder Emplty";
	exit;
	}
		}
	
	function matchexcelfields($file,$vendortemplatedetails,$ignorelines)
	{
		$error = array();
		$count = 0;
		// CSV reader
		$csv = new parseCSV();
		$csv->offset = $ignorelines;
		$csv->auto(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$file);
		// CSV reader
		// echo $file;
		$vendortemplatearray = array_filter(explode(",",$vendortemplatedetails));
		$vtemplatesize = sizeof($vendortemplatearray);
		echo "<pre>";
		print_r($csv->titles);
		echo "</pre>";
		echo "<pre>";
		print_r($vendortemplatearray);
		echo "</pre>";
	    $x=2;
	    foreach ($csv->titles as $row)
		{
		if(in_array($row,$vendortemplatearray))
		{
		echo $row;
		echo $count = $count +1;
		$error[] = TRUE;
		}
		else
		{
		$error[] = "Exist";
		}
		}
		echo $count." - ".$vtemplatesize;
		if($count == $vtemplatesize)
		{
		// return false means in excel file fields matching and everything okay
		return TRUE;
		}
		else
		{
		// return false means in excel file fields not matching
		return FALSE;
		}
		exit;
	}
	
	function senddatatodb($file,$vendortemplatedetails,$vendorid,$ignorelines)
	{
		
		$columns = array();
		$columval = 0;
		$csv = new parseCSV();
		$csv->offset = $ignorelines;
		$csv->auto(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$file);
		// template details
		$exceltemp = "$vendortemplatedetails->template_excelstructure";
		$exceltem = explode(',',$exceltemp);
		$databasetemp = "$vendortemplatedetails->template_dbstructure";
		//echo "<pre>";
		//print_r($csv->data[1]);
		$title = $csv->titles;
		$realtitlearray = explode(',',$title[0]);
		//echo "</pre>";
		//echo $csv->data[1]["BRAND NAME"];
		//exit;
		$databasetem = explode(',',$databasetemp);
		$dbsize = sizeof($databasetem)-1;
		$numrows = sizeof($csv->data);
		$numcol = sizeof($csv->data);
		// template details
		// find column numbers we want to insert
		for($i=1;$i<$numcol;$i++)
        {
		for($j=0;$j<$dbsize;$j++)
		{
        $databasetems["$databasetem[$j]"] = $csv->data[$i]["$exceltem[$j]"];
					if($databasetem[$j] == "product_upc")
					{
						$data = str_replace(' ', '', $databasetems["$databasetem[$j]"]);
						$currentupc = $data;
					}elseif($databasetem[$j] == "product_sku")
					{
						$data = str_replace(' ', '', $databasetems["$databasetem[$j]"]);
						$currentsku = $data;
					}
		}
		$databasetems['product_source'] = "$vendorid";
		$databasetems['status'] = 1;
		echo "<pre>";
		print_r($databasetems);
		echo "</pre>";
		$upc_exist = $this->check_sku_vendor($currentsku,$vendorid);
		if($upc_exist == FALSE)
		{
		$englishid = $this->insert_api_data($databasetems);
		}
		
		
        }
		
	}
	
	function check_sku_vendor($sku,$vendorid)
	{
	$this->db->select('product_upc,fpl_id,sppr_id');
	$this->db->where('product_sku',$sku);
	$this->db->where('product_source',$vendorid);
	$this->db->from('api_masterproducttable');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	{
	return TRUE;	
	}
	}
	
	function spanishupdate($upc,$vendorid,$updatestring)
	{
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->update('spenishdata',$updatestring);
	return TRUE;
	}
	
	function englishupdate($upc,$vendorid,$updatestring)
	{
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->update('finalproductlist',$updatestring);
	return TRUE;
	}
	
	function mastertable($upc,$vendorid,$updatestring)
	{
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->update('masterproducttable',$updatestring);
	return TRUE;
	}
	
	function insert_api_data($data)
	{
			$this->db->insert('api_masterproducttable',$data);
			return $this->db->insert_id();
	}
	
	function insertenglishdata($data)
	{
			$this->db->insert('finalproductlist',$data);
			return $this->db->insert_id();
	}
	
	function insertduplicatedata($data)
	{
			$this->db->insert('finaliseduplicateproductlist',$data);
			return $this->db->insert_id();
	}


	function insertspanishdata($data,$englishid)
	{
			$data['eng_id'] =  $englishid;
			$this->db->insert('spenishdata',$data);
			return $this->db->insert_id();
	}
	
	function masterdata($data)
	{
			$this->db->insert('masterproducttable',$data);
			return $this->db->insert_id();
	}
	
	function updateenglishdataspanishid($fpl_id,$spanishid)
	{
	$data = array (
			'spenish_id' => $spanishid
					);
	$this->db->where('fpl_id',$fpl_id);
	$this->db->update('finalproductlist',$data);
	return $this->db->affected_rows();
	}
	
    function getimage_mastertable($fpl_id,$product_upc,$vendor_id)
    {
        $this->db->select("product_img_path");
        $this->db->from("masterproducttable");
		$this->db->where("fpl_id",$fpl_id);
		$this->db->where("product_upc",$product_upc);
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
// echo $dataimages."<br>";
		$data = explode(",",$dataimages);
		// print_r($data);
		foreach($data as $imgvalue)
		{
// echo $imgvalue;
		$pos = strrchr("http://",strtolower($imgvalue));
		$pos1 = strrchr("www.",strtolower($imgvalue));
		if($pos or $pos1)
		{
		$imagename = $this->copyimgto_local($imgvalue,$vendor_id);
		$datainsert = array (
						'finalproductlist_fpl_id'=>$fpl_id,
						'img_name'=>"$imagename"
						);
		// echo "<pre>";
		// print_r($datainsert);
		// echo "</pre>";
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
	
	
	function copyimgto_local($url,$vendor_id)
	{
	$rand=rand(0,1000);
	$contents=file_get_contents($url);
	$filename = $vendor_id."_".date("D-M-YY-h-m-s")."_".$rand.".jpg";
	$save_path=PLUGINS_URL."/cropping/images/".$filename;
	file_put_contents($save_path,$contents);
	return $filename;
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
	
	
	
	function getvendorupdatetemplate($vid)
	{
        $this->db->select("*");
		$this->db->where("vendor_id",$vid);
        $this->db->from("update_api_qty_vendortemplate");
		$data = $this->db->get();
		return $data->row();
	}
	
	function senddataupdatetodb($file,$vendortemplatedetails,$vendorid,$ignorelines)
	{
		
		$columns = array();
		$columval = 0;
		$csv = new parseCSV();
		$csv->offset = $ignorelines;
		$csv->auto(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$file);
		// template details
		$exceltemp = "$vendortemplatedetails->template_excelstructure";
		$exceltem = explode(',',$exceltemp);
		$databasetemp = "$vendortemplatedetails->template_dbstructure";
		//echo "<pre>";
		//print_r($csv->data[1]);
		//echo "</pre>";
		//echo $csv->data[1]["BRAND NAME"];
		//exit;
		$databasetem = explode(',',$databasetemp);
		$dbsize = sizeof($databasetem)-1;
		$numrows = sizeof($csv->data);
		$numcol = sizeof($csv->data);
		// template details
		// find column numbers we want to insert
		for($i=1;$i<$numcol;$i++)
        {
		for($j=0;$j<$dbsize;$j++)
		{
        $databasetems["$databasetem[$j]"] = $csv->data[$i]["$exceltem[$j]"];
					if($databasetem[$j] == "sku")
					{
						$data = str_replace(' ', '', $databasetems["$databasetem[$j]"]);
						$currentsku = $data;
					}
		}
		$databasetems['status'] = 1;
		echo "<pre>";
		print_r($databasetems);
		echo "</pre>";
		$sku_exist = $this->check_sku_exist_related($currentsku);
		if($sku_exist == TRUE)
		{
		$skuin_api_update = $this->check_sku_in_api_table($currentsku);
		if($skuin_api_update == TRUE)
		$englishid = $this->update_in_api_table_data($databasetems,$currentsku);
		else
		$englishid = $this->insert_in_api_table_data($databasetems);
		}
		
		
        }
		
	}
	
	function update_in_api_table_data($data,$currentsku)
	{
	unset($data['sku']);
	$this->db->where('sku',$currentsku);
	$this->db->update('api_inventry',$data);
	return TRUE;
	}
	
	function insert_in_api_table_data($data)
	{
	$this->db->insert('api_inventry',$data);
	return TRUE;
	}
	
	function check_sku_in_api_table($sku)
	{
	$this->db->select('*');
	$this->db->where('sku',$sku);
	$this->db->from('api_inventry');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return TRUE;	
	else
	return FALSE;
	}
	
	function check_sku_exist_related($sku)
	{
	$this->db->select('*');
	$this->db->where('productsku',$sku);
	$this->db->from('relatedproducts_magento');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	{
	return TRUE;	
	}
	else
	return FALSE;
	}		
	
	
}
?>