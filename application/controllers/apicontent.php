<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class apicontent extends CI_Controller {
	 
	 function __construct(){
           parent::__construct();
		   $this->load->model('apicontentm');
		   $this->load->library('pagination');
    }
	 
	 function index()
	 {
		$config = array();
		$config["base_url"] = base_url() . "apicontent/index";
		$config["total_rows"] = $this->apicontentm->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["content"] = $this->apicontentm->fetch_orders($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		// $this->load->view("example1", $data);
		$this->load->view('header');
		$this->load->view('apicontentv',$data);
		$this->load->view('ajax_footer');
	 }
	
	function viewproductothersqa()
	{
	$mpt_id =$this->uri->segment(3); 
	$data['content'] = $this->apicontentm->getothersproductqa($mpt_id);
	$this->load->view("viewapiproductqav",$data);
	}
	 
	
}