<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class brandmanagement extends CI_Controller {

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
	   $this->load->model('brandmanagementm');
    }
	
	function index()
	{
	$data['content']=$this->brandmanagementm->brandload();
	$this->load->view('header');
	$this->load->view('brandmamagementv',$data);
	$this->load->view('footer');
	}
	
	function brandadd()
	{
	if($this->input->post())
	{
	$brandName = $this->input->post('brandName');
	$brandMagentoId = $this->input->post('brandMagentoId');
	$status = $this->input->post('status');	
	if($brandName != "" AND $brandMagentoId!= "" AND $status!= "")
	{
	$checkbexist = $this->brandmanagementm->duplicates_brand($brandName);
	$checkmexist = $this->brandmanagementm->duplicates_magid($brandMagentoId);
	if($checkbexist == FALSE AND $checkmexist == FALSE)
	{
	$datainsert = $this->brandmanagementm->insetbrand($brandName,$brandMagentoId,$status);
	if($datainsert)
	{
	$this->session->set_userdata('update','New Brand Added');
	redirect(BASE_URL.'/brandmanagement');
	exit;
	}
	}
	else
	{
	$this->session->set_userdata('update','Brand Name OR Magento ID Already Exist');
	redirect(BASE_URL.'/brandmanagement');
	exit;
	}
	}
	}
	$this->load->view('brandaddv');
	}
	
	function brandedit()
	{
	$brandid = $this->uri->segment(3);
	if($this->input->post())
	{
	$brandName = $this->input->post('brandName');
	$brandMagentoId = $this->input->post('brandMagentoId');
	$status = $this->input->post('status');	
	if($brandName != "" AND $brandMagentoId!= "" AND $status!= "")
	{
	$checkbexist = $this->brandmanagementm->duplicates_brand_edit($brandName,$brandid);
	$checkmexist = $this->brandmanagementm->duplicates_magid_edit($brandMagentoId,$brandid);
	if($checkbexist == FALSE AND $checkmexist == FALSE)
	{
	$datainsert = $this->brandmanagementm->editbrand($brandName,$brandMagentoId,$status,$brandid);
	if($datainsert)
	{
	$this->session->set_userdata('update','Brand Editing DONE');
	redirect(BASE_URL.'/brandmanagement');
	exit;
	}
	}
	else
	{
	$this->session->set_userdata('update','Brand Name OR Magento ID you are trying to edit Already Exist');
	redirect(BASE_URL.'/brandmanagement');
	exit;
	}
	}
	}
	$data['content'] = $this->brandmanagementm->getbrandetails($brandid);
	$this->load->view('brandeditv',$data);
	}
	
	function branddelete()
	{
	$brandid = $this->uri->segment(3);
	$data['content'] = $this->brandmanagementm->getbrandetails($brandid);
	if($this->input->post())
	{
	$datadelete = $this->brandmanagementm->deletebrand($brandid);
	if($datadelete)
	{
	$this->session->set_userdata('update','Brand Name Deleted');	
	redirect(BASE_URL.'/brandmanagement');
	exit;
	}
	else
	{
	$this->session->set_userdata('update','Brand Name Not Deleted');
	redirect(BASE_URL.'/brandmanagement');
	exit;
	}
	}
	$this->load->view('branddeletev',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */