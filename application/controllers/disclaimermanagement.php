<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class disclaimermanagement extends CI_Controller {

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
		   $this->load->model('disclaimermanagementm');
    }
	
	function index()
	{
		$data['content']=$this->disclaimermanagementm->get_alldisclaimers();
		$this->load->view('header');
		$this->load->view('disclaimermanagementv',$data);
		$this->load->view('footer');
	}
	
	function disclaimeradd()
	{
		if($this->input->post())
		{
		$name=$this->input->post("name");
		$english=$this->input->post("english");
		$spanish=$this->input->post("spanish");
		$status=$this->input->post("status");
		if($name != "" AND $english!="" AND $spanish!="" AND $status!="")
		{
		$datainsert = $this->disclaimermanagementm->disclaimerinsert($name,$english,$spanish,$status);
		if($datainsert)
		{
		$this->session->set_userdata('update','New Disclaimer Added Successfully');
		redirect(BASE_URL.'/disclaimermanagement');
		exit;	
		}
		else
		{
		$this->session->set_userdata('update','New Disclaimer Not Added');
		redirect(BASE_URL.'/disclaimermanagement');
		exit;
		}
		}
		}
		$this->load->view('disclaimeraddv');
	}
	
	function disedit()
	{
		$id=$this->uri->segment(3);
		if($this->input->post())
		{
		$name=$this->input->post("name");
		$english=$this->input->post("english");
		$spanish=$this->input->post("spanish");
		$status=$this->input->post("status");
		if($name != "" AND $english!="" AND $spanish!="" AND $status!="" AND $id!="")
		{
		$dataedit = $this->disclaimermanagementm->disclaimeredit($name,$english,$spanish,$status,$id);
		if($dataedit)
		{
		$this->session->set_userdata('update','Disclaimer Edit Successfully');
		redirect(BASE_URL.'/disclaimermanagement');
		exit;	
		}
		else
		{
		$this->session->set_userdata('update','Disclaimer Not Edit');
		redirect(BASE_URL.'/disclaimermanagement');
		exit;
		}
		}
		}
		$data['content'] = $this->disclaimermanagementm->getdisclaimer($id);
		$this->load->view('disclaimereditv',$data);
	}
	
	function disview()
	{
		$id=$this->uri->segment(3);
		$data['content'] = $this->disclaimermanagementm->getdisclaimer($id);
		$this->load->view('disclaimerviewv',$data);
	}
	
	function disdelete()
	{
		$id=$this->uri->segment(3);
		if($this->input->post())
		{
		if($id != "")
		{
		$datadel = $this->disclaimermanagementm->deldisc($id);
		if($datadel)
		{
		$this->session->set_userdata('update','Disclaimer Delete Successfully');
		redirect(BASE_URL.'/disclaimermanagement');
		exit;
		}
		else
		{
		$this->session->set_userdata('update','Disclaimer Delete Unsuccessfull');
		redirect(BASE_URL.'/disclaimermanagement');
		exit;
		}
		}
		}
		$data['content'] = $this->disclaimermanagementm->getdisclaimer($id);
		$this->load->view('disclaimerdeletev',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */