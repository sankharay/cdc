<?php
class assigndatamanuallym extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function check_sku($product_sku)
    {
        $this->db->select('mpt_id');
		$this->db->where('product_sku',$product_sku);
        $this->db->from('masterproducttable');
		$data  = $this->db->get();
		if($data->num_rows() > 0)
		return TRUE;
		else
		return FALSE;
	}
	
    function check_upc($product_upc)
    {
        $this->db->select('mpt_id');
		$this->db->where('product_upc',$product_upc);
        $this->db->from('masterproducttable');
		$data  = $this->db->get();
		if($data->num_rows() > 0)
		return TRUE;
		else
		return FALSE;
	}
	
	function assign_to_user($data)
	{
			$this->db->insert('masterproducttable', $data);
	}
	
}
?>
