<?php

class contentsearchm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    	
	function search_products(){
		
		$this->db->select('*');
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
	
	function inprocessing_products(){
		
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('masterproducttable');
		$this->db->where('status', 4);
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
	
	function all_assigned_users($id)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("user_id",$id);
		$users = $this->db->get();
		if($users->num_rows() > 0 )
		return $users->row();
		else
		return FALSE;
	}
	
    	
	function search_products_raw()
	{
		$this->db->select('*');
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
	$upc = trim(str_replace('%20',' ',$upc));
	$this->db->select("*");
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->limit("1");
	$this->db->from('masterproducttable');
	$data = $this->db->get();
	return $data->row();
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
	
	function get_disclaimer_dropdown()
	{
	$this->db->select("*");
	$this->db->where('status',1);
	$this->db->from('disclaimermanagement');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$return="<select name='pDisclaimer' id='pDisclaimer'><option value=''>Please select Disclaimer</option>";
	$value=$data->result();
	foreach($value as $values)
	{
	$return.="<option value=".$values->id.">";
	$return.=$values->name;
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
	
    	
	function englshreadycontentshow($accesslevel,$user_id)
	{
	$this->db->where('user_assign',$user_id);
	$this->db->select("*");
	$this->db->where('status','1');
	$this->db->where('inmagento','3');
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
			   'user_assign' => $this->input->get('userid'),
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
	
	function processproductss(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			
			$data = array(
               'status' => '2',
			   'user_assign' => $this->input->get('userid'),
			   'priority' => $_GET['priority']
            );
			$this->db->where('mpt_id', $id);
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
		
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('masterproducttable');
		$this->db->where('status', 2);
		$this->db->where('( inmagento = 1 OR inmagento = 4 )');
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
	
	function pending_urgent_products(){
		
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('masterproducttable');
		$this->db->where('status', 2);
		$this->db->where('inmagento', NULL);
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
	
    	
	function englishreadycontentm()
		{
		$userid = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('masterproducttable');
		// $this->db->from('finalproductlist');
		// $this->db->where('finalproductlist.user_assign', $userid);
		// $this->db->where('finalproductlist.inmagento','0');
		$this->db->where('masterproducttable.status = ', 7);
		$this->db->where('masterproducttable.user_assign != ', "");
		// $this->db->where('masterproducttable.product_source','finalproductlist.product_source');
		$this->db->order_by('masterproducttable.dateandtime','DESC');
		$q = $this->db->get();
		// echo $this->db->last_query();
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

	function update_trush($upc,$productsource)
	{
		$query = mysql_query("UPDATE masterproducttable SET status=11 where product_upc=$upc AND product_source!=$productsource");
		return true;
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
		$this->db->select('*');
		$this->db->where('product_upc',$upc);
		$this->db->where('product_source',$productsource);
		$this->db->from('masterproducttable');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		return true;
		else
		return false;
	}
	
	function productwiz($upc,$productsource){
	
		$this->update_upc_id($upc,$productsource);
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
	
	function englishready(){
	
		$query = 'select priority from masterproducttable where product_upc = "'.$_POST['pupc'].'"';
		$re = mysql_query($query);
		$ro = mysql_fetch_array($re);
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
		print_r($addoncategories);
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
		// english ends
		// spanish keywords start
		if(isset($_POST['spanishkeywords']))
		$spanishkeywords = $_POST['spanishkeywords'];
		else
		$spanishkeywords = "";
		if(isset($_POST['spanishkeyworddescription']))
		$spanishkeyworddescription = $_POST['spanishkeyworddescription'];
		else
		$spanishkeyworddescription = "";
		// spanish keywords ends
		// inventory start
		if(isset($_POST['pInventory']))
		$pInventory = $_POST['pInventory'];
		else
		$pInventory = "";
		// inventory ends
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
		else
		{
		$specialPrice = $_POST['pSpecialPrice'];
		}
		// Date format Conversation ends
		$finaproductdata = array (
					'product_category'=>htmlspecialchars($collectcat1),
					'prduct_name'=>htmlspecialchars($_POST['pName']),
					'short_description'=>htmlspecialchars($_POST['finalpsdesc']),
					'product_description'=>htmlspecialchars($_POST['pDesc']),
					'product_sku'=>htmlspecialchars($_POST['pSku']),
					'product_upc'=>htmlspecialchars($_POST['pupc']),
					'product_msrp'=>htmlspecialchars($_POST['pmsrp']),
					'product_retail'=>htmlspecialchars($_POST['pretail']),
					'product_cost'=>htmlspecialchars($_POST['pcost']),
					'height'=>htmlspecialchars($_POST['pHeight']),
					'width'=>htmlspecialchars($_POST['pWidth']),
					'length'=>htmlspecialchars($_POST['pLength']),
					'weight'=>htmlspecialchars($_POST['pWeight']),
					'user_assign'=>htmlspecialchars($user_id),
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'product_specs'=>htmlspecialchars($_POST['pSpecs']),
					'specialprice'=>$specialPrice,
					'specialfromdate'=>$FromDate,
					'specialtodate'=>$ToDate,
					'shippingprice'=>$_POST['pShipping'],
					'product_inventory_level'=> $pInventory,
					'product_metatags'=>htmlspecialchars($keywords),
					'product_metadescription'=>htmlspecialchars($keyworddescription),
					'product_disclaimer'=>$_POST['pDisclaimer'],
					'isset'=>htmlspecialchars($_POST['pisset']),
					'attributes'=>htmlspecialchars($att),
					'onlineonly'=>htmlspecialchars($_POST['ponlineonly'])
								  );
								
		$updatedfinal = $this->db->insert("finalproductlist",$finaproductdata);
		$englishinsert_id = $this->db->insert_id();
	
	if($updatedfinal){
		
		  $spanishproductdata = array (
					'eng_id'=>$englishinsert_id,
					'product_category'=>htmlspecialchars($collectcat1),
					'prduct_name'=>htmlspecialchars($this->translateplaintext($_POST['pName'])),
					'short_description'=>htmlspecialchars($this->translateplaintext($_POST['finalpsdesc'])),
					'product_description'=>htmlspecialchars($this->splitstring($_POST['pDesc'])),
					'product_sku'=>htmlspecialchars($_POST['pSku']),
					'product_upc'=>htmlspecialchars($_POST['pupc']),
					'product_msrp'=>htmlspecialchars($_POST['pmsrp']),
					'product_retail'=>htmlspecialchars($_POST['pretail']),
					'product_cost'=>htmlspecialchars($_POST['pcost']),
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'height'=>htmlspecialchars($_POST['pHeight']),
					'width'=>htmlspecialchars($_POST['pWidth']),
					'length'=>htmlspecialchars($_POST['pLength']),
					'weight'=>htmlspecialchars($_POST['pWeight']),
					'user_assign'=>htmlspecialchars($user_id),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'product_specs'=>htmlspecialchars($this->splitstring($_POST['pSpecs'])),
					'specialprice'=>$specialPrice,
					'specialfromdate'=>$FromDate,
					'specialtodate'=>$ToDate,
					'product_inventory_level'=> $pInventory,
					'shippingprice'=>$_POST['pShipping'],
					'product_metatags'=>htmlspecialchars($spanishkeywords),
					'product_metadescription'=>htmlspecialchars($spanishkeyworddescription),
					'product_disclaimer'=>$_POST['pDisclaimer'],
					'isset'=>htmlspecialchars($_POST['pisset']),
					'attributes'=>htmlspecialchars($att),
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
		// update english as well as spanish id in master table start
		$query = 'select mpt_id from masterproducttable where status != 11 AND product_sku = "'.$_POST['pSku'].'"';
		$re = mysql_query($query);
		while($r = mysql_fetch_array($re)){
			$q = "UPDATE `masterproducttable` SET `status` = '7',`fpl_id` = $englishinsert_id,`sppr_id` = $spanishinsert_id WHERE `mpt_id` =".$r['mpt_id'];
			mysql_query($q);
		}
		// update english as well as spanish id in master table ends
		
		$msg = '<h4 class="alert_success">A Product Created Successfully</h4>';
	}else{
		$msg = '<h4 class="alert_error">Product is not inserted successfully</h4>';
	}
	
	return $msg;

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
