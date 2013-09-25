<?php

class copyimagesm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function listfile($userid)
    {
        $this->db->select('*');
		$this->db->where('userid',$userid);
		$this->db->where('filefor',6);
		$this->db->where('status',1);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		return $data->result();
	}
	
    	function get_vendors()
	{
        $this->db->select('*');
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		return $data->result();
	}
	
	function get_filename($id,$userid)
	{
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->where('userid',$userid);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
		return $data->row();
		}
		else
		{
		redirect(BASE_URL.'/unauthorized');	
		}
	}
	
	function filedetails($id)
	{
        $this->db->select('*');
        $this->db->where('id',$id);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
		return $data->row();
		}
		else
		{
		return FALSE;
		}
	}
	
    function vendordetails($vendorid)
	{
	$this->db->select('*');
	$this->db->where('vmID',$vendorid);
	$this->db->from('vendormanagement');
	$data = $this->db->get();
	if($data->num_rows() > 0)
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
