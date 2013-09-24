<?php

class addfinalproductdatam extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/excelreader/reader.php');
		$process = 1;
    }
	
    function listfile($userid)
    {
        $this->db->select('*');
		$this->db->where('userid',$userid);
		$this->db->where('filefor',2);
		$this->db->where('status',1);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		return $data->result();
	}
	
	function filestatus($id)
	{
	if($id == 1 )
	return "Active";
	else
	return "File Processed";	
	}
	
    	function get_vendors()
	{
        $this->db->select('*');
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		return $data->result();
	}
	
	function get_filename($id,$userid)
	{
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->where('userid',$userid);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
		return $data->row();
		}
		else
		{
		redirect(BASE_URL.'/unauthorized');	
		}
	}
	
	function updatefilerecord($fileid,$userid)
	{
	$data = array (
		 		'status' => '2'
		 				);
		$this->db->where('id',$fileid);
		$this->db->where('userid',$userid);	
		$this->db->update('files_foraddproduct',$data);
		return TRUE;	
	}
	
	function verifyvendor($id)
	{
        $this->db->select('*');
        $this->db->where('vmID',$id);
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
		return TRUE;
		}
		else
		{
		redirect(BASE_URL.'/unauthorized');	
		}
	}
	
	function getvendortemplate($vid)
	{
        $this->db->select("*");
		$this->db->where("vendor_id",$vid);
        $this->db->from("vendortemplate");
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row();
		else
		return FALSE;
	}
	
	function matchexcelfields($file,$vendortemplatedetails)
	{
		$error = array();
		$count = 0;
		// echo $file;
	    $excel = new Spreadsheet_Excel_Reader();
	    $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	    $x=2;
	    $numcolums = $excel->sheets[0]['numCols'];
		$vendortemplatearray = array_filter(explode(",",$vendortemplatedetails));
		$vtemplatesize = sizeof($vendortemplatearray);
	    for($i=1;$i<=$numcolums;$i++)
		{
		$dataa = $excel->sheets[0]['cells'][1][$i];
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
	
	function senddatatodb($file,$vendortemplatedetails,$vendorid,$vendoruserid,$attributes)
	{
		$columns = array();
		if($attributes != '')
		{
		$attributesa = explode(',',$attributes);
		$attributesasize = sizeof($attributesa);
		}
		$vendortemplateexcels = $vendortemplatedetails->template_excelstructure;
		$vendortemplatedb = $vendortemplatedetails->template_dbstructure;
		$vendortemplatedbrray = array_filter(explode(",",$vendortemplatedb));
		$vendortemplatearray = array_filter(explode(",",$vendortemplateexcels));
		$vtemplatesize = sizeof($vendortemplatearray);
		// print_r($vendortemplatearray)."<br>";
		// column postion in excel start
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
	   for($i=0;$i<=$numcolums;$i++){
		if(isset($excel->sheets[0]['cells'][1][$i]))
	   $data = $excel->sheets[0]['cells'][1][$i];
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
			
			for($i=2;$i<=$numrows;$i++){
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
					}
    	   			$dbdataarray[$newarray[$j]] = htmlspecialchars($data, ENT_QUOTES);
				}
		if($attributes != '')
		{
			$dbdataarray['attributes']="";
			for($a=0;$a < $attributesasize;$a++)
			{
			$attributevalue = $this->getattribute_name_to_id($excel->sheets[0]['cells'][1][$attributesa[$a]]);
			$subattributevalue = $this->getsubattribute_name_to_id($excel->sheets[0]['cells'][$i][$attributesa[$a]]);
			$dbdataarray['attributes'].= "(subattributes_".$attributevalue."-".$subattributevalue.")";
			}
			}
			$dbdataarray['product_source'] = "$vendorid";
			$dbdataarray['user_assign'] = "$vendoruserid";
			$dbdataarray['engdoneby'] = 1;
			$dbdataarray['inmagento'] = 4;
			$dbdataarray['status'] = 1;
			// echo "<br><pre>";
			// print_r($dbdataarray);
			// echo "<br></pre>";
			$upc_exist = $this->check_upc_vendor($currentupc,$vendorid,$dbdataarray);
			if($upc_exist == FALSE)
			{
			$englishid = $this->insertenglishdata($dbdataarray);
			$spanishid = $this->insertspanishdata($dbdataarray,$englishid);
			$updateenglishid = $this->updateenglishdataspanishid($englishid,$spanishid);

			$dbdataarray['fpl_id']=$englishid;
			$dbdataarray['sppr_id']=$spanishid;
			$dbdataarray['status']=5;
			$this->masterdata($dbdataarray);
			// start copy images
			if(isset($dbdataarray['product_img_path']))
			{
				// echo $englishid."Move One<br>";
				// echo $englishid;
				// echo $dbdataarray['product_upc'];
				// echo $vendorid;
				$data_images_done = $this->getimage_mastertable($englishid,$dbdataarray['product_upc'],$vendorid);
			}
			// end copy images
			}
			else
			{
			// Duplicate UPC goes to finaliseduplicateproductlist start
			$englishid = $this->insertduplicatedata($dbdataarray);
			// Duplicate UPC goes to finaliseduplicateproductlist ends
			}
			// echo $this->db->last_query();exit;
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			
			// makeing query for data entering in database - first array ends
		
	}
	
	function getattribute_name_to_id($value)
	{
	$this->db->select('*');
	$this->db->where('attributename',"$value");
	$this->db->from('attribute_types');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
		return $data->row()->id;
	}
	else
	{
	return FALSE;	
	}
	}

	function cleaningdata($string) {
	   $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	
	   return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
	}
	
	function getsubattribute_name_to_id($value)
	{
	$this->db->select('*');
	$this->db->where('name',"$value");
	$this->db->from('attribute_types_sub');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
		return $data->row()->value;
	}
	else
	{
	return FALSE;	
	}
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
	
	function all_users()
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("access_level !=",1);
		$this->db->where("access_level !=",2);
		$users = $this->db->get();
		if($users->num_rows() > 0 )
		return $users->result();
		else
		return FALSE;
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
	
	
    function translateplaintext($str)
	{
		$client = new apiClient();
		$client->setApplicationName('Google Translate PHP Starter Application');
		$client->setDeveloperKey('AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ');
		$service = new apiTranslateService($client);
		$translations = $service->translations->listTranslations($str, 'es');
		return $translations['translations'][0]['translatedText'];		
	}


	function insertspanishdata($data,$englishid)
	{
			$data['eng_id'] =  $englishid;
			/* translate data starts		
			if(isset($data['prduct_name']))
			{
				$data['prduct_name'] = htmlspecialchars($data['prduct_name']);
			}
			if(isset($data['short_description']))
			{
				$data['short_description'] = htmlspecialchars($data['short_description']);
			}
			if(isset($data['product_description']))
			{
				$data['product_description'] = htmlspecialchars($data['product_description']);
			}
			if(isset($data['product_metatags']))
			{
				$data['product_metatags'] = htmlspecialchars($data['product_metatags']);
			}
			if(isset($data['product_metadescription']))
			{
				$data['product_metadescription'] = htmlspecialchars($data['product_metadescription']);
			}
			 translate data ends */
			$this->db->insert('spenishdata',$data);
			return $this->db->insert_id();
	}
	
	function masterdata($data)
	{
			$this->db->insert('masterproducttable',$data);
			return $this->db->insert_id();
	}
	
	function check_upc_vendor($upc,$vendorid,$dbdataarray)
	{
	$this->db->select('product_upc,fpl_id,sppr_id');
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->from('masterproducttable');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	{
		return TRUE;
	}
	else
	{
	return FALSE;	
	}
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
}
?>
