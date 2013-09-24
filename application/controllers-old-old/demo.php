<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class demo extends CI_Controller {
	 
	 function __construct(){
        // Note that there are (2) underscores (_)
           parent::__construct();  // Should always be the first thing you call.
			$this->load->model("log");
		require_once(PLUGINS_URL.'/apiClient.php');
		require_once(PLUGINS_URL.'/contrib/apiTranslateService.php');
		require_once(PLUGINS_URL.'/LanguageTranslator.php');
    }
	 
	function index()
	{
	$activity = " Checking Raw Data";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['allusers'] = $this->contentsearchm->all_users();
	$data['content'] = $this->contentsearchm->search_products_raw();
	$this->load->view("header");
	$this->load->view("demo",$data);
	$this->load->view("footer-range");
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */