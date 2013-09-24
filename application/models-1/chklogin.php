<?php

class chklogin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function chklogin($username,$password)
    {
        $this->db->select("*");
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->from("users");
        $this->db->limit(1);
        $q = $this->db->get();
        if($q->num_rows() > 0 )
		{
					foreach($q->result_array() as $row){
						$data[] = $row;
					}
		
					$newdata = array(
						   'user_id' =>$data[0]['user_id'], 
						   'fname'  => $data[0]['fname'],
						   'lname'     => $data[0]['lname'],
						   'accesslevel'     => $data[0]['access_level'],
						   'logged_in' => TRUE
					   );
					   $this->session->set_userdata($newdata);
					   return TRUE;
		}
		else
		{
		return FALSE;	
		}
        
	}
}
?>
