<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class finaproducts extends CI_Controller {

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
		   $this->load->model("finalproductsm");
    }
	
	function index()
	{
		$user_id = $this->session->userdata("user_id");
		$data['content']= $this->finalproductsm->get_finalproducts($user_id);
		$this->load->view('header');
		$this->load->view('finalmagento_ready_v',$data);
		$this->load->view('footer');
	}
	
	function productnotification()
	{
		$user_id = $this->session->userdata("user_id");
		$data['content']= $this->finalproductsm->get_final_notification_products($user_id);
		$this->load->view('header');
		$this->load->view('productnotificationv',$data);
		$this->load->view('footer');
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */