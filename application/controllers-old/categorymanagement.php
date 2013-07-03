<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categorymanagement extends CI_Controller {

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
		   $this->load->model('categorymanagementm');
		   $this->load->helper("form");
    }
	 
	 function index()
	 {
		 if($this->input->post())
		 {
			$catname = $this->input->post('catname');
			$parentcatid = $this->input->post('parentcatid');
			$magengid = $this->input->post('magengid');
			$magspaid = $this->input->post('magspaid');
			$magspanishname = $this->input->post('magspanishname');
			$this->categorymanagementm->insertcat($catname,$parentcatid,$magengid,$magspaid,$magspanishname);
		 }
		 $data['content'] = $this->categorymanagementm->listcat();
		 $this->load->view("header");
		 $this->load->view("categorymanagementv",$data);
		 $this->load->view("footer");
	 }
	
	function catedit()
	{
	$catid = $this->uri->segment(3);
	$checkcat = $this->categorymanagementm->catexist($catid);
		 if($this->input->post())
		 {
			$catname = $this->input->post('catname');
			$parentcatid = $this->input->post('parentcatid');
			$magengid = $this->input->post('magengid');
			$magspaid = $this->input->post('magspaid');
			$magspanishname = $this->input->post('magspanishname');
			$update = $this->categorymanagementm->updatecat($catid,$catname,$parentcatid,$magengid,$magspaid,$magspanishname);
			if($update)
			redirect(BASE_URL."/categorymanagement/");
		 }
		 $data['content'] = $this->categorymanagementm->catdetail($catid);
		 $this->load->view("header");
		 $this->load->view("cateditv",$data);
		 $this->load->view("footer");
	}
	
	function catdel()
	{
	$catid = $this->uri->segment(3);
	$checkcat = $this->categorymanagementm->catexist($catid);
		 if($this->input->post())
		 {
			$update = $this->categorymanagementm->delcat($catid);
			if($update)
			redirect(BASE_URL."/categorymanagement/");
		 }
		 $data['content'] = $this->categorymanagementm->catdetail($catid);
		 $this->load->view("header");
		 $this->load->view("catdelv",$data);
		 $this->load->view("footer");
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */