<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

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
	$this->session->unset_userdata('fname');
	$this->session->unset_userdata('lname');
	$this->session->unset_userdata('level');
	$this->session->unset_userdata('logged_in');
	$this->session->sess_destroy();
	redirect(BASE_URL);
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */