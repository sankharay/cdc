<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class addfinalproductdata extends CI_Controller {

	 function __construct(){
        parent::__construct(); 
		$this->load->model('log');
		$this->load->model('addfinalproductdatam');
		$this->load->library('image_lib');
		require_once(PLUGINS_URL.'/apiClient.php');
		require_once(PLUGINS_URL.'/contrib/apiTranslateService.php');
		require_once(PLUGINS_URL.'/LanguageTranslator.php');
    }
	 
	public function index()
	{
			$data['content'] = $this->addfinalproductdatam->listfile($this->session->userdata('user_id'));
			$this->load->view('header');
			$this->load->view('addfinalproductdatav',$data);
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
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$uploaddata = array (
						'userid' => $this->session->userdata('user_id'),
						'filename' => $data['file_name'],
						'filefor' => '2',
						'status' => '1'
						);
			$this->db->insert('files_foraddproduct',$uploaddata);
	}
			
		}$data['content'] = $this->addfinalproductdatam->listfile($this->session->userdata('user_id'));
			
			$this->load->view('header');
			$this->load->view('addfinalproductdatav',$data);
			$this->load->view('footer');
	}
	
	function processfinalfilebyuser()
	{
	$fileid = $this->uri->segment(3);
	$userid = $this->session->userdata('user_id');
	$data['allusers'] = $this->addfinalproductdatam->all_users();
	$data['vendors'] = $this->addfinalproductdatam->get_vendors();
	$data['filename'] = $run = $this->addfinalproductdatam->get_filename($fileid,$userid);
	$this->load->view('header');
	$this->load->view('processfinalfilebyuserv',$data);
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
		 $updatefilerecord = $this->addfinalproductdatam->updatefilerecord($fileid,$userid);
		 // update file records ends
		 $data['vendorverified'] = $this->addfinalproductdatam->verifyvendor($vendorid);
		 $vendorfilename = $this->addfinalproductdatam->get_filename($fileid,$userid);
		 $vendortemplatedetails = $this->addfinalproductdatam->getvendortemplate($vendorid);
		 if($vendortemplatedetails)
		 {
		 $validateexcel = $this->addfinalproductdatam->matchexcelfields($vendorfilename->filename,$vendortemplatedetails->template_excelstructure);
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
			 $result = $this->addfinalproductdatam->senddatatodb($vendorfilename->filename,$vendortemplatedetails,$vendorid,$vendoruserid,$attributes);
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
	$data['image_check'] = $this->addfinalproductdatam->getimage_mastertable($fpl_id,$product_upc);
	// redirect(BASE_URL."/imagesection/index/".$fpl_id);
	exit;
	}
	
	
}

?>