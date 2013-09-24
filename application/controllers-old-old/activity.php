<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {

	 function __construct(){
           parent::__construct();
		   $this->load->model("log");
    }
	 
	public function index()
	{
			$activity = " has check user activity";
			$this->log->logdata($activity);
			$this->load->model('activitym');
			$data['content'] = $this->activitym->listactivity();
			$this->load->view('header');
			$this->load->view('activityv',$data);
			$this->load->view('footer');
	}
	
}

?>