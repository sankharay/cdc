<?php
class apicontentm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function fetch_orders($limit, $start) {
		$this->db->select('*');
		 $this->db->order_by('dateandtime DESC');
		 $this->db->where('status','1');
        $this->db->limit($limit, $start);
        $query = $this->db->get("api_masterproducttable");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   public function record_count() {
        return $this->db->count_all("api_masterproducttable");
    }
   
   
	
	function get_vendor_name($vendorid)
	{
		$this->db->select("*");
		$this->db->where("vmID",$vendorid);
		$this->db->limit(1);
		$this->db->from("vendormanagement");
		$data = $this->db->get();
		$vendorname = $data->row()->vendorName;
		if($vendorname)
		{
			return $vendorname;
		}
		else
		{
		return "Undefined Vendor";
		}
	}
	
	function getothersproductqa($mpt_id)
	{
	$this->db->select("*");
	$this->db->where("mpt_id",$mpt_id);
	$this->db->limit(1);
	$this->db->from("api_masterproducttable");
	$data = $this->db->get();
	$fpl_id = $data->row();
	if($data->num_rows() > 0)
	{
		return $data->row();
	}
	else
	{
	return "Undefined Product";
	}
	}
   
}
?>
