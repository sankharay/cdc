<?php

class addonmanagementm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function listreadyproduct()
    {
        $this->db->select('*');
        $this->db->from('finalproductlist');
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function getaddons($id)
	{
        $this->db->select('*');
        $this->db->from('finalproductlist');
		$this->db->where('status',1);
		$this->db->where('fpl_id',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->row()->addons;
		}
		else
		{
		return FALSE;
		}
	}
	
	function productdetail($id)
	{
        $this->db->select('*');
        $this->db->from('finalproductlist');
		$this->db->where('status',1);
		$this->db->where('fpl_id',$id);
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
	
}
?>
