<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vendorreporting extends CI_Controller {

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
		   $this->load->model('vendorreportingm');
    }
	
	function index()
	{
	$rejectionscontent = array();
	$fromdate = date("Y-m-d", strtotime($this->input->post('ffromDate')));
	$todate = date("Y-m-d", strtotime($this->input->post('ftoDate')));
	$data['rejections'] = $this->vendorreportingm->getrejected($fromdate,$todate);
	$this->load->view('vendorreportingv',$data);
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */