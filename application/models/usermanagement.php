<?php

class usermanagement extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	// to insert new user
    function insertuser(){
		$value = '';
		
		 $data = array(
               'fname' => $this->input->post('fName'),
               'lname' => $this->input->post('lName'),
               'email' => $this->input->post('email'),
			   'username' => $this->input->post('uName'),
			   'password' => md5($this->input->post('pass')),
			   'access_level' => $this->input->post('aLevel')
            );

		if($this->db->insert('users', $data)){
			
		 $data = array(
               'userId' => $this->session->userdata('user_id'),
               'activity' => $this->session->userdata('fname').' '.$this->session->userdata('lname').' has created a user' ,
               'date' => date('Y-m-d'),
			   'time' => date('h:i:s A')
            );
		  $this->db->insert('useractivity', $data); 	
		
			$msg =  '<h4 class="alert_success">User has been inserted successfully</h4>';
		}else{
			$msg = '<h4 class="alert_error">User is not inserted successfully</h4>';
		}
		
		return $msg;
	}
	
	function checkusername($username)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$q = $this->db->get();
		if($q->num_rows() > 0) 
			{
            return TRUE;
            }
			else
			{
        	return FALSE;
			}
	}
	
	function users(){
		$this->db->select('*');
		$this->db->from('users');
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	function manager_users()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('access_level != ',1);
		$this->db->where('access_level != ','');
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	function show_user($id)
	{
	$query = $this->db->query("select * from users where user_id = $id");
	return $query->result();
	}
	
	function delete_user($id)
	{
	$this->db->where('user_id',$id);
	$this->db->delete('users');
	return TRUE;
	}
	
	function access_level($data)
	{
		if($data == "")
		{
			echo "<span class='label label-important'>No Access</span>";
		}
		else	
		{
		$arr = array(
			'1' => 'Administrator',
			'2' => 'Manager',
			'3' => 'User'
		 );
						$ac = explode(',',$data);
						foreach($ac as $value){
							echo "<div class='label label-success'>".$arr[$value]."</div>";
						} 
		}
	
	}
	
	
	
}
?>
