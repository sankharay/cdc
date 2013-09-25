<?php

class orderstatusm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		 $this->db_forum = $this->load->database('forum', TRUE);  
    }
	
    function getallorders()
    {
         $this->db->select("*");
		 $this->db->select_max('entity_id');
		 $this->db->where('entity_name','order');
		 $this->db->order_by('created_at','desc');
		 $this->db->from('sales_flat_order_status_history');
		 $data = $this->db->get();
		 if($data->num_rows() > 0)
		 return $data->result();
		 else
		 return FALSE;
	}
	
    function getallorderbyid($orderid)
    {
         $this->db->select('*');
		 $this->db->where("parent_id = $orderid");
		 $this->db->where('entity_name','order');
		 $this->db->group_by('parent_id');
		 $this->db->from('sales_flat_order_status_history');
		 $data = $this->db->get();
		 if($data->num_rows() > 0)
		 return $data->result();
		 else
		 return FALSE;
	}
	
    function getallorderbydate($from,$to)
    {
		$from = str_replace("-","/",$from);
		$to = str_replace("-","/",$to);
		$from  = date("Y-m-d", strtotime($from));
		$to  = date("Y-m-d", strtotime($to));
         $this->db->select('*');
		 $this->db->where('DATE(created_at)>=',"$from");
		 $this->db->where('DATE(created_at) <=',"$to");
		 $this->db->where('entity_name','order');
		 $this->db->group_by('parent_id');
		 $this->db->from('sales_flat_order_status_history');
		 $data = $this->db->get();
		 if($data->num_rows() > 0)
		 return $data->result();
		 else
		 return FALSE;
	}
	
    function checkorderid($orderid,$entityid)
    {
         $this->db->select('*');
		 $this->db->where("parent_id = $orderid AND entity_id != $entityid");
		 $this->db->where('entity_name','order');
		 $this->db->from('sales_flat_order_status_history');
		 $data = $this->db->get();
		 if($data->num_rows() > 0)
		 {
		 return TRUE;
		 }
		 else
		 {
		 return FALSE;
		 }
	}
	
    function getallorderunderid($orderid,$entityid)
    {
         $this->db->select('*');
		 $this->db->where("parent_id = $orderid");
		 $this->db->where('entity_name','order');
		 // $this->db->order_by('entity_id DESC');
		 $this->db->from('sales_flat_order_status_history');
		 $data = $this->db->get();
		 if($data->num_rows() > 0)
		 {
		 return $data->result();
		 }
		 else
		 {
		 return FALSE;
		 }
	}
	
	public function record_count() {
        return $this->db->count_all("sales_flat_order_status_history");
    }
	
	public function fetch_orders($limit, $start) {
		$this->db->select('*');
		 $this->db->group_by('parent_id');
		 $this->db->order_by('entity_id DESC');
		 $this->db->where('entity_name','order');
        $this->db->limit($limit, $start);
        $query = $this->db->get("sales_flat_order_status_history");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function get_config_days()
   {
	return "5";
	$this->db->select('*');
	$this->db->from('config_sales_comments');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return $data->row()->days;
	else
	return false;
   }
   
   function getallorderinid($orderid)
   {
         $this->db->select('*');
		 $this->db->where("parent_id = $orderid");
		 $this->db->where('entity_name','order');
		 $this->db->from('sales_flat_order_status_history');
		 $data = $this->db->get();
		 if($data->num_rows() > 0)
		 {
		 return $data->result();
		 }
		 else
		 {
		 return FALSE;
		 } 
   }
   
   function getstatus($orderid,$days)
   {
	   
	   $olddate = "";
		   $colorarray = array (
		   			'0' => "Green",
		   			'1' => "Green",
		   			'2' => "Yellow",
		   			'3' => "Red"
		   						);
   $dataunderid = $this->getallorderinid($orderid);
   foreach($dataunderid as $datediff)
   {
	  if(($datediff->created_at > $olddate) AND $olddate != "")
	  {
		$getres = strtotime("$datediff->created_at") - strtotime("$olddate");
		$dayss = round($getres / (24 * 60 * 60 ) );
	  }
	  elseif($olddate != "")
	  {
		$getres = strtotime("$olddate") - strtotime("$datediff->created_at");
		$dayss = round($getres / (24 * 60 * 60 ) );
	  }
   $olddate = $datediff->created_at;
   if(isset($dayss))
   {
		   if(isset($realdiff))
		   {
				   if($dayss >= $realdiff)
				   $realdiff = $dayss;
			}
			else
			$realdiff = $dayss;
   }
   }
   if(isset($realdiff))
   {
   if($realdiff >= $days)
   return $colorarray['3'];
   elseif($realdiff > "1")
   return $colorarray['2'];
   elseif($realdiff < "1")
   return $colorarray['1'];
   else
   return $colorarray['0'];
   }
   else
   return FALSE;
   }
   
   function getinterval($todate,$fromdate)
   {
		$numseconds = $getres = strtotime("$todate") - strtotime("$fromdate");
		$time = $numseconds;

		$days = floor($time / (60 * 60 * 24));
		$time -= $days * (60 * 60 * 24);
		
		$hours = floor($time / (60 * 60));
		$time -= $hours * (60 * 60);
		
		$minutes = floor($time / 60);
		$time -= $minutes * 60;
		
		$seconds = floor($time);
		$time -= $seconds;
		if($days != 0)
		return "{$days}days <br>{$hours} hour<br>{$minutes} min.<br>{$seconds} sec";
		if($days == 0)
		return "{$hours} hour<br>{$minutes} min.<br>{$seconds} sec";
		if($hours == 0)
		return "{$minutes} min.<br>{$seconds} sec";
		if($minutes == 0)
		return "{$seconds} sec";
   }
   
}
?>
