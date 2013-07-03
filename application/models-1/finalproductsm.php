<?php
class finalproductsm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    	
	function get_finalproducts($user_id){
		
		$this->db->select("*");
		$this->db->where('status','1');
		$this->db->where('inmagento','1');
		if($this->session->userdata('accesslevel') != 1)
		$this->db->where('user_assign',$user_id);
		$this->db->from('finalproductlist');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	function imgexist($id)
	{
		$this->db->select("*");
		$this->db->where('finalproductlist_fpl_id',$id);
		$this->db->where('imagedone','1');
		$this->db->from('product_images');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return TRUE;
		else
		return FALSE;
	}
	
	function getvendor($id)
	{
		$this->db->select("vendorName");
		$this->db->where('vmID',$id);
		$this->db->where('status','1');
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row()->vendorName;
		else
		return FALSE;
	}
	
	function get_final_notification_products($user_id){
		
		$this->db->select("*");
		$this->db->where("(inmagento = 0 OR inmagento = 1 OR inmagento = 2)  AND status=9 ");
		$this->db->where('user_assign',$user_id);
		$this->db->from('finalproductlist');
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
