<?php
class magentoeditingm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function magentoeditinglist()
    {
     $this->db->select('*');
	 $this->db->where('status',12);
	 $this->db->from('finalproductlist');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->result();
	 else
	 return false; 
	}
	
	function getvendor($id)
	{
		$this->db->select("vendorName");
		$this->db->where('vmID',$id);
		$this->db->where('status','1');
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row()->vendorName;
		else
		return FALSE;
	}
	
	function browse_english_product($fpl_id)
	{
		$this->db->select("*");
		$this->db->where('fpl_id',$fpl_id);
		$this->db->from('finalproductlist');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row();
		else
		return FALSE;
	}
	
	function browse_spanish_product($sppr_id)
	{
		$this->db->select("*");
		$this->db->where('sppr_id',$sppr_id);
		$this->db->from('spenishdata');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row();
		else
		return FALSE;
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
	
	function get_spanish_id($fpl_id)
	{
		$this->db->select("spenish_id");
		$this->db->where('fpl_id',$fpl_id);
		$this->db->from('finalproductlist');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row()->spenish_id;
		else
		return FALSE;
	}

	function get_selected_categories($fpl_id)
	{
		$this->db->select("*");
		$this->db->where('fpl_id',$fpl_id);
		$this->db->where('status','12');
		$this->db->from('finalproductlist');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		$categories = $data->row()->product_category;
		$catarray = explode('_',$categories);
		return $catarray[0];
		}
		else
		{
		return FALSE;
		}
	}
	
	function get_categiry_name($cat_id)
	{
		$this->db->select("name");
		$this->db->where('id',$cat_id);
		$this->db->from('categories');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row()->name;
		else
		return FALSE;
	}
	
	function get_category_attributes($id)
	{
		$this->db->select("*");
		$this->db->from('attribute_types');
		$this->db->where('categoryid',$id);
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function get_category_sub_attributes($id)
	{
		$this->db->select("*");
		$this->db->from('attribute_types_sub');
		$this->db->where('attributeid',$id);
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function attribute_status($id)
	{
	if($id == 1)
	{
	$status = "active";
	return $status;	
	}
	else
	{
	$status = "De-active";
	return $status;
	}
	}
	
	function get_selected_attributes($string)
	{
	$selected_arrai = array();
	$bodytag = explode(")(", $string);
	$arraylen = sizeof($bodytag);
	for($i=0;$i<$arraylen;$i++)
	{
		$domain = trim(str_replace(')','',str_replace('-','',strstr($bodytag[$i], '-'))));
		$dataexplode = explode(',',$domain);
		$arraydata = array_filter($dataexplode);
		$arraylens = sizeof($arraydata);
	for($j=0;$j<$arraylens;$j++)
	{
		$selected_arrai[] = $arraydata[$j];
	}
	}
	return $selected_arrai;
	}
	
	function update_english($data,$fpl_id)
	{
	$this->db->where('fpl_id',$fpl_id);
	$this->db->update('finalproductlist',$data);
	$update = $this->db->affected_rows();
	if($update > 0 )
	return true;
	else
	return false;
	}
	
	function update_spanish($data,$sppr_id)
	{
	$this->db->where('sppr_id',$sppr_id);
	$this->db->update('spenishdata',$data);
	$update = $this->db->affected_rows();
	if($update > 0 )
	return true;
	else
	return false;
	}
	
	function list_brands()
	{
		$this->db->select("*");
		$this->db->from('brandmanagement');
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function list_disclaimers()
	{
		$this->db->select("*");
		$this->db->from('disclaimermanagement');
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function update_addons_categories($valuess,$fpl_id)
	{
		$this->db->select("*");
		$this->db->where('fpl_id',$fpl_id);
		$this->db->from('finalproductlist');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		$categories = $data->row()->product_category;
		else
		$categories = FALSE;
		if($categories != FALSE)
		{
		$categories = explode('_',$categories);	
		$cat = $categories[0];
		$addonsize = sizeof($valuess);
		for($i=0;$i<$addonsize;$i++)
		$cat.="_".$valuess[$i];
		}
		// update addons start
		$da = array (
			'product_category' => "$cat"
					);
		$engupdate = $this->update_english_addon($da,$fpl_id);
		$spnupdate = $this->update_spanish_addon($da,$fpl_id);
		if($engupdate AND $spnupdate)
		return true;
		// update addons ends
	}
	
	function update_english_addon($da,$fpl_id)
	{
	$this->db->where('fpl_id',$fpl_id);
	$this->db->update('finalproductlist',$da);
	$result = $this->db->affected_rows();
	return $result;	
	}
	
	function update_spanish_addon($da,$fpl_id)
	{
	$this->db->where('eng_id',$fpl_id);
	$this->db->update('spenishdata',$da);
	$result = $this->db->affected_rows();
	return $result;	
	}
	
	function insert_attributes($fpl_id)
	{
		$collectcat = "";
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
		$data = array (
		'attributes' => "$att"
					);
		$this->update_eng_attributes($data,$fpl_id);
		$this->update_spa_attributes($data,$fpl_id);
		
		
	}
	
	function update_eng_attributes($data,$fpl_id)
	{
	$this->db->where('fpl_id',$fpl_id);
	$this->db->update('finalproductlist',$data);
	return true;
	}
	
	function update_spa_attributes($data,$fpl_id)
	{
	$this->db->where('eng_id',$fpl_id);
	$this->db->update('spenishdata',$data);
	return true;
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
	
	
}
?>
