<?php

class log extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function logdata($activity)
    {
		$act = array(
               'userId' => $this->session->userdata('user_id'),
               'activity' => $this->session->userdata('fname').' '.$this->session->userdata(			'lname').$activity ,
               'date' => date('Y-m-d'),
			   'time' => date('h:i:s A')
            );
		  $this->db->insert('useractivity', $act);  
		  return TRUE;      
	}
	
	function content_status($statusid)
	{
		$status = array(
								'0'=>'In Queue',
								'1'=>'Archieve',
								'2'=>'Pending',
								'3'=>'Raw',
								'4'=>'In Process',
								'5'=>'QA',
								'6'=>'Active',
								'7'=>'English Ready',
								'8'=>'Spanish Ready',
								'9'=>'Update From Vendor',
								'11'=>'Duplicate Content'
								);
		$status = $status[$statusid];
		return $status;
	}
	
	function check_sku_exist($sku)
	{
	$this->db->select("mpt_id");
	$this->db->from("masterproducttable");
	$this->db->where("product_sku",$sku);
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
	return TRUE;
	}
	else
	{
	redirect(BASE_URL.'/logout');
	exit;
	}
	}
	
	function check_upc_exist($upc)
	{
	$upc = trim(str_replace('%20',' ',$upc));
	$this->db->select("mpt_id");
	$this->db->from("masterproducttable");
	$this->db->where("product_upc",$upc);
	$query = $this->db->get();
	//echo $this->db->last_query();
	if($query->num_rows() > 0)
	{
	return TRUE;
	}
	else
	{
	redirect(BASE_URL.'/logout');
	exit;
	}
	}
	
	function access_level($useraccesslevel,$accesswant)
	{
		//$access = explode(',',$useraccesslevel);
//		if (in_array($accesswant, $access)) {
//    	return TRUE;
//		}
//		else
//		{
//		redirect(BASE_URL."/unauthorized");
//		exit;	
//		}
		return TRUE;
	}
	
}
?>
