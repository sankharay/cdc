<?php

class addproductm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function listfile($userid)
    {
        $this->db->select('*');
		$this->db->where('userid',$userid);
		$this->db->where('filefor',1);
		$this->db->where('status',1);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		return $data->result();
	}
	
	function filestatus($id)
	{
	if($id == 1 )
	return "Active";
	else
	return "File Processed";	
	}
	
}
?>
