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
			$this->load->helper('form');
			$catname = $this->input->post('catname');
			$parentcatid = $this->input->post('parentcatid');
			$magengDesc = $this->input->post('magengDesc');
			$magspanishname = $this->input->post('magspanishname');
			// image Uploading start 
			$config['upload_path'] = PLUGINS_URL.'/cropping/categories/';
			$config['allowed_types'] = 'jpg';
			$config['max_size']	= '10000';
			$config['max_width']  = '2024';
			$config['max_height']  = '2068';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload())
		{
		$this->session->set_userdata('updated',$this->upload->display_errors());
		}
		else
		{
			$imagedata = $this->upload->data();
			$imagename = $imagedata['file_name'];
			$catid = $this->categorymanagementm->insertcat($catname,$parentcatid,$magengDesc,$imagename,$magspanishname);
			$whatupdate = 1;
			$this->log->cdcupdate($catid,$whatupdate);
		}
			// Image Uploading ends
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