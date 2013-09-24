<?php

class rejecteddatam extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function get_content()
    {
        $this->db->select('*');
		$this->db->from('qafailedcase');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;        
	}
	
	function get_data($id)
	{
	$this->db->select('*');
	$this->db->where('id',$id);
	$this->db->from('qafailedcase');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->row();
	else
	return false;	
	}
	
	function updatecontent($data,$id)
	{
	$this->db->where('id',$id);
	$this->db->update('qafailedcase',$data);
	return $this->db->affected_rows();
	}
	
	function deletecontent($id)
	{
	$this->db->where('id',$id);
	$this->db->delete('qafailedcase');
	return $this->db->affected_rows();
	}
	
	
}
?>
