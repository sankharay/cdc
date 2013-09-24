<?php
class adddatam extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    
	
	function updatecontentdone()
	{
	$collectcat = "";
		$fpl_id = $this->input->post('pFplid');
		// category create attribute string starts
		$user_id = $this->session->userdata("user_id");
		$categories = $_POST['category'];
		print_r($categories);
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
		if(isset($_POST['addoncategory']))
		{
		$addoncategories = $_POST['addoncategory'];
		if(sizeof($addoncategories) > 0)
		{
		// print_r($addoncategories);
		$selectionnum=sizeof($addoncategories);
		for($i=0;$i<$selectionnum;$i++)
		$collectcat1.="_".$addoncategories[$i];
		}
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
					'product_inventory_level'=> $pInventory,
					'product_map'=>htmlspecialchars($_POST['pMAP']),
					'height'=>htmlspecialchars($_POST['pHeight']),
					'width'=>htmlspecialchars($_POST['pWidth']),
					'length'=>htmlspecialchars($_POST['pLength']),
					'weight'=>htmlspecialchars($_POST['pWeight']),
					'user_assign'=>htmlspecialchars($user_id),
					'product_brand'=>htmlspecialchars($_POST['pBrand']),
					'product_source'=>htmlspecialchars($_POST['pSource']),
					'eng_video'=>htmlspecialchars($_POST['pvideo']),
					'specialprice'=>$specialPrice,
					'specialfromdate'=>$FromDate,
					'specialtodate'=>$ToDate,
					'shippingprice'=>$_POST['pShipping'],
					'product_metatags'=>htmlspecialchars($keywords),
					'product_metadescription'=>htmlspecialchars($keyworddescription),
					'isset'=>htmlspecialchars($_POST['pisset']),
					'attributes'=>htmlspecialchars($att),
					'onlineonly'=>htmlspecialchars($_POST['ponlineonly']),
					'inmagento'=> '3',
					'status'=> '1'
								  );
		$this->db->where('fpl_id',$fpl_id);
		$this->db->update("finalproductlist_temp",$finaproductdata);
		$englishupdated = $this->db->affected_rows();
		echo $this->db->last_query();
		// Update master table start
		// $this->update_master_status($this->input->post('fpl_id'));
		// Update master table ends 
		redirect(BASE_URL.'/contentsearch/pending/');
		exit;
	}
	
	function addtempname($name,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'prduct_name'=>$name
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'prduct_name'=>$name
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function addtempshort($short,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'short_description'=>$short
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'short_description'=>$short
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function addtempdescription($des,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_description'=>trim($des)
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_description'=>$des
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function addtempspecification($pspecs,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_specs'=>trim($pspecs)
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_specs'=>trim($pspecs)
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempvideo($eng_video,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'eng_video'=>$eng_video
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'eng_video'=>$eng_video
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempsku($psku,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_sku'=>$psku
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_sku'=>$psku
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempcost($cost,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_cost'=>$cost
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_cost'=>$cost
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempretail($retail,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_retail'=>$retail
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_retail'=>$retail
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempsprice($sprice,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'specialprice'=>$sprice
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'specialprice'=>$sprice
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempspricefromdate($spricefromdate,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'specialfromdate'=>$spricefromdate
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'specialfromdate'=>$spricefromdate
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempspricetodate($spricetodate,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'specialtodate'=>$spricetodate
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'specialtodate'=>$spricetodate
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempmrsp($mrsp,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_msrp'=>$mrsp
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_msrp'=>$mrsp
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetemppmap($pmap,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_map'=>$pmap
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_map'=>$pmap
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempshipping($pshipping,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'shippingprice'=>$pshipping
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'shippingprice'=>$pshipping
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempinventry($pinventry,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_inventory_level'=>$pinventry
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_inventory_level'=>$pinventry
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempheight($pheight,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'height'=>$pheight
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'height'=>$pheight
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempwidth($pwidth,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'width'=>$pwidth
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'width'=>$pwidth
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetemplength($plength,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'length'=>$plength
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'length'=>$plength
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempweight($pweight,$mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'weight'=>$pweight
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'weight'=>$pweight
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function saveattributes($mpt,$attid,$replacevalue)
	{
	$createattval = "(subattributes_".$attid."-".$replacevalue.")";
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'attributes'=>$createattval
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'attributes'=>$createattval
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}
	
	function savetempbrand($mpt,$vbrand)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('finalproductlist_temp');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
	$data = array (
		'product_brand'=>$vbrand
				);
	$this->db->where('mpt_id',$mpt);
	$this->db->update('finalproductlist_temp',$data);
	}
	else
	{
	$data = array (
		'mpt_id'=>$mpt,
		'product_brand'=>$vbrand
				);
	$this->db->insert('finalproductlist_temp',$data);
	}
	}

	
}
?>
