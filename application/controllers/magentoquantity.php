<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class magentoquantity extends CI_Controller {

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
		$this->load->model('log');
		$this->load->model('magentoquantitym');
		include(PLUGINS_URL.'/excelreader/reader.php');
	    ini_set('upload_max_filesize', '200M');
    }
	
	function index()
	{
		if($this->input->post())
		{
		$config['upload_path'] = UPLOADEDFILES_URL.'/useruploadfiles/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '10000000000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload())
		{
			$this->session->set_userdata('update',$this->upload->display_errors());
			redirect(BASE_URL.'/magentoquantity');
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$uploaddata = array (
						'userid' => $this->session->userdata('user_id'),
						'filename' => $data['file_name'],
						'filefor' => '5',
						'status' => '1'
						);
			$this->db->insert('files_foraddproduct',$uploaddata);
			redirect(BASE_URL.'/magentoquantity');
		}
			
		}
		$data['content'] = $this->magentoquantitym->listfile($this->session->userdata('user_id'));
		$this->load->view('header');
		$this->load->view('magentoquantityv',$data);
		$this->load->view('footer');
	}
	
	function processfinalfilebyuser()
	{
	$fileid = $this->uri->segment(3);
	$userid = $this->session->userdata('user_id');
	// $this->db->truncate('finalmagento_qtycontent');
	$updatefilestatus = $this->magentoquantitym->updatefilerecord($fileid,$userid);
	$data['filename'] = $run = $this->magentoquantitym->get_filename($fileid,$userid);
	$this->load->view('header');
	$this->load->view('processfinalmagentofilebyuserv',$data);
	$this->load->view('footer');	
	}
	 
	 function useraccessingapi()
	 {
		 $fileid = $this->uri->segment(3);
		 $userid = $this->session->userdata('user_id');
		 // update file records start
		 $updatefilerecord = $this->magentoquantitym->updatefilerecord($fileid,$userid);
		 $vendorfilename = $this->magentoquantitym->get_filename($fileid,$userid);
		 if($vendorfilename == TRUE)
		 {
			 // everything okay file is okay
			 $result = $this->magentoquantitym->senddatatodb($vendorfilename->filename);
			 echo "Product Inserted Successfully";
		 }
		 else
		 {
			 // file not okay
			$message = $vendorid."User".$userid."Trying to Upload Wrong File";
			$this->load->library('email');
			$this->email->from('sandeepk@icurocao.com', 'Your Name');
			$this->email->to('sandeepk@icurocao.com');
			$this->email->cc('sandeep.kharay@gmail.com');
			$this->email->subject('Not Proper ');
			$this->email->message($message);
			$this->email->send();
			echo "sorry for inconvenience.We Already send mail to system administrator about this error";
		 }
	 }
	 
	 function pendingz()
	 {
	$activity = "Pending Spanish Content Only";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['content'] = $this->magentoquantitym->pending_products();
	$this->load->view("header");
	$this->load->view("pendingspanishv",$data);
	$this->load->view("footer");
	 }
	 
	 function finalz()
	 {
	$activity = "Visitng Spanish Finaize Contnet";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['content'] = $this->magentoquantitym->final_products();
	$this->load->view("header");
	$this->load->view("sendspanishv",$data);
	$this->load->view("footer");
	 }
	
	function addreviewspanish()
	{
	$spprid = $this->uri->segment(3);
	if($this->input->post())
	{
	$pname = $this->input->post('pName');
	$sku = $this->input->post('pSku');
	$upc = $this->input->post('pUpc');
	$shortdes = $this->input->post('pShortDesc');
	$des = $this->input->post('pDesc');
	$spec = $this->input->post('pSpecs');
	$spec = $this->input->post('pSpecs');
	$pmetainformation = $this->input->post('pMetatags');
	$pMetadescription = $this->input->post('pMetadescription');
	$data = array (
			'prduct_name'=>htmlspecialchars($pname),
			'short_description'=>htmlspecialchars($shortdes),
			'product_description'=>htmlspecialchars($des),
			'product_sku'=>$sku,
			'product_upc'=>$upc,
			'product_specs'=>htmlspecialchars($spec),
			'product_metatags'=>htmlspecialchars($pmetainformation),
			'product_metadescription'=>htmlspecialchars($pMetadescription),
			'status'=>2,
					);
	 $update = $this->magentoquantitym->updatecontent($data,$spprid);
	 if($update)
	 {
		$this->session->set_userdata('update','Data Updated');
		redirect(BASE_URL.'/addfinalspanishdata/pendingz/'); 
	 }
	 else
	 {
		$this->session->set_userdata('update','Data Not Updated');
		redirect(BASE_URL.'/addfinalspanishdata/pendingz/');
	 }
	}
	$data['spanish_content'] = $this->magentoquantitym->getothersproductqa($spprid);
	$this->load->view("header");
	$this->load->view("addreviewspanishdatav",$data);
	$this->load->view("footer");
	}
	
	function reviewpending()
	{
	$activity = "Admin Reviewing Spanish Data";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['allusers']=$this->magentoquantitym->all_users();
	$data['content'] = $this->magentoquantitym->admin_pending_products();
	$this->load->view("header");
	$this->load->view("pendingspanishv",$data);
	$this->load->view("footer");
	}
	
	function processassign()
	{
	$activity = "Spanish Content Product Processed After Review assign to USA Team";
	$this->log->logdata($activity);
	$content = $this->magentoquantitym->processproducts();
	echo $content;
	}
	 
	 function updateapiinventrytable()
	 {
		 $fileid = $this->uri->segment(3);
		 $userid = $this->session->userdata('user_id');
		 // update file records start
		 $updatefilerecord = $this->magentoquantitym->updatefilerecord($fileid,$userid);
		 $vendorfilename = $this->magentoquantitym->get_filename($fileid,$userid);
		 if($vendorfilename == TRUE)
		 {
			 // everything okay file is okay
			 $result = $this->magentoquantitym->updateapiinventrydatatodb($vendorfilename->filename);
			 echo "Product Inserted Successfully";
		 }
		 else
		 {
			 // file not okay
			$message = $vendorid."User".$userid."Trying to Upload Wrong File";
			$this->load->library('email');
			$this->email->from('sandeepk@icurocao.com', 'Your Name');
			$this->email->to('sandeepk@icurocao.com');
			$this->email->cc('sandeep.kharay@gmail.com');
			$this->email->subject('Not Proper ');
			$this->email->message($message);
			$this->email->send();
			echo "sorry for inconvenience.We Already send mail to system administrator about this error";
		 }
	 }
	 
	
}

