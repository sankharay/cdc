<?php

class Managevendorm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	function vendorstatus($id)
	{
	if($id == 1 )
	{
	$status = "<span class='label label-success'>Active</span>";
	return $status;
	}
	else
	{
	$status = "<span class='label label-important'>Pending</span>";
	return $status;
	}
	}
	
	function vendor_duplicate($vendorid)
	{
     $this->db->select("id");
     $this->db->where("vendor_id",$vendorid);
     $this->db->from("vendortemplate");
	 $result = $this->db->get();
	 if($result->num_rows() > 0 )
	 return TRUE;
	 else
	 return FALSE;
	}
	
	function deletevendor($id)
	{
	$data = array (
				'status' => 3
					);
	$this->db->where('vmID',$id);
	$this->db->update('vendormanagement',$data);
	return TRUE;
	}
	
    function listvendors()
    {
     $this->db->select("*");
     $this->db->where("status != ",3);
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
	
	function editvendors($id)
	{
     $this->db->select("*");
     $this->db->from("vendormanagement");
     $this->db->where("vmID",$id);
     $this->db->limit("1");
	 $query = $this->db->get();
	 if($query->num_rows())
	 {
		return $query->row();
	 }
	 else
	 {
		 return FALSE;
	 }
	}
	
	function vendorexist($id)
	{
		
     $this->db->select("*");
     $this->db->from("vendormanagement");
     $this->db->where("vmID",$id);
     $this->db->limit("1");
	 $query = $this->db->get();
	 if($query->num_rows())
	 {
		return TRUE;
	 }
	 else
	 {
		redirect(BASE_URL."/unauthorized");
		exit;
	 }
	}
	
	function changepassword($password,$vendorid)
	{
	$data = array(
               'password' => md5($password)
            );
		$this->db->update('vendormanagement',$data);
		$this->db->where('vmID',$vendorid);
		return TRUE;
	}
	
function editvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vendorid,$vpassword)
	{
	$data = array(
               'vendorName' => $vname,
               'username' => $vusername,
               'password' => $vpassword,
               'vendoremail' => $vemail,
               'vendorextradetails' => $vdetails,
               'hostip' => $vhostip,
               'status' => $vstatus
            );
		$this->db->where('vmID',$vendorid);
		$this->db->update('vendormanagement',$data);
		return TRUE;
	}
	
function addvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vid,$vpassword)
	{
	$data = array(
               'vendorName' => $vname,
               'username' => $vusername,
               'password' => $vpassword,
               'vendoremail' => $vemail,
               'vendorID' => $vid,
               'vendorextradetails' => $vdetails,
               'hostip' => $vhostip,
               'status' => $vstatus
            );
		print_r($data);
		$this->db->insert('vendormanagement',$data);
		return TRUE;
	}
	
	function savevendor($filename,$vendorid)
	{
	$data = array(
               'vendor_id' => $vendorid,
               'filename' => $filename,
               'status' => '1'
            );
	$this->db->insert('vendortemplate',$data);
	return TRUE;
	}
	
	function filequeue()
	{
	$this->db->select("*");
	$this->db->from("vendortemplate");
	$this->db->order_by("dateandtime","DESC");
	$result = $this->db->get();	
	if($result->num_rows())
	{
		return $result->result();
	}
	else
	{
		return FALSE;
	}
	}
	
	function templatestatus($id)
	{
		$status = array(
					'1'=>'Pending Processing',
					'2'=>'Processing Done',
					'3'=>'File Deleted'
				);
		return $status[$id];
	}
	
	function vendoridtoname($id)
	{
	$this->db->select("*");
	$this->db->where("vmID",$id);
	$this->db->from("vendormanagement");
	$this->db->limit("1");
	$result  = $this->db->get();
	return $result->row();
	}
	
}
?>
