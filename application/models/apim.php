<?php
class apim extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/excelreader/reader.php');
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
	
	function getvendortemplates($vid)
	{
        $this->db->select("*");
		$this->db->where("vendor_id",$vid);
		$this->db->where("level",$vid);
        $this->db->from("update_vendortemplate");
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
	$filelocation  = $vendordetails->filelocation;
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
	$sourcepath=$filelocation."/".$vendordetails->filename;
	$newfilename = date("D-M-Y-H-s")."-".$vendorName.".xls";
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
	
	function matchexcelfields($file,$vendortemplatedetails)
	{
		$error = array();
		$count = 0;
		// echo $file;
	    $excel = new Spreadsheet_Excel_Reader();
	    $excel->read(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$file);
	    $x=2;
		// $headerrownum = $this->findheaderrow("$file");
	    $numcolums = $excel->sheets[0]['numCols'];
		$vendortemplatearray = array_filter(explode(",",$vendortemplatedetails));
		$headerrownum = $this->findheaderrow("$file",$vendortemplatearray);
		$vtemplatesize = sizeof($vendortemplatearray);
		// find header row start
		$headerrownum = $this->findheaderrow("$file",$vendortemplatearray);
		// find header row ends
	    for($i=1;$i<=$numcolums;$i++)
		{
		$dataa = $excel->sheets[0]['cells'][$headerrownum][$i];
		if(in_array($dataa,$vendortemplatearray))
		{
		$count = $count +1;
		$error[] = TRUE;
		}
		else
		{
		$error[] = "Exist";
		}
		}
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
	
	function findheaderrow($filename,$vendortemplatearray)
	{
	   $matchingcount = 0;
	   $headerrowis = 0;
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$filename);
	   $vendortemplatedbsize = sizeof($vendortemplatearray);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
		// find headers in excel sheet start
	   for($i=1;$i<=$numrows;$i++)
	   {
	   for($jj=0;$jj<=$numcolums;$jj++)
	   {
	   if(isset($excel->sheets[0]['cells'][$i][$jj]))
	   {
		$matchingdata = $excel->sheets[0]['cells'][$i][$jj];
		if(in_array($matchingdata,$vendortemplatearray))
	   {
		   $matchingcount = $matchingcount+1;
	   }
	   }
	   else
	   {
	   $data = "";
	   }
	   }
	   if($matchingcount == $vendortemplatedbsize)
	   {
	   return $headerrowis = $i;
	   }
	   }
	   return $headerrowis;
	   // find headers in excel sheet ends
	}
	
	function senddatatodb($file,$vendortemplatedetails,$vendorid)
	{
		
		$columns = array();
		$matchingcount = 0;
		$headerrowis =0;
		$vendortemplateexcels = $vendortemplatedetails->template_excelstructure;
		$vendortemplatedb = $vendortemplatedetails->template_dbstructure;
		$vendortemplatedbrray = array_filter(explode(",",$vendortemplatedb));
		$vendortemplatedbsize = sizeof($vendortemplatedbrray);
		$vendortemplatearray = array_filter(explode(",",$vendortemplateexcels));
		echo "<pre>";
		print_r($vendortemplatearray);
		echo "</pre>";
		$vtemplatesize = sizeof($vendortemplatearray);
		// print_r($vendortemplatearray)."<br>";
		// column postion in excel start
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
	   
	   // find headers in excel sheet start
	   // find header row start
		echo $headerrownum = $this->findheaderrow("$file",$vendortemplatearray);
		// find header row ends
	   // find headers in excel sheet ends
	   for($i=0;$i<=$numcolums;$i++){
		if(isset($excel->sheets[0]['cells'][$headerrownum][$i]))
	   $data = $excel->sheets[0]['cells'][$headerrownum][$i];
	   else
	   $data = "";
	   if(in_array($data,$vendortemplatearray))
	   {
		  $key = array_search($data,$vendortemplatearray);
		  $arraykey[] =  $key;
		  $columns[] =  $i;
	   }
			}
			// echo "<br><pre>";
			// print_r($arraykey);
			// echo "</pre>";
			// echo "<br><pre>";
			// print_r($vendortemplatearray);
			// echo "</pre>";
			$arraysize = sizeof($arraykey);
			$newarray = array();
			for($i=0;$i<$arraysize;$i++)
			{
				$value = $arraykey[$i];
				$newarray[] = $vendortemplatedbrray[$value];
			}
			// echo "<br><pre>";
			// print_r($newarray);
			// echo "</pre>";
			// echo "<br>Column numberss<pre>";
			// print_r($columns);
			$numberofcolumnsadd = sizeof($columns);
			// echo "<br>".$numrows;
			// echo "</pre>";
			
			// makeing query for data entering in database - first array start
			
			for($i=$headerrownum+1;$i<=$numrows;$i++){
				$dbdataarray = array();
			for($j=0;$j<$numberofcolumnsadd;$j++){
				$columnval = $columns[$j];
			if(isset($excel->sheets[0]['cells'][$i][$columnval]))
		   			$data = $excel->sheets[0]['cells'][$i][$columnval];
		   			else
		   			$data = "";
					if($newarray[$j] == "product_upc")
					{
						$data = str_replace(' ', '', $data);
						$currentupc = $data;
					}elseif($newarray[$j] == "product_sku")
					{
						$data = str_replace(' ', '', $data);
						$currentsku = $data;
					}
    	   			$dbdataarray[$newarray[$j]] = htmlspecialchars($data, ENT_QUOTES);
				}
			$dbdataarray['product_source'] = "$vendorid";
			$dbdataarray['engdoneby'] = 1;
			$dbdataarray['inmagento'] = 4;
			$dbdataarray['status'] = 1;
			echo "<br><pre>";
			print_r($dbdataarray);
			echo "<br></pre>";
			$upc_exist = $this->check_sku_vendor($currentsku,$vendorid);
			if($upc_exist == FALSE)
			{
			$englishid = $this->insert_api_data($dbdataarray);
			}
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			
			// makeing query for data entering in database - first array ends
		
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

	
	
	
	
	function senddatatoupdatedb($file,$vendortemplatedetails,$vendorid)
	{
		
		$columns = array();
		$matchingcount = 0;
		$headerrowis =0;
		$vendortemplateexcels = $vendortemplatedetails->template_excelstructure;
		$vendortemplatedb = $vendortemplatedetails->template_dbstructure;
		$vendortemplatedbrray = array_filter(explode(",",$vendortemplatedb));
		$vendortemplatedbsize = sizeof($vendortemplatedbrray);
		$vendortemplatearray = array_filter(explode(",",$vendortemplateexcels));
		echo "<pre>";
		print_r($vendortemplatearray);
		echo "</pre>";
		$vtemplatesize = sizeof($vendortemplatearray);
		// print_r($vendortemplatearray)."<br>";
		// column postion in excel start
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/remoteftp/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
	   
	   // find headers in excel sheet start
	   // find header row start
		echo $headerrownum = $this->findheaderrow("$file",$vendortemplatearray);
		// find header row ends
	   // find headers in excel sheet ends
	   for($i=0;$i<=$numcolums;$i++){
		if(isset($excel->sheets[0]['cells'][$headerrownum][$i]))
	   $data = $excel->sheets[0]['cells'][$headerrownum][$i];
	   else
	   $data = "";
	   if(in_array($data,$vendortemplatearray))
	   {
		  $key = array_search($data,$vendortemplatearray);
		  $arraykey[] =  $key;
		  $columns[] =  $i;
	   }
			}
			// echo "<br><pre>";
			// print_r($arraykey);
			// echo "</pre>";
			// echo "<br><pre>";
			// print_r($vendortemplatearray);
			// echo "</pre>";
			$arraysize = sizeof($arraykey);
			$newarray = array();
			for($i=0;$i<$arraysize;$i++)
			{
				$value = $arraykey[$i];
				$newarray[] = $vendortemplatedbrray[$value];
			}
			// echo "<br><pre>";
			// print_r($newarray);
			// echo "</pre>";
			// echo "<br>Column numberss<pre>";
			// print_r($columns);
			$numberofcolumnsadd = sizeof($columns);
			// echo "<br>".$numrows;
			// echo "</pre>";
			
			// makeing query for data entering in database - first array start
			
			for($i=$headerrownum+1;$i<=$numrows;$i++){
				$dbdataarray = array();
			for($j=0;$j<$numberofcolumnsadd;$j++){
				$columnval = $columns[$j];
			if(isset($excel->sheets[0]['cells'][$i][$columnval]))
		   			$data = $excel->sheets[0]['cells'][$i][$columnval];
		   			else
		   			$data = "";
					if($newarray[$j] == "sku")
					{
						$data = str_replace(' ', '', $data);
						$currentsku = $data;
					}
    	   			$dbdataarray[$newarray[$j]] = htmlspecialchars($data, ENT_QUOTES);
				}
			$dbdataarray['status'] = 1;
			echo "<br><pre>";
			print_r($dbdataarray);
			echo "<br></pre>";
			$upc_exist = $this->check_sku_exist_vendor($currentsku);
			if($upc_exist == FALSE)
			{
			$apitablecondition = $this->check_sku_exist_apitable($currentsku);
			if($apitablecondition == TRUE)
			$englishid = $this->update_api_inventry($dbdataarray,$currentsku);
			else
			$englishid = $this->insert_api_inventry($dbdataarray);
			}
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			
			// makeing query for data entering in database - first array ends
		
	}
	
	function insert_api_inventry($data)
	{
	$this->db->insert('api_inventry',$data);
	return $this->db->insert_id();
	}
	
	function update_api_inventry($data,$sku)
	{
	unset($data['sku']);
	$this->db->where('sku',$sku);
	$this->db->insert('api_inventry',$data);
	return $this->db->insert_id();
	}
	
	function check_sku_exist_apitable($sku)
	{
	$this->db->select('*');
	$this->db->where('sku',$sku);
	$this->db->from('api_inventry');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	{
	return TRUE;	
	}
	else
	return FALSE;
	}
	
	function check_sku_exist_vendor($sku)
	{
	$this->db->select('*');
	$this->db->where('productsku',$sku);
	$this->db->from('relatedproducts_magento');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	{
	return TRUE;	
	}
	}
	
	function getvendorupdatetemplate($vid)
	{
        $this->db->select("*");
		$this->db->where("vendor_id",$vid);
        $this->db->from("update_api_qty_vendortemplate");
		$data = $this->db->get();
		return $data->row();
	}
	
	
}
?>