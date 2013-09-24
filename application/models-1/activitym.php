<?php

class activitym extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	function listactivity()
	{
	$this->db->select("*");
	$this->db->from("useractivity");
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return $data->result();
	else
	return FALSE;	
	}
	
	function get_user_name($id)
	{
	$this->db->select('fname,lname');
	$this->db->where('user_id',$id);
	$this->db->limit('1');
	$this->db->from('users');
	$data = $this->db->get();
	return $data->row();
	}
	
}
?>
