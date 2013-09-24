<?php

class addcontentm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	function pending_products(){
		
		$user_id = $this->session->userdata('user_id');
		$this->db->select('mpt_id,fpl_id, prduct_name, product_sku, product_upc, product_brand, product_source, status,priority,comment');
		$this->db->from('masterproducttable');
		$this->db->where("( status = 2 OR status = 13 )");
		$this->db->where('user_assign =', $user_id);
		$this->db->group_by('product_sku');
		$this->db->order_by("priority", "desc");
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
			return $data;
		}
			else
			{
			return FALSE;
        	
        }
		
	}
	
	function getallqafailed()
	{
	$this->db->select('*');
	$this->db->from('qafailedcase');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->result();
	else
	return FALSE;
	}
	
	function get_brand_dropdown()
	{
	$this->db->select("*");
	$this->db->where('status',1);
	$this->db->from('brandmanagement');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$return="<select name='pBrand' id='pBrand'><option value=''>Please select brand</option>";
	$value=$data->result();
	foreach($value as $values)
	{
	$return.="<option value=".$values->bMagentoId.">";
	$return.=$values->brandName;
	$return.="</option>";
	}
	$data->row();
	$return.="</select>";
	return $return;
	}
	else
	{
	return false;	
	}
	}
	
	
	
    function listvendordetails()
    {
     $this->db->select("*");
     $this->db->from("vendormanagement");
	 $query = $this->db->get();
	 if($query->num_rows())
	 {
		return $query->result(); 
	 }
	 else
	 {
		 return FALSE;
	 }
	}

	function update_upc_id($upc,$productsource)
	{
		
		$data = array(
		   'status' => '4'
		);
		$this->db->where('product_upc',$upc);
		$this->db->where('product_source',$productsource);
		$this->db->update('masterproducttable',$data);
		return true;
	}

	function check_duplicate_upc($upc,$productsource)
	{
		$query = mysql_query("select * from masterproducttable where product_upc=$upc AND product_source!=$productsource");
		if(mysql_num_rows($query) > 0 )
		return true;
		else
		return false;
	}
	
	function productwiz($upc,$productsource){
	
		// Update extra products data with same UPC start
		$result_duplicate = $this->check_duplicate_upc($upc,$productsource);
		if($result_duplicate)
		$this->update_trush($upc,$productsource);
		// Update extra products data with same UPC ends
		$this->db->select('*');
		$this->db->from('masterproducttable');
		$this->db->where('product_upc', $upc);
//		$this->db->limit(1);
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                //$data[''] = $row;
				
				$pname[] = $row['prduct_name'];
				$psku[] = $row['product_sku'];
				$pupc[] = $row['product_upc'];
				$pcost[] = $row['product_cost'];
				
				$pretail[] = $row['product_retail'];
				$pmsrp[] = $row['product_msrp'];
				$pmap[] = $row['product_map'];
				$pimg[] = $row['product_img_path'];
				$pId[] = $row['mpt_id'];
				$brand[] = $row['product_brand'];
				$psdesc[] = $row['short_description'];
				$pdesc[] = $row['product_description'];
				$pfeature[] = $row['product_features'];
				$pspecs[] = $row['product_specs'];
				$psource[] = $row['product_source'];
				$height = $row['height'];
				$width = $row['width'];
				$length = $row['length'];
				$weight = $row['weight'];
				
				$etilizeproid = $row['etilizeProId'];
				
				/*$sql = 'select vendorName from vendormanagement where vendorID = "'.$row['product_source'].'"';
				$re = mysql_query($sql);
				$ro = mysql_fetch_array($re);
				$psource[] = $ro['vendorName'];*/
            }

			$data['pname'] =	$pname;
			$data['psku'] = $psku;
			$data['pupc'] = $pupc;
			$data['pcost'] = $pcost;
			$data['pretail'] = $pretail;
			$data['pmsrp'] = $pmsrp;
			$data['pmap'] = $pmap;
			$data['psource'] = $psource;
			$data['pimg'] = $pimg;
			$data['brand'] = $brand;
			$data['pId'] = $pId;
			$data['psdesc'] = $psdesc;
			$data['pdesc'] = $pdesc;
			$data['pfeature'] = $pfeature;
			$data['psource'] = $psource;
			$data['pspecs'] = $pspecs;
			$data['height'] = $height;
			$data['width'] = $width;
			$data['length'] = $length;
			$data['weight'] = $weight;		
				
					
			}
		
		return $data;

        }
	
	
    function translateplaintext($str){
	
		$client = new apiClient();
		$client->setApplicationName('Google Translate PHP Starter Application');
		
		// Visit https://code.google.com/apis/console?api=translate to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setDeveloperKey('AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ');
		$service = new apiTranslateService($client);
		
		$translations = $service->translations->listTranslations($str, 'es');
		//print "<h1>Translations</h1><pre>" . print_r($translations, true) . "</pre>";
		
		
		return $translations['translations'][0]['translatedText'];
	
	}


	function splitstring($str){
		
		$client = new apiClient();
		$client->setApplicationName('Google Translate PHP Starter Application');
		
		// Visit https://code.google.com/apis/console?api=translate to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setDeveloperKey('AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ');
		$service = new apiTranslateService($client);
		$s = preg_split ('/$\R?^/m', $str);
		$v = array();
		for($i=0;$i<sizeof($s);$i++){
			
			$translations = $service->translations->listTranslations($s[$i], 'es');
			
			$v[] = $translations['translations'][0]['translatedText'];
						
			//$v[] = $this->translate(htmlspecialchars_decode($s[$i]));
		}
		
		$string =  implode('<br>',$v);
		
		return $string;

	}
	
	function addenglishready($productupc,$productsource){
		
		$this->update_upc_id($productupc,$productsource);
		$query = 'select priority from masterproducttable where product_upc = "'.$_POST['pupc'].'"';
		$re = mysql_query($query);
		$ro = mysql_fetch_array($re);
		$user_id = $this->session->userdata('user_id');
		$finaproductdata = array (
			'prduct_name'=>htmlspecialchars($this->input->post('pName')),
			'short_description'=>htmlspecialchars($this->input->post('finalpsdesc')),
			'product_description'=>htmlspecialchars($this->input->post('pDesc')),
			'product_sku'=>htmlspecialchars($this->input->post('pSku')),
			'product_upc'=>htmlspecialchars($this->input->post('pupc')),
			'height'=>htmlspecialchars($this->input->post('pHeight')),
			'width'=>htmlspecialchars($this->input->post('pWidth')),
			'length'=>htmlspecialchars($this->input->post('pLength')),
			'weight'=>htmlspecialchars($this->input->post('pWeight')),
			'eng_video'=>htmlspecialchars($this->input->post('pVideoLink')),
			'product_metatags'=>htmlspecialchars($this->input->post('mKeywords')),
			'product_metadescription'=>htmlspecialchars($this->input->post('mDescription')),
			'user_assign'=>htmlspecialchars($user_id),
			'product_specs'=>htmlspecialchars($this->input->post('pSpecs')),
			'product_source'=>htmlspecialchars($this->input->post('pSource')),
			'engdoneby'=>1,
			'inmagento'=>3,
			'status'=>1
								  );
								
		$updatedfinal = $this->db->insert("finalproductlist",$finaproductdata);
		$englishinsert_id = $this->db->insert_id();
	
	if($updatedfinal){
		
		  $spanishproductdata = array (
			'eng_id'=>$englishinsert_id,
			'prduct_name'=>htmlspecialchars($this->translateplaintext($_POST['pName'])),
			'short_description'=>htmlspecialchars($this->translateplaintext($_POST['finalpsdesc'])),
			'product_description'=>htmlspecialchars($this->splitstring($_POST['pDesc'])),
			'product_sku'=>htmlspecialchars($_POST['pSku']),
			'product_upc'=>htmlspecialchars($_POST['pupc']),
			'height'=>htmlspecialchars($_POST['pHeight']),
			'width'=>htmlspecialchars($_POST['pWidth']),
			'length'=>htmlspecialchars($_POST['pLength']),
			'weight'=>htmlspecialchars($_POST['pWeight']),
			'product_metatags'=>htmlspecialchars($this->splitstring($this->input->post('mKeywords'))),
			'product_metadescription'=>htmlspecialchars($this->splitstring($this->input->post('mDescription'))),
			'user_assign'=>htmlspecialchars($user_id),
			'product_specs'=>htmlspecialchars($this->splitstring($_POST['pSpecs'])),
			'product_source'=>htmlspecialchars($this->input->post('pSource')),
			'engdoneby'=>1,
			'inmagento'=>3,
			'status'=>1
								  );
		$updatedspanish = $this->db->insert("spenishdata",$spanishproductdata);
		$spanishinsert_id = $this->db->insert_id();
		// Update spanish ID starts
		$dataarray = array (
					'spenish_id'=>$spanishinsert_id
							); 
		$this->db->where('fpl_id',$englishinsert_id);
		$this->db->update('finalproductlist',$dataarray);
		// update spanis id ends
		// update english as well as spanish id in master table start
		$query = 'select mpt_id from masterproducttable where status != 11 AND product_sku = "'.$_POST['pSku'].'"';
		$re = mysql_query($query);
		while($r = mysql_fetch_array($re)){
			$q = "UPDATE `masterproducttable` SET `status` = '5',`engdoneby` = '1',`inmagento` = '1',`fpl_id` = $englishinsert_id,`sppr_id` = $spanishinsert_id WHERE `mpt_id` =".$r['mpt_id'];
			mysql_query($q);
		}
		// update english as well as spanish id in master table ends
		
		$msg = '<h4 class="alert_success">A Product Created Successfully</h4>';
	}else{
		$msg = '<h4 class="alert_error">Product is not inserted successfully</h4>';
	}
	
	return $msg;

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
	
	function copyimgto_local($url,$vendor_id)
	{
	$contents=file_get_contents($url);
	$filename = $vendor_id."_".date("D-M-YY-h-m-s").".jpg";
	$save_path=PLUGINS_URL."/cropping/images/".$filename;
	file_put_contents($save_path,$contents);
	return $filename;
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
	
	function get_product_images($fpl_id)
	{
        $this->db->select("*");
        $this->db->from("product_images");
		$this->db->where("finalproductlist_fpl_id",$fpl_id);
		$data = $this->db->get();
		return $data->result();
	}
	
    	
	function get_imageready_product($accesslevel,$user_id)
	{
	if($accesslevel != 3)
	$this->db->where('user_assign',$user_id);
	$this->db->select("*");
	$this->db->where('status','1');
	$this->db->where('inmagento','3');
	$this->db->where('engdoneby','1');
	$this->db->from('finalproductlist');
	$q = $this->db->get();
	if($q->num_rows() > 0) {
		foreach ($q->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}
	else
	{
	return FALSE;	
	}
	
	}
	
	function confirmproductothersm($fplid)
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
					'inmagento' => '4'
						  );
			$this->db->where('eng_id',$fplid);
			$this->db->update('spenishdata',$data);
			}
			// get Spanish ID of data to update done ends
			$data = array(
					'inmagento' => '4'
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
	
	function reviewcontentm()
	{
	$this->db->select('*');
	$this->db->where('status',5);
	$this->db->from('masterproducttable');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return $data->result();
	else
	return false;
	}
	
	function getothersproduct($mpt_id)
	{
	$this->db->select("*");
	$this->db->where("mpt_id",$mpt_id);
	$this->db->limit(1);
	$this->db->from("masterproducttable");
	$data = $this->db->get();
	$mpt_id_product = $data->row();
	if($mpt_id)
	{
		return $mpt_id_product;
	}
	else
	{
	return "Undefined Product";
	}
	}
	
	function getothersproductqa($mpt_id)
	{
	$this->db->select("*");
	$this->db->where("mpt_id",$mpt_id);
	$this->db->limit(1);
	$this->db->from("masterproducttable");
	$data = $this->db->get();
	$fpl_id = $data->row()->fpl_id;
	if($fpl_id)
	{
		$this->db->select('*');
		$this->db->where('fpl_id',$fpl_id);
		$this->db->from('finalproductlist');
		$datas = $this->db->get();
		if($datas->num_rows() > 0 )
		return $datas->row();
		else
		return FALSE;
	}
	else
	{
	return "Undefined Product";
	}
	}
	
	function getothersproductspqa($mpt_id)
	{
	$this->db->select("*");
	$this->db->where("mpt_id",$mpt_id);
	$this->db->limit(1);
	$this->db->from("masterproducttable");
	$data = $this->db->get();
	$sppr_id = $data->row()->sppr_id;
	if($sppr_id)
	{
		$this->db->select('*');
		$this->db->where('sppr_id',$sppr_id);
		$this->db->from('spenishdata');
		$datas = $this->db->get();
		if($datas->num_rows() > 0 )
		return $datas->row();
		else
		return FALSE;
	}
	else
	{
	return "Undefined Product";
	}
	}
	
	function get_fpl_id($mpt_id)
	{
	$this->db->select("*");
	$this->db->where("mpt_id",$mpt_id);
	$this->db->limit(1);
	$this->db->from("masterproducttable");
	$data = $this->db->get();
	$fpl_id = $data->row()->fpl_id;
	if($fpl_id)
	{
		return $fpl_id;
	}
	else
	{
	return "Undefined Product";
	}
	}
	
	function get_images($fpl_id)
	{
		$this->db->select('*');
		$this->db->where('finalproductlist_fpl_id',$fpl_id);
		$this->db->from('product_images');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function rejectdata($mptid,$commment,$allVals)
	{
	$commment.="<br>Problem Header : <br>";
	$commentsize = sizeof($allVals);
	for($i=0;$i<$commentsize;$i++)
	{
	$commment.=$allVals[$i]."<br>";
	}
	$data = array (
			'comment' => "$commment",
			'status'=>13
					);
	$this->db->where('mpt_id',$mptid);
	$this->db->update('masterproducttable',$data);
	$result = $this->db->affected_rows();
	if($result > 0)
	return '1';
	else
	return '0';
	}
	
	function getothersmasterproductqa($mpt_id)
	{
	$this->db->select("*");
	$this->db->where("mpt_id",$mpt_id);
	$this->db->limit(1);
	$this->db->from("masterproducttable");
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	return $data->row();	
	}
	else
	{
	return "Undefined Product";
	}
	}
	
	function rejectdatabyuser($mptid,$commment,$allVals)
	{
	$getcontent = $this->getothersmasterproductqa($mptid);
	if($getcontent->engdoneby != "1")
	{
		$useridget = explode('_',$getcontent->engdoneby);
		$useridtarget = $useridget[1];
	}
	// creting comments
	$commment.="<br>Problem Header :<br>";
	$commentsize = sizeof($allVals);
	for($i=0;$i<$commentsize;$i++)
	{
	$commment.=$allVals[$i]."<br>";
	}
	// endsing comments
	$data = array (
			'comment' => "$commment",
			'user_assign' =>$useridtarget,
			'engdoneby' =>1,
			'status'=>13
					);
	$this->db->where('mpt_id',$mptid);
	$this->db->update('masterproducttable',$data);
	$result = $this->db->affected_rows();
	
	if($result > 0)
	return '1';
	else
	return '0';
	}
	
	function notefaileddata($mptid,$commment)
	{
	$userid = $this->session->userdata('user_id');
	$data = array (
			'mpt_id'=>$mptid,
			'userid'=>$userid,
			'comment' => "$commment"
					);
	$this->db->insert('qafailedcontent',$data);
	$result = $this->db->affected_rows();
	if($result > 0)
	return '1';
	else
	return '0';
	}
	
	function editenglishready()
		{
		$user_id = $this->session->userdata('user_id');
		$finaproductdata = array (
					'prduct_name'=>htmlspecialchars($this->input->post('pName')),
					'short_description'=>htmlspecialchars($this->input->post('finalpsdesc')),
					'product_description'=>htmlspecialchars($this->input->post('pDesc')),
					'height'=>htmlspecialchars($this->input->post('pHeight')),
					'width'=>htmlspecialchars($this->input->post('pWidth')),
					'length'=>htmlspecialchars($this->input->post('pLength')),
					'weight'=>htmlspecialchars($this->input->post('pWeight')),
					'eng_video'=>htmlspecialchars($this->input->post('pVideoLink')),
					'product_metatags'=>htmlspecialchars($this->input->post('mKeywords')),
					'product_metadescription'=>htmlspecialchars($this->input->post('mDescription')),
					'product_specs'=>htmlspecialchars($this->input->post('pSpecs')),
					'engdoneby'=>1,
					'inmagento'=>3,
					'status'=>1
								  );
		$this->db->where('fpl_id',$this->input->post('pFplid'));
		$updatedfinal = $this->db->update("finalproductlist",$finaproductdata);
		$englishinsert_id = $this->db->affected_rows();
	
	if($updatedfinal){
		
		  $spanishproductdata = array (
			'eng_id'=>$englishinsert_id,
			'prduct_name'=>htmlspecialchars($this->translateplaintext($_POST['pName'])),
			'short_description'=>htmlspecialchars($this->translateplaintext($_POST['finalpsdesc'])),
			'product_description'=>htmlspecialchars($this->splitstring($_POST['pDesc'])),
			'height'=>htmlspecialchars($_POST['pHeight']),
			'width'=>htmlspecialchars($_POST['pWidth']),
			'length'=>htmlspecialchars($_POST['pLength']),
			'weight'=>htmlspecialchars($_POST['pWeight']),
			'spanish_video'=>htmlspecialchars($this->input->post('pVideoLink')),
			'product_metatags'=>htmlspecialchars($this->splitstring($this->input->post('mKeywords'))),
			'product_metadescription'=>htmlspecialchars($this->splitstring($this->input->post('mDescription'))),
			'product_specs'=>htmlspecialchars($this->splitstring($_POST['pSpecs'])),
			'engdoneby'=>1,
			'inmagento'=>3,
			'status'=>1
								  );
		$this->db->where('sppr_id',$this->input->post('pSpenishid'));
		$updatedspanish = $this->db->update("spenishdata",$spanishproductdata);
		$spanishinsert_id = $this->db->affected_rows();
		
		// update mamster table status change 13 to 5  so admin can see and test
		$datamasters = array (
						'status' => 5,
						'engdoneby'=>1,
						'inmagento'=>1
								);
		$this->db->where('fpl_id',$this->input->post('pFplid'));
		$this->db->where('sppr_id',$this->input->post('pSpenishid'));
		$this->db->update('masterproducttable',$datamasters);
		
		// update master table status ends
		
		
		$msg = '<h4 class="alert_success">A Product Created Successfully</h4>';
	}else{
		$msg = '<h4 class="alert_error">Product is not inserted successfully</h4>';
	}
	
	return $msg;

	}
	
	function processproducts(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			$getcontent = $this->getothersmasterproductqa($id);
			if($getcontent->engdoneby == 1 )
			{
			$data = array(
               'status' => '2',
			   'user_assign' => $this->input->get('userid'),
			   'engdoneby' => "1_".$getcontent->user_assign,
			   'priority' => $_GET['priority']
            );
			}
			else
			{
			$data = array(
               'status' => '2',
			   'user_assign' => $this->input->get('userid'),
			   'priority' => $_GET['priority']
            );
			}
			$this->db->where('mpt_id', $id);
			$this->db->where('status', '5');
			if($this->db->update('masterproducttable', $data)){
				$err = 0;
			}else{
				$err = 1;
			}
		}
		if($err == 0){
			
			$msg = '<span class="label label-success">Products Processed Successfully</span>';
		}else{
			$msg = 'Products are not processed successfully';
		}
		
		return $msg;
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
	
	function get_disclaimer()
	{
	$this->db->select('*');
	$this->db->where('status',1);
	$this->db->from('disclaimermanagement');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return $data->result();
	else
	return false;	
	}
	
	function updatecontentdone()
	{
	$collectcat = "";
		// category create attribute string starts
		$user_id = $this->session->userdata("user_id");
		$categories = $_POST['category'];
		$att = "";
		$catattributes = $this->get_cat_attributes($categories[0]);
		$collectcat1 = $categories[0];
		foreach($catattributes as $catatvalues)
		{
		$getpost = "subattributes_".$catatvalues->id;
		$datreceive = $_POST[$getpost];
		if($catatvalues->section_scope == 2)
		{
		$catatsize = sizeof($datreceive);
		for($i=0;$i<$catatsize;$i++)
		$collectcat.=$datreceive[$i].",";
		$attsub = "($getpost - $collectcat)";
		$att.= $attsub;
		}
		else
		{
			$att.= "($getpost - $datreceive)";
		}
		}
		$addoncategories = $_POST['addoncategory'];
		if(sizeof($addoncategories) > 0)
		{
		// print_r($addoncategories);
		$selectionnum=sizeof($addoncategories);
		for($i=0;$i<$selectionnum;$i++)
		$collectcat1.="_".$addoncategories[$i];
		}
		// category create attribute string starts
		// keword and description 
		if(isset($_POST['keywords']))
		$keywords = $_POST['keywords'];
		else
		$keywords = "";
		if(isset($_POST['keyworddescription']))
		$keyworddescription = $_POST['keyworddescription'];
		else
		$keyworddescription = "";
		//
		// Date Format Conversation start
		if($_POST['pSpecialFromDate'] != "")
		{
		$FromDate = date("Y-m-d", strtotime($_POST['pSpecialFromDate']));
		}
		else
		{
		$specialPrice = "";
		$FromDate = "";
		$ToDate = "";
		}
		if($_POST['pSpecialToDate'] != "")
		{
		$ToDate = date("Y-m-d", strtotime($_POST['pSpecialToDate']));
		}
		else
		{
		$specialPrice = "";
		$FromDate = "";
		$ToDate = "";
		}
		if($_POST['pSpecialPrice'] == "")
		{
		$specialPrice = "";
		$FromDate = "";
		$ToDate = "";
		}
		
		// Date format Conversation ends
		$finaproductdata = array (
					'product_category'=>htmlspecialchars($collectcat1),
					'prduct_name'=>htmlspecialchars($_POST['pName']),
					'short_description'=>htmlspecialchars($_POST['pFeature']),
					'product_description'=>htmlspecialchars($_POST['pDesc']),
					'product_specs'=>htmlspecialchars($_POST['pSpecs']),
					'product_disclaimer'=>$_POST['pDisclaimer'],
					'product_sku'=>htmlspecialchars($_POST['pSku']),
					'product_cost'=>htmlspecialchars($_POST['pcost']),
					'product_upc'=>htmlspecialchars($_POST['pupc']),
					'product_msrp'=>htmlspecialchars($_POST['pmsrp']),
					'product_retail'=>htmlspecialchars($_POST['pretail']),
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'height'=>htmlspecialchars($_POST['pHeight']),
					'width'=>htmlspecialchars($_POST['pWidth']),
					'length'=>htmlspecialchars($_POST['pLength']),
					'weight'=>htmlspecialchars($_POST['pWeight']),
					'user_assign'=>htmlspecialchars($user_id),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'specialprice'=>$specialPrice,
					'specialfromdate'=>$FromDate,
					'specialtodate'=>$ToDate,
					'shippingprice'=>$_POST['pShipping'],
					'product_metatags'=>htmlspecialchars($keywords),
					'product_metadescription'=>htmlspecialchars($keyworddescription),
					'isset'=>htmlspecialchars($_POST['pisset']),
					'attributes'=>htmlspecialchars($att),
					'onlineonly'=>htmlspecialchars($_POST['ponlineonly']),
					'inmagento'=> '1'
								  );
		$this->db->where('fpl_id',$this->input->post('fpl_id'));
		$this->db->where('spenish_id',$this->input->post('sppr_id'));
		$this->db->update("finalproductlist",$finaproductdata);
		$englishupdated = $this->db->affected_rows();
	
	if($englishupdated){
		
		  $spanishproductdata = array (
					'product_category'=>htmlspecialchars($collectcat1),
					'prduct_name'=>htmlspecialchars($_POST['spName']),
					'short_description'=>htmlspecialchars($_POST['spFeature']),
					'product_description'=>htmlspecialchars($_POST['spDesc']),
					'product_specs'=>htmlspecialchars($_POST['spSpecs']),
					'product_disclaimer'=>$_POST['pDisclaimer'],
					'product_sku'=>htmlspecialchars($_POST['pSku']),
					'product_upc'=>htmlspecialchars($_POST['pupc']),
					'product_msrp'=>htmlspecialchars($_POST['pmsrp']),
					'product_retail'=>htmlspecialchars($_POST['pretail']),
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'height'=>htmlspecialchars($_POST['pHeight']),
					'width'=>htmlspecialchars($_POST['pWidth']),
					'length'=>htmlspecialchars($_POST['pLength']),
					'weight'=>htmlspecialchars($_POST['pWeight']),
					'user_assign'=>htmlspecialchars($user_id),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'specialprice'=>$specialPrice,
					'specialfromdate'=>$FromDate,
					'specialtodate'=>$ToDate,
					'shippingprice'=>$_POST['pShipping'],
					'product_metatags'=>htmlspecialchars($keywords),
					'product_metadescription'=>htmlspecialchars($keyworddescription),
					'isset'=>htmlspecialchars($_POST['pisset']),
					'attributes'=>htmlspecialchars($att),
					'onlineonly'=>htmlspecialchars($_POST['ponlineonly']),
					'inmagento'=> '1'
								  );
		$this->db->where('eng_id',$this->input->post('fpl_id'));
		$this->db->where('sppr_id',$this->input->post('sppr_id'));
		$updatedspanish = $this->db->update("spenishdata",$spanishproductdata);
		$englishupdated = $this->db->affected_rows();
		
		// Update master table start
		$this->update_master_status($this->input->post('fpl_id'),$this->input->post('sppr_id'));
		// Update master table ends 
		
	}	
		redirect(BASE_URL.'/contentsearch/pending/');
		exit;
	}
	
		function get_cat_attributes($catid)
		{
		$this->db->select("*");
		$this->db->where("categoryid",$catid);
		$this->db->from("attribute_types");
		$result = $this->db->get();
		if($result->num_rows() > 0 )
		{
		return $result->result();	
		}
		else
		{
		return FALSE;	
		}
		}
	
	
	function update_master_status($fpl_id,$sppr_id)
	{
		$data = array (
				'status' =>14
						);
		$this->db->where('fpl_id',$fpl_id);
		$this->db->where('sppr_id',$sppr_id);
		$this->db->update('masterproducttable',$data);
		return TRUE;
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
	
	
}
?>
