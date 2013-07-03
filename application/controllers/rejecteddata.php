<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rejecteddata extends CI_Controller {
	 
	 function __construct(){
           parent::__construct();
		   $this->load->model('rejecteddatam');
    }
	
	function index()
	{
		$data['content'] = $this->rejecteddatam->get_content();
		$this->load->view('header');
		$this->load->view('rejecteddata/rejecteddatav',$data);
		$this->load->view('footer');
	}
	
	function viewdata()
	{
	$contentid = $this->uri->segment(3);
	$data['content'] = $this->rejecteddatam->get_data($contentid);
	$this->load->view('rejecteddata/viewdatav',$data);
	}
	
	function editdata()
	{
	$contentid = $this->uri->segment(3);
	if($this->input->post('header') != "" AND $this->input->post('details') != "" AND $this->input->post('id') != "")
	{
	$data = array (
			'header' => $this->input->post('header'),
			'details' =>$this->input->post('details')
					);
		$this->rejecteddatam->updatecontent($data,$this->input->post('id'));
		exit;
	}
	$data['content'] = $this->rejecteddatam->get_data($contentid);
	$this->load->view('rejecteddata/editdatav',$data);
	}
	
	function deletedata()
	{
	if($this->input->post('id') != "")
	{
		$this->rejecteddatam->deletecontent($this->input->post('id'));
		exit;
	}
	$contentid = $this->uri->segment(3);
	$data['content'] = $this->rejecteddatam->get_data($contentid);
	$this->load->view('rejecteddata/deletedatav',$data);
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */