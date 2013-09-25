<?php

class reportingm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function list_users()
    {
     $this->db->select('*');
	 $this->db->from('users');
	 $data = $this->db->get();
	 if($data->num_rows > 0 )
	 {
		return $data->result();
	 }
	 else
	 {
		return FALSE;
	 }
	}
	
	
	
	function countreject($userid,$fromdate,$todate)
	{
	$this->db->select('*');
	$this->db->from('qafailedcontent');
	$this->db->where('userid',$userid);
	 $this->db->where('DATE(dateandtime) >= ',$fromdate);
	 $this->db->where('DATE(dateandtime) <= ',$todate);
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->num_rows();
	else
	return "0";
	}
	
	function countreject_daily($userid,$fromdate)
	{
	$this->db->select('*');
	$this->db->from('qafailedcontent');
	$this->db->where('userid',$userid);
	 $this->db->where('DATE(dateandtime)',$fromdate);
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->num_rows();
	else
	return "0";
	}
	
	function get_data_english_ready($userid,$fromdate,$todate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime) >= ',$fromdate);
	 $this->db->where('DATE(dateandtime) <= ',$todate);
	 $this->db->where('status',7);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_english_ready_daily($userid,$fromdate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime)',$fromdate);
	 $this->db->where('status',7);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_spanish_ready($userid,$fromdate,$todate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime) >= ',$fromdate);
	 $this->db->where('DATE(dateandtime) <= ',$todate);
	 $this->db->where('status',8);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_spanish_ready_daily($userid,$fromdate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime)',$fromdate);
	 $this->db->where('status',8);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_processing_ready($userid,$fromdate,$todate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime) >= ',$fromdate);
	 $this->db->where('DATE(dateandtime) <= ',$todate);
	 $this->db->where('status',4);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_processing_ready_daily($userid,$fromdate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime)',$fromdate);
	 $this->db->where('status',4);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_pending_ready($userid,$fromdate,$todate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime) >= ',$fromdate);
	 $this->db->where('DATE(dateandtime) <= ',$todate);
	 $this->db->where('status',2);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_pending_ready_daily($userid,$fromdate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime)',$fromdate);
	 $this->db->where('status',2);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_ready_ready($userid,$fromdate,$todate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime) >= ',$fromdate);
	 $this->db->where('DATE(dateandtime) <= ',$todate);
	 $this->db->where('status',14);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
	function get_data_ready_ready_daily($userid,$fromdate)
	{
     $this->db->select('*');
	 $this->db->where('user_assign',$userid);
	 $this->db->where('DATE(dateandtime)',$fromdate);
	 $this->db->where('status',14);
	 $this->db->from('masterproducttable');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->num_rows();
	 else
	 return "0";
	}
	
}
?>