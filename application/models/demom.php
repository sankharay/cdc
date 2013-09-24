<?php

class demom extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    	
	function search_products_raw()
	{
		$this->db->select('*');
		$this->db->from('masterproducttable');
		$this->db->order_by('dateandtime','DESC');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
}
?>
