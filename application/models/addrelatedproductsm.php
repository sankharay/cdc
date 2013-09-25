<?php
class addrelatedproductsm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function listcategories()
    {
        $this->db->select('*');
		$this->db->from('categories');
		$this->db->group_by('magento_category_id');
        $data = $this->db->get();
		if($data->num_rows() > 0)
		return $data->result();
		else
		return FALSE;
	}
	
	function get_allproducts($catid)
	{
        $this->db->select('*');
		$this->db->where('catmagid',$catid);
		$this->db->where('productStatus',1);
		$this->db->from('relatedproducts_magento');
		$this->db->order_by('dateandtime','DESC');
		$this->db->limit('500');
        $data = $this->db->get();
		if($data->num_rows() > 0)
		return $data->result();
		else
		return FALSE;
	}
}
?>
