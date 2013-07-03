<?php

class disclaimermanagementm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function get_alldisclaimers()
    {
     $this->db->select("*");
	 $this->db->where('status != ',3);
	 $this->db->from('disclaimermanagement');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->result();
	 else
	 return false;
	}
	
	function disclaimerinsert($name,$english,$spanish,$status)
	{
	$data = array (
			'name'=>$name,
			'english'=>$english,
			'spanish'=>$spanish,
			'status'=>$status
				   );
	$this->db->insert('disclaimermanagement',$data);
	$datainsert = $this->db->insert_id();
	if($datainsert)
	return true;
	else
	return false;
	}
	
	function getdisclaimer($id)
	{
     $this->db->select("*");
	 $this->db->where('id',$id);
	 $this->db->from('disclaimermanagement');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 {
	 return $data->row();
	 }
	 else
	 {
	 return false;
	 }
	}
	
	function disclaimeredit($name,$english,$spanish,$status,$id)
	{
	$data = array (
			'name'=>$name,
			'english'=>$english,
			'spanish'=>$spanish,
			'status'=>$status
				   );
	$this->db->where('id',$id);
	$this->db->update('disclaimermanagement',$data);
	$datainsert = $this->db->affected_rows();
	if($datainsert)
	return true;
	else
	return false;
	}
	
	function deldisc($id)
	{
	$data = array (
			'status'=>3
				   );
	$this->db->where('id',$id);
	$this->db->update('disclaimermanagement',$data);
	$datainsert = $this->db->affected_rows();
	if($datainsert)
	return true;
	else
	return false;	
	}
	
	
}
?>
