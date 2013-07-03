<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class addonmanagement extends CI_Controller {

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
		   $this->load->model('addonmanagementm');
    }
	 
	 function index()
	 {
	 $data['content'] = $this->addonmanagementm->listreadyproduct();
	 $this->load->view('header');
	 $this->load->view('addonmanagementv',$data);
	 $this->load->view('footer');
	 }
	 
	 function checkaddons()
	 {
	 $fplid = $this->uri->segment(3);
	 $data['fplid'] = $fplid;
	 $data['content'] = $this->addonmanagementm->getaddons($fplid);
	 $this->load->view('checkaddons',$data);
	 }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */