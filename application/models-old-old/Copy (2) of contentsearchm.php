<?php

class contentsearchm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    	
	function search_products(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc,product_brand,product_source, status');
		$this->db->from('masterproducttable');
		$this->db->where('status != ', 1);
		$this->db->order_by('dateandtime','DESC');
		if(strtolower($this->session->userdata('lname')) == 'vindia'){
			$this->db->where('status = ', 3);
		}
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
    	
	function search_products_raw(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc,product_brand,product_source, status');
		$this->db->from('masterproducttable');
		$this->db->where('status != ', 1);
		$this->db->where('status = ', 3);
		$this->db->order_by('dateandtime','DESC');
		if(strtolower($this->session->userdata('lname')) == 'vindia'){
			$this->db->where('status = ', 3);
		}
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	function get_product_detail($upc,$vendorid)
	{
	$this->db->select("*");
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->limit("1");
	$this->db->from('masterproducttable');
	$data = $this->db->get();
	return $data->row();
	}
	
    	
	function englshreadycontentshow(){
		
		$this->db->select("*");
		$this->db->where('status','1');
		$this->db->from('finalproductlist');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	function get_categories()
	{
	$this->db->select("*");
	$this->db->from("categories");
	$data = $this->db->get();
	return $data->result();	
	}
	
	function get_vendor_names($vendorid)
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
	
	function productimg_status($id)
	{
	$this->db->select("*");
	$this->db->from("product_images");	
	$this->db->where("mpt_id",$id);
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return TRUE;
	else
	return FALSE;
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
	
		function getproduct($vendorid)
		{
		$this->db->select("*");
		$this->db->where("mpt_id",$vendorid);
		$this->db->limit(1);
		$this->db->from("masterproducttable");
		$data = $this->db->get();
		$vendorname = $data->row();
		if($vendorname)
		{
			return $vendorname;
		}
		else
		{
		return "Undefined Product";
		}
		}
	
	function processproducts(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			
			$data = array(
               'status' => '2',
			   'priority' => $_GET['priority']
            );
			$this->db->where('mpt_id', $id);
			$this->db->where('status', '3');
			if($this->db->update('masterproducttable', $data)){
				$err = 0;
			}else{
				$err = 1;
			}
		}
		if($err == 0){
			
			 
			$activity = " Search Activity";
			$this->log->logdata($activity);
			
			$msg = '<span class="label label-success">Products Processed Successfully</span>';
		}else{
			$msg = 'Products are not processed successfully';
		}
		
		return $msg;
	}
	
	function pending_products(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc, product_brand, product_source, status,priority,comment');
		$this->db->from('masterproducttable');
		$this->db->where('status', 2);
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
	
    	
	function search_products_wiz(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc, product_brand, 	product_source, status');
		$this->db->from('masterproducttable');
		$this->db->where('status = ', 4);
		$this->db->order_by('dateandtime','DESC');
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
	
    	
	function englishreadycontentm(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc, product_brand,product_source, status');
		$this->db->from('masterproducttable');
		$this->db->where('status = ', 7);
		$this->db->order_by('dateandtime','DESC');
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
	
	function productwiz($upc){
	
		$data = array(
		   'status' => '4'
		);
		$this->db->where('product_upc', $upc);
		$this->db->update('masterproducttable', $data);
		
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
				
				$etilizeproid = $row['etilizeProId'];
				
				$sql = 'select vendorName from vendormanagement where vendorID = "'.$row['product_source'].'"';
				$re = mysql_query($sql);
				$ro = mysql_fetch_array($re);
				$psource[] = $ro['vendorName'];
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
			$data['pspecs'] = $pspecs;		
				
					
			}
		
		
		
		return $data;

        }
	
	
	function englishready(){
	
		$query = 'select priority from masterproducttable where product_upc = "'.$_POST['pupc'].'"';
		$re = mysql_query($query);
		$ro = mysql_fetch_array($re);
		$collectcat = "";
		$categories = $_POST['category'];
		$catsize = sizeof($categories);
		for($i=0;$i<$catsize;$i++)
		$collectcat.=$categories[$i]."_";
		$finaproductdata = array (
					'product_category'=>htmlspecialchars($collectcat),
					'prduct_name'=>htmlspecialchars($_POST['pName']),
					'short_description'=>htmlspecialchars($_POST['finalpsdesc']),
					'product_description'=>htmlspecialchars($_POST['pDesc']),
					'product_sku'=>htmlspecialchars($_POST['pSku']),
					'product_upc'=>htmlspecialchars($_POST['pupc']),
					'product_msrp'=>htmlspecialchars($_POST['pmsrp']),
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'product_features'=>htmlspecialchars($_POST['pFeature']),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'product_specs'=>htmlspecialchars($_POST['pSpecs']),
					'product_metatags'=>htmlspecialchars($_POST['keywords']),
					'product_metadescription'=>htmlspecialchars($_POST['keyworddescription']),
					'isset'=>htmlspecialchars($_POST['pisset']),
					'onlineonly'=>htmlspecialchars($_POST['ponlineonly'])
								  );
								
		$updatedfinal = $this->db->insert("finalproductlist",$finaproductdata);
		$englishinsert_id = $this->db->insert_id();
		
	
	if($updatedfinal){
		
		$query = 'select mpt_id from masterproducttable where product_sku = "'.$_POST['pSku'].'"';
		$re = mysql_query($query);
		while($r = mysql_fetch_array($re)){
			$q = "UPDATE `masterproducttable` SET `status` = '7' WHERE `mpt_id` =".$r['mpt_id'];
			mysql_query($q);
		}
		
		 
		  $spanishproductdata = array (
					'eng_id'=>$englishinsert_id,
					'product_category'=>htmlspecialchars($collectcat),
					'prduct_name'=>htmlspecialchars($this->translateplaintext($_POST['pName'])),
					'short_description'=>htmlspecialchars($this->translateplaintext($_POST['finalpsdesc'])),
					'product_description'=>htmlspecialchars($this->splitstring($_POST['pDesc'])),
					'product_sku'=>htmlspecialchars($_POST['pSku']),
					'product_upc'=>htmlspecialchars($_POST['pupc']),
					'product_msrp'=>htmlspecialchars($_POST['pmsrp']),
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'product_features'=>htmlspecialchars($this->splitstring($_POST['pFeature'])),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'product_specs'=>htmlspecialchars($this->splitstring($_POST['pSpecs'])),
					'product_metatags'=>htmlspecialchars($this->translateplaintext($_POST['keywords'])),
					'product_metadescription'=>htmlspecialchars($this->translateplaintext($_POST['keyworddescription'])),
					'isset'=>htmlspecialchars($_POST['pisset']),
					'onlineonly'=>htmlspecialchars($_POST['ponlineonly'])
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
		$msg = '<h4 class="alert_success">A Product Created Successfully</h4>';
	}else{
		$msg = '<h4 class="alert_error">Product is not inserted successfully</h4>';
	}
	
	return $msg;

	}
	
	function magentoque(){
		
		$this->db->select('prduct_name, product_sku, product_upc, product_brand, product_source, fpl_id, magento_product_id,mstatus');
		$this->db->from('finalproductlist');
		$this->db->join('magentoque', 'magentoque.finalproId = finalproductlist.fpl_id');
		$q = $this->db->get();
		
		 $act = array(
               'userId' => $this->session->userdata('user_id'),
               'activity' => $this->session->userdata('fname').' '.$this->session->userdata('lname').' has accessed final products' ,
               'date' => date('Y-m-d'),
			   'time' => date('h:i:s A')
            );
		  $this->db->insert('useractivity', $act); 
		
		
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	
	
	function pending_transition_products(){
		
		$this->db->select('prduct_name, product_sku, product_upc, product_brand, product_source,comment');
		$this->db->from('finalproductlist');
		$this->db->where('status', 0);
		$this->db->group_by('product_upc');
		$this->db->order_by("priority", "desc"); 
		$q = $this->db->get();
		
		 $act = array(
               'userId' => $this->session->userdata('user_id'),
               'activity' => $this->session->userdata('fname').' '.$this->session->userdata('lname').' has been in pending transition product section' ,
               'date' => date('Y-m-d'),
			   'time' => date('h:i:s A')
            );
		  $this->db->insert('useractivity', $act); 
		
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
				
				$this->db->select('prduct_name, product_sku, product_upc');
				$this->db->from('finalproductlist');
				$this->db->where('status', 1);
				$this->db->where('product_upc', $row->product_upc);
				$q1 = $this->db->get();				
				if($q1->num_rows()==0){
                	$data[] = $row;
				}
            }
        	return $data;
        }
		
	}
	
	
	
	
	// google english functions starts
	
	function splitdesc($desc){
		
		
 
		$yourApiKey = 'AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ';
	 
		$sourceData = $desc;
		$source = 'en';
	 
		$target = 'es';
	 
		$translator = new LanguageTranslator($yourApiKey);
	 
		$targetData = $translator->translate($sourceData, $target, $source);
		
		return $targetData;
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
	
	function translate($text){
		
		$string = file_get_contents('https://www.googleapis.com/language/translate/v2?key=AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ&q='.str_replace(' ','%20',trim ($text)).'&source=en&target=es');
		
		$json = json_decode($string, true);
		
		return $json['data']['translations'][0]['translatedText'];
	}
	


	function processhtml($htmlContent){
		
			
		if(str_replace("<","",str_replace(">","",str_replace("/","",substr(trim($htmlContent),0,5))))=='br'){
			return '';
		}
		$html_tag = substr(trim($htmlContent),1,strpos($htmlContent,'>'));
		
		// echo $html_tag;exit;
		
		$result = '';
//		if(str_replace(">","",$html_tag)=='table'){
		if(substr($html_tag,0,5)=='table'){
		
			$dom = new DOMDocument;
			$dom->loadHTML( $htmlContent );
			$rows = array();
			foreach( $dom->getElementsByTagName( 'tr' ) as $tr ) {
				$cells = array();
				foreach( $tr->getElementsByTagName( 'td' ) as $td ) {
					$cells[] = $td->nodeValue;
				}
				$rows[] = $cells;
			}
		}
			$result .= '<table>';
			for($i=0;$i<sizeof($rows);$i++){
				$result .= '<tr>';
				
				for($j=0;$j<sizeof($rows[$i]);$j++){
					
					$String = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $rows[$i][$j]);
					
					$result .= '<td>'.$this->translate($String).'</td>';
					//exit;
				}
					
				$result .= '</tr>';
			}
			
			$result .= '</table>';
			
			return $result;
	}
	
	// google english functions ends
	
	
	
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

	
	
}
?>
