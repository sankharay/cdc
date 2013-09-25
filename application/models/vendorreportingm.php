<?php

class vendorreportingm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function getrejected($fromdate,$todate)
    {
	$this->db->select('*');
	$this->db->where("DATE_FORMAT(dateandtime,'%Y-%m-%d') >= '$fromdate'");
	$this->db->where("DATE_FORMAT(dateandtime,'%Y-%m-%d') <= '$todate'");
	$this->db->from('qafailedcontent');
	echo $this->db->last_query();
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
		return $data->result();
	}
	else
	{
	echo "No Record Found";	
	} 
        
	}
	
	function get_realcontent($mpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$mpt);
	$this->db->from('masterproducttable');
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
