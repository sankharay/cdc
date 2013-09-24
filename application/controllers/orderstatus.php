<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orderstatus extends CI_Controller {

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
           parent::__construct();
		   $this->load->model('orderstatusm');
		   $this->load->library("pagination");
		   $this->db = $this->load->database('forum', TRUE);
    }
	
	function index()
	{
		$data['days'] = $this->orderstatusm->get_config_days();
        $config = array();
        $config["base_url"] = BASE_URL."/orderstatus/index";
        $config["total_rows"] = $this->orderstatusm->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["content"] = $this->orderstatusm->fetch_orders($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
 
        // $this->load->view("example1", $data);
		
		$this->load->view('header');
		$this->load->view('orderstatusv',$data);
		$this->load->view('ajax_footer');
	}
	
	function seacrhresult()
	{
		$orid = $this->uri->segment(3);
		if($orid == "")
		{
		echo "No Seach Found";	
		exit;
		}
		$data['days'] = $this->orderstatusm->get_config_days();
		$data['content'] = $da =  $this->orderstatusm->getallorderbyid($orid);
		$this->load->view('seachorderstatusv',$data);
		
	}
	
	function seacrhresultdate()
	{
		$from = $this->uri->segment(3);
		$to = $this->uri->segment(4);
		if($from == "" OR $to == "" )
		{
		echo "No Seach Found";	
		exit;
		}
		$data['days'] = $this->orderstatusm->get_config_days();
		$data['content'] = $da =  $this->orderstatusm->getallorderbydate($from,$to);
		$this->load->view('seachorderstatusv',$data);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */