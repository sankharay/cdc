<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Systemupdates extends CI_Controller {
	 
	 function __construct(){
        // Note that there are (2) underscores (_)
           parent::__construct();
		   $this->load->model('systemupdatesm');
    }
	
	function index()
	{
	$data['content'] = $this->systemupdatesm->get_content();
	$this->load->view('header');
	$this->load->view('systemupdatesv',$data);
	$this->load->view('footer');
	}
	 
	
}