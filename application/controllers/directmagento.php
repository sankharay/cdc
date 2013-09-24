<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class directmagento extends CI_Controller {

	 function __construct(){
        parent::__construct(); 
		$this->load->model('log');
		$this->load->model('directmagentom');
		$this->load->library('image_lib');
    }
	 
	public function index()
	{
			$data['content'] = $this->directmagentom->listfile($this->session->userdata('user_id'));
			$this->load->view('header');
			$this->load->view('directmagentov',$data);
			$this->load->view('footer');
	}
	 
	 function uploadfile()
	{
		if($this->input->post())
		{
		$config['upload_path'] = UPLOADEDFILES_URL.'/useruploadfiles/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '10000000000';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_userdata('update',$this->upload->display_errors());
			redirect(BASE_URL.'/directmagento/uploadfile');
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$uploaddata = array (
						'userid' => $this->session->userdata('user_id'),
						'filename' => $data['file_name'],
						'filefor' => '4',
						'status' => '1'
						);
			$this->db->insert('files_foraddproduct',$uploaddata);
			redirect(BASE_URL.'/directmagento/uploadfile');
	}
			
		}$data['content'] = $this->directmagentom->listfile($this->session->userdata('user_id'));
			
			$this->load->view('header');
			$this->load->view('directmagentov',$data);
			$this->load->view('footer');
	}
	
	function processfinalfilebyuser()
	{
	$fileid = $this->uri->segment(3);
	$userid = $this->session->userdata('user_id');
	$data['allusers'] = $this->directmagentom->all_users();
	$data['vendors'] = $this->directmagentom->get_vendors();
	$data['filename'] = $run = $this->directmagentom->get_filename($fileid,$userid);
	$this->load->view('header');
	$this->load->view('directmagentofilebyuserv',$data);
	$this->load->view('footer');	
	}
	 
	 function useraccessingapi()
	 {
		 $fileid = $this->input->get('fileid');
		 $vendorid = $this->input->get('vendorid');
		 $userid = $this->session->userdata('user_id');
		 $attributes=$this->input->get('attributes');
		 if(isset($attributes))
		 $attributes = $this->input->get('attributes');
		 else
		 $attributes = "";
		 $vendoruserid = $this->input->get('vendoruserid');
		 // update file records start
		 $updatefilerecord = $this->directmagentom->updatefilerecord($fileid,$userid);
		 // update file records ends
		 $data['vendorverified'] = $this->directmagentom->verifyvendor($vendorid);
		 $vendorfilename = $this->directmagentom->get_filename($fileid,$userid);
		 $vendortemplatedetails = $this->directmagentom->getvendortemplate($vendorid);
		 if($vendortemplatedetails)
		 {
		 $validateexcel = $this->directmagentom->matchexcelfields($vendorfilename->filename,$vendortemplatedetails->template_excelstructure);
		 }
		 else
		 {
		 echo "<div class='alert alert-error'><button data-dismiss='alert' class='close' type='button'>×</button>
							<strong>Oh snap!</strong>Please select right Vendor</div>";
		 exit;
		 }
		 if($validateexcel == TRUE)
		 {
			 // everything okay file is okay
			 $result = $this->directmagentom->senddatatodb($vendorfilename->filename,$vendortemplatedetails,$vendorid,$attributes);
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
	 
	function getvendordata($fpl_id,$product_upc,$product_source)
	{
	$fpl_id = $this->uri->segment(3);
	$product_sku = $this->uri->segment(4);
	$product_source = $this->uri->segment(5);
	$imagealreadycopied = $this->imagesectionm->checkimg($fpl_id);
	if(!$imagealreadycopied)
	$data['image_check'] = $this->directmagentom->getimage_mastertable($fpl_id,$product_upc);
	// redirect(BASE_URL."/imagesection/index/".$fpl_id);
	exit;
	}
	
	function viewproductothersqa()
	{
	$mpt_id =$this->uri->segment(3); 
	$data['content'] = $this->addcontentm->getothersproductqa($mpt_id);
	$fpl_id = $this->addcontentm->get_fpl_id($mpt_id);
	$data['images'] = $this->addcontentm->get_images($fpl_id);
	$this->load->view("viewotherproductqav",$data);
	}
	
	
}

?>