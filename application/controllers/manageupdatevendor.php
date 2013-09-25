<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manageupdatevendor extends CI_Controller {

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
		   $error = FALSE;
		   $this->load->model('manageupdatevendorm');
			error_reporting(E_ALL);
    }
	
	function index()
	{
	$data['content'] = $this->manageupdatevendorm->listvendors();
	$this->load->view("header");
	$this->load->view("managevendorv",$data);
	$this->load->view("footer");
	}
	
	function delvendors()
	{
	$vendorid = $this->uri->segment(3);
	if($this->input->post('delvee'))
	{
	$updatedelte = $this->manageupdatevendorm->deletevendor($vendorid);
	$this->session->set_userdata('update','Vendor Deleted');
	if($updatedelte)
	redirect(BASE_URL."/managevendor/viewvendors/");
	}
	$data['content'] = $this->manageupdatevendorm->editvendors($vendorid);
	$this->load->view("vendordeletev",$data);
	}
	
	function viewvendors()
	{
	$data['content'] = $this->manageupdatevendorm->listvendors();
	$this->load->view("header");
	$this->load->view("managevendorv",$data);
	$this->load->view("footer");	
	}
	
	function editvendors()
	{
	$vendorid = $this->uri->segment(3);
	$error = FALSE;
	// $data = $this->manageupdatevendorm->editvendors($vendorid);
	if($this->input->post('cpassword') == "editpass")
	{
		$password = $this->input->post('vpassword');
		$cpassword = $this->input->post('vcpassword');
		if($password != $cpassword)
		{
			$error = TRUE;
			$this->session->set_userdata('pnm','Password not matching');
		}else
		{
		$result = $this->manageupdatevendorm->changepassword($password,$vendorid);
		if($result)
		{
		$this->session->set_userdata('update','Password Changed');
		redirect(BASE_URL."/managevendor/editvendors/".$vendorid);
		}
		}
	}
	if($this->input->post('submit') == "Update")
	{
	$vname = $this->input->post('vname');
	$vusername = $this->input->post('vusername');
	$vemail = $this->input->post('vemail');
	$vdetails = $this->input->post('vdetails');
	$vhostip = $this->input->post('vhostip');
	$vpassword = $this->input->post('vpassword');
	$vstatus = $this->input->post('vstatus');
	if($vname == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor name not null"; 
	}
	if($vusername == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor username not null"; 
	}
	if($vemail == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor email not null"; 
	}
	if($vdetails == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor details not null"; 
	}
	if($vhostip == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor IP Address not null"; 
	}
	if($vpassword == "")
	{
		$error = TRUE;
		$data['error'] = "Password not null"; 
	}
	if($error == FALSE)
	{
		$result = $this->manageupdatevendorm->editvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vendorid,$vpassword);
		if($result)
		{
		$this->session->set_userdata('update','Vendor Editing Done');
		redirect(BASE_URL."/managevendor/editvendors/".$vendorid);
		}
	}
	
	}
	$data['content'] = $this->manageupdatevendorm->editvendors($vendorid);
	$this->load->view("header");
	$this->load->view("vendoreditv",$data);
	$this->load->view("footer");	
	}
	
	function addvendor()
	{
	$error = FALSE;
	// $data = $this->manageupdatevendorm->editvendors($vendorid);
	if($this->input->post())
	{
	$vname = $this->input->post('vname');
	$vusername = $this->input->post('vusername');
	$vemail = $this->input->post('vemail');
	$vpassword = $this->input->post('vpassword');
	$vdetails = $this->input->post('vdetails');
	$vhostip = $this->input->post('vhostip');
	$vstatus = $this->input->post('vstatus');
	$vid = $this->manageupdatevendorm->getvendorlastid();
	if($vname == "")
	{
	$error = TRUE;
	$this->session->set_userdata('update',"Vendor name not null");
	}
	else
	{
	$vnames = $this->manageupdatevendorm->checkvendorname($vname);
	if($vnames)
	{
	$error = TRUE;
	$this->session->set_userdata('update',"Vendor name already exist");
	}
	}
	if($vusername == "")
	{
		$error = TRUE;
	$this->session->set_userdata('update',"Vendor username not null");
	}
	if($vemail == "")
	{
		$error = TRUE;
	$this->session->set_userdata('update',"Vendor email not null");
	}
	if($vpassword == "")
	{
		$error = TRUE;
	$this->session->set_userdata('update',"Vendor password not null"); 
	}
	if($vhostip == "")
	{
		$error = TRUE;
	$this->session->set_userdata('update',"Vendor Host IP not null"); 
	}
	if($error == FALSE)
	{
		$result = $this->manageupdatevendorm->addvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vid,$vpassword);
		if($result)
		{
		$this->session->set_userdata('update','Vendor List Updated');
		redirect(BASE_URL."/managevendor/viewvendors/");
		}
	}
	
	}
	$data['content'] = "";
	$this->load->view("header");
	$this->load->view("vendoraddv",$data);
	$this->load->view("footer");	
	}
	
	function vdbtemplate()
	{
	$error = FALSE;
	if($this->input->post())
	{
	$vendorid = $this->input->post('vname');
	$filepath = $this->input->post('filepath');
	if($vendorid == "")
	{
	$error = TRUE;
	$data['error'] = "Please select vendor id";	
	}
	$dup_result = FALSE;
	if($dup_result)
	{
	$error = TRUE;
	$this->session->set_userdata('update',"this vendor template already exist");
	}
	if($error)
	{
			redirect(BASE_URL.'/manageupdatevendor/vdbtemplate/');
	}
	else
	{
	// Upload Vendor File Starts
		$config['upload_path'] = UPLOADEDFILES_URL.'/vendorfiles/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '100000000000000000000';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_userdata('update',$this->upload->display_errors());
			redirect(BASE_URL.'/manageupdatevendor/vdbtemplate/');
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$filename = $data['file_name'];
			// send file to User processing folder also starts
			$this->manageupdatevendorm->sendfileprocessingtable($filename);
			// send files to user processing folder also ends
			// $result = $this->manageupdatevendorm->savevendor($filename,$vendorid);
			redirect(BASE_URL.'/manageupdatevendor/vdbtemplate/');
	}
	// Upload Vendor File Ends
	// copy file to new location starts
	//$url=$filepath;
	//$contents=file_get_contents($url);
	//$filename = rand(0,100000000000000000).".xls";
	//$save_path="uploadedfiles/vendorfiles/".$filename;
	//file_put_contents($save_path,$contents);
	// copy file to new location ends
		
	}
	}
	$data['dropdown'] = $this->manageupdatevendorm->listvendors();
	$data['content'] = $this->manageupdatevendorm->filequeue();
	$this->load->view("header");	
	$this->load->view('vendorupdateaddtemplatev',$data);
	$this->load->view("footer");	
	}
	 
	 function deltemplate()
	 {
		$vtid = $this->input->post('id');
		$result = $this->manageupdatevendorm->deletetemplate($vtid); 
		if($result)
		echo "0";
		else
		echo "1";
	 }
	 
	 function processupdatefile()
	 {
		$fileid = $this->uri->segment(3);
		$data['filename'] = $this->manageupdatevendorm->getfilename($fileid);
		// $data['vendortemplates'] = $this->manageupdatevendorm->getvendortemplates($vendorid);
		$data['dropdown'] = $this->manageupdatevendorm->listvendors();
		//$updatefilestatus = $this->magentoquantitym->updatefilerecord($fileid,$userid);
		// $data['filename'] = $run = $this->magentoquantitym->get_filename($fileid,$userid);
		$this->load->view('header');
		$this->load->view('processupdatemagentobyuserv',$data);
		$this->load->view('footer');
		 
	 }
	 
	 function getvendortemplates()
	 {
		$vendorid = $data['vendorid'] = $this->uri->segment(3);
		$fileid = $this->uri->segment(4);
		$data['filename'] = $this->manageupdatevendorm->getfilename($fileid);
		$data['templates'] = $this->manageupdatevendorm->getvendortemplates($vendorid);
		$this->load->view('viewalltemplates',$data);
	 }
	 
	 
	 
	 function apiaccess()
	 {
		 $fileid = $this->uri->segment(3);
		 $templateid = $this->uri->segment(4);
		 $vendorid = $this->uri->segment(5);
		 $data['vendorverified'] = $this->manageupdatevendorm->verifyvendor($vendorid);
		 $vendordata = $this->manageupdatevendorm->getvendordetails($vendorid);
		 $vendorfilename = $this->manageupdatevendorm->getrealfilename($fileid);
		 $vendortemplatedetails = $this->manageupdatevendorm->gettemplatefromid($templateid);
		 if($vendortemplatedetails)
		 {
		 $validateexcel = $this->manageupdatevendorm->matchexcelfields($vendorfilename,$vendortemplatedetails->template_excelstructure);
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
			 $result = $this->manageupdatevendorm->senddatatodb($vendorfilename,$vendortemplatedetails,$vendorid,$vendortemplatedetails->id);
			 echo "Processing DONE";
		 }
		 else
		 {
			 // file not okay
			$message = $vendorid." File is not valid";
			$this->load->library('email');
			$this->email->from('sandeepk@icurocao.com', 'Your Name');
			$this->email->to('sandeepk@icurocao.com');
			$this->email->cc('sandeep.kharay@gmail.com');
			$this->email->subject('Not Proper ');
			$this->email->message($message);
			$this->email->send();
			echo $this->email->print_debugger();
		 }
		 exit;
		 $this->load->view("apiv",$data);
	 }
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */