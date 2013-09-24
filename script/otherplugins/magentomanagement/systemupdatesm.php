<?php

class systemupdatesm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function get_content()
    {
     $this->db->select('*');
	 $this->db->from('updates');
	 $data = $this->db->get();
	 if($data->num_rows() > 0)
	 return $data->result();
	 else
	 return FALSE;
	}
	
	function categorynameget($id)
	{
     $this->db->select('*');
	 $this->db->where('id',$id);
	 $this->db->from('categories');
	 $data = $this->db->get();
	 if($data->num_rows() > 0)
	 return $data->row()->name;
	 else
	 return FALSE;
	}
	
}
?>
