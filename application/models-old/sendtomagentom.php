<?php

class sendtomagentom extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function check_fpl_id_exist($fplid)
    {
        $this->db->select('spenish_id');
		$this->db->where('fpl_id',$fplid);
		$this->db->where('status','1');
		$this->db->from('finalproductlist');
        $data = $this->db->get();
		if($data->num_rows() > 0 )
		return true;
		else
		return false;
	}
	
	function get_english_data($fpl_id)
	{
        $this->db->select('*');
		$this->db->where('fpl_id',$fpl_id);
		$this->db->where('status','1');
		$this->db->from('finalproductlist');
        $data = $this->db->get();
		return $data->result();
	}
}
?>
