<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reporting extends CI_Controller {

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
		   $this->load->model('reportingm');
    }
	
	function index()
	{
	$data['users'] = $this->reportingm->list_users();
	$this->load->view('header');
	$this->load->view('reportingv',$data);
	$this->load->view('footer');
	}
	
	function get()
	{
	$userid = $this->input->get('userid');
	$fromDate = $this->input->get('fromDate');
	$toDate = $this->input->get('toDate');
	if($fromDate > $toDate )
	{
	echo "From Date Can't More then TO date";
	exit;	
	}
	else
	{
	$data['englishreadhy'] = $this->reportingm->get_data_english_ready($userid,$fromDate,$toDate);
	$data['spanishreadhy'] = $this->reportingm->get_data_spanish_ready($userid,$fromDate,$toDate);
	$data['dataunderprocessing'] = $this->reportingm->get_data_processing_ready($userid,$fromDate,$toDate);
	$data['dataunderpending'] = $this->reportingm->get_data_pending_ready($userid,$fromDate,$toDate);
	$this->load->view('reportingshow',$data);
	}
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */