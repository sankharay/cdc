<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adduser extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 function __construct(){
        // Note that there are (2) underscores (_)
           parent::__construct();  // Should always be the first thing you call.
		   $error[] = array();
		   $error_value = FALSE;
    }
	
	function index()
	{
	$data['content'] = "";
	$data['msg'] = "";
	if($this->input->post('fName') != "")
	{
	$activity = " New User Added with username: ".$this->input->post('uName');
	$this->log->logdata($activity);
	$this->load->model("usermanagement");
	$msg  = $this->usermanagement->insertuser();
	$content = $this->usermanagement->users();
	$this->session->set_userdata('useraddedd','User Added Succcessfully');
	$data['content'] = $content;
	$data['msg'] = $msg;
	redirect(BASE_URL.'/adduser');
	}
	$this->load->view("header");
	$this->load->view("adduser");
	$this->load->view("footer");
	$this->session->unset_userdata('useraddedd');
	}
	 
	 
	 function listusers()
	 {
	$activity = " List User";
	$this->log->logdata($activity);
	$this->load->model("usermanagement");
	$useraccesslevel = $this->session->userdata('accesslevel');
	if($useraccesslevel == 1 )
	$content = $this->usermanagement->users();
	else
	$content = $this->usermanagement->manager_users();
	$data['content'] = $content;
	$this->load->view("header");
	$this->load->view("listusers",$data);
	$this->load->view("footer");
	 }
	 
	 function userdetail()
	 {
		$activity = " Check User Details";
		$this->log->logdata($activity);
		$this->load->model("usermanagement");
		$userid = $this->uri->segment(3); 
		if($userid == "")
		{
		redirect(BASE_URL."/logout");	
		}
		else
		{
		$userdetails = $this->usermanagement->show_user($userid);
		$data['userdata'] = $userdetails;
		$this->load->view("userdetails",$data);
		}
	 }
	 
	 function deluserdetail()
	 {
		$activity = " Delete Users Page Access";
		$this->log->logdata($activity);
		$this->load->model("usermanagement");
		$userid = $this->uri->segment(3); 
		if($userid == "")
		{
		redirect(BASE_URL."/logout");	
		}
		else
		{
		$userdetails = $this->usermanagement->show_user($userid);
		$data['userdata'] = $userdetails;
		$this->load->view("userdeldetails",$data);
		}
	 }
	 
	 function deleteuserdata()
	 {
		$userid = $this->uri->segment(3); 
		$activity = " Delete User : ".$userid;
		$this->log->logdata($activity);
		$this->load->model("usermanagement");
		$userdeldetails = $this->usermanagement->delete_user($userid);
	 }
	 
	 function edituserdetail()
	 {
		$this->load->model("usermanagement");
		$userid = $this->uri->segment(3); 
		$activity = " Edit User : ".$userid;
		$this->log->logdata($activity);
		if($userid == "")
		{
		redirect(BASE_URL."/logout");	
		}
		else
		{
		$userdetails = $this->usermanagement->show_user($userid);
		$data['userdata'] = $userdetails;
		$this->load->view("edituserdetailsv",$data);
		}
	 }
	 
	 function updateuserdata()
	 {
		 $userid = $_GET['userid']; 
		$activity = " Update User : ".$userid;
		$this->log->logdata($activity);
		 if($_GET['pass'] != "")
		 {
		 $password = md5($_GET['pass']);
		 $data = array (
		 			"fname" => $_GET["fname"],
					"lname" => $_GET["lname"],
					"email" => $_GET["email"],
					"username" => $_GET["username"],
					"password" => $_GET["pass"],
					"access_level" => $_GET["value"]
		 				);
		 }
		 else
		 {
		 $data = array (
		 			"fname" => $_GET["fname"],
					"lname" => $_GET["lname"],
					"email" => $_GET["email"],
					"username" => $_GET["username"],
					"access_level" => $_GET["value"]
		 				); 
		 }
		 $this->db->where('user_id',$userid);
		$this->db->update('users',$data); 
		return TRUE;
	 }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */