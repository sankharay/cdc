<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sendtomagento extends CI_Controller {

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
           parent::__construct();
		   $this->load->model('sendtomagentom');
    }
	
	function index()
	{
	  	$fpl_id = $this->uri->segment(3);
	  $checkfpl_id = $this->sendtomagentom->check_fpl_id_exist($fpl_id);
	  if($checkfpl_id)
	  {
		$englishdata = $this->sendtomagentom->get_english_data($fpl_id);
		print_r($englishdata);
	  }
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */