<?php

class log extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		// if($this->session->userdata('user_id') == "")
		// redirect(BASE_URL.'/logout');
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
								'11'=>'Duplicate Data',
								'12'=>'Data Processed In Magento',
								'13'=>'QA Failed',
								'14'=>'Data Already Processed',
								'15'=>'Data Edited',
								'16'=>'Data Trashed',
								'17'=>'Data on Staging Server'
								);
		$status = $status[$statusid];
		return $status;
	}
	
	function active_status($statusid)
	{
		$status = array(
								'0'=>'Not Defined',
								'1'=>'Active',
								'2'=>'Not Active',
								'3'=>'Deleted'
								);
		$status = $status[$statusid];
		return $status;
	}
	
	function qafailederrors($statusid)
	{
		$status = array(
								'0'=>'Some Other Problem',
								'1'=>'Product Name Problem',
								'2'=>'Product Description & Short Description Problem',
								'3'=>'Product Specification Problem',
								'4'=>'Product Images Problem',
								'5'=>'Product Meta Information Problem',
								'6'=>'Product Dimensions Problem',
								'7'=>'Product Video Link Problem'
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
	
	function access_user_level($data)
	{
		if($data == "")
		{
			echo "<span class='label label-important'>No Access</span>";
		}
		else	
		{
		$arr = array(
			'1' => 'Administrator',
			'2' => 'Manager',
			'3' => 'User',
			'4' => 'Other Company',
			'5' => 'Direct Magento User'
		 );
						$ac = explode(',',$data);
						foreach($ac as $value){
							echo "<div class='label label-success'>".$arr[$value]."</div>";
						} 
		}
	
	}
	
	function filestatus($statusid)
	{
		$status = array(
								'1'=>'Ready For Peocessing',
								'2'=>'Data Already Processed'
								);
		$status = $status[$statusid];
		return $status;
	}
	
	function cdcupdate($id,$whatupdate)
	{
	$data = array (
		'updateid' =>$id,
		'whatupdate'=>$whatupdate
					);
	$this->db->insert('updates',$data);
	return $this->db->insert_id();
	}
	
	function whatupdate($statusid)
	{
		$status = array(
								'1'=>'Add New Category',
								'2'=>'Category Update'
								);
		$status = $status[$statusid];
		return $status;
	}
	
	function whatupdatestatus($id)
	{
		$status = array(
								'1'=>'Pending',
								'2'=>'Already Send'
								);
		$status = $status[$id];
		return $status;
	}
	
	function whatupdatemodule($id)
	{
		$status = array(
								'1'=>'categorynameget',
								'2'=>'categorynameget'
								);
		$status = $status[$id];
		return $status;
	}
	
}
?>
