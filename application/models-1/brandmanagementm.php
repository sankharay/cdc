<?php

class brandmanagementm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function brandload()
    {
     $this->db->select("*");
	 $this->db->where('status',1);
	 $this->db->from('brandmanagement');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->result();
	 else
	 return false;
	}
	
	function insetbrand($brandname,$mid,$status)
	{
	$data = array(
			'brandName' => $brandname,
			'bMagentoid' => $mid,
			'status' => $status
				);
	$this->db->insert('brandmanagement',$data);
	$data = $this->db->insert_id();
	if($data)
	return true;
	else
	return false;
	}
	
	function editbrand($brandname,$mid,$status,$id)
	{
	$data = array(
			'brandName' => $brandname,
			'bMagentoid' => $mid,
			'status' => $status
				);
	$this->db->where('id',$id);
	$this->db->update('brandmanagement',$data);
	$data = $this->db->affected_rows();
	if($data)
	return true;
	else
	return false;
	}
	
	function duplicates_brand($brandname)
	{
     $this->db->select("*");
	 $this->db->where('brandName',$brandname);
	 $this->db->where('status',1);
	 $this->db->from('brandmanagement');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return TRUE;
	 else
	 return FALSE;
	}
	
	function duplicates_magid($magid)
	{
     $this->db->select("*");
	 $this->db->where('bMagentoId',$magid);
	 $this->db->where('status',1);
	 $this->db->from('brandmanagement');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return TRUE;
	 else
	 return FALSE;
	}
	
	function getbrandetails($id)
	{
     $this->db->select("*");
	 $this->db->where('id',$id);
	 $this->db->where('status',1);
	 $this->db->from('brandmanagement');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 {
		return $data->row();
	 }
	 else
	 {
		redirect(BASE_URL.'/logout/');
		exit; 
	 }
	}
	
	function deletebrand($id)
	{
	$data = array(
			'status' => 3
				);
	$this->db->where('id',$id);
	$this->db->update('brandmanagement',$data);
	$data = $this->db->affected_rows();
	if($data)
	return true;
	else
	return false;
	}
	
	
}
?>
