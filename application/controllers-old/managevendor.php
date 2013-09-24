<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managevendor extends CI_Controller {

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
		   $this->load->model('managevendorm');
    }
	
	function index()
	{
	$data['content'] = $this->managevendorm->listvendors();
	$this->load->view("header");
	$this->load->view("managevendorv",$data);
	$this->load->view("footer");
	}
	
	function delvendors()
	{
	$vendorid = $this->uri->segment(3);
	if($this->input->post('delvee'))
	{
	$updatedelte = $this->managevendorm->deletevendor($vendorid);
	$this->session->set_userdata('update','Vendor Deleted');
	if($updatedelte)
	redirect(BASE_URL."/managevendor/viewvendors/");
	}
	$data['content'] = $this->managevendorm->editvendors($vendorid);
	$this->load->view("vendordeletev",$data);
	}
	
	function viewvendors()
	{
	$data['content'] = $this->managevendorm->listvendors();
	$this->load->view("header");
	$this->load->view("managevendorv",$data);
	$this->load->view("footer");	
	}
	
	function editvendors()
	{
	$vendorid = $this->uri->segment(3);
	$error = FALSE;
	// $data = $this->managevendorm->editvendors($vendorid);
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
		$result = $this->managevendorm->changepassword($password,$vendorid);
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
		$result = $this->managevendorm->editvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vendorid,$vpassword);
		if($result)
		{
		$this->session->set_userdata('update','Vendor Editing Done');
		redirect(BASE_URL."/managevendor/editvendors/".$vendorid);
		}
	}
	
	}
	$data['content'] = $this->managevendorm->editvendors($vendorid);
	$this->load->view("header");
	$this->load->view("vendoreditv",$data);
	$this->load->view("footer");	
	}
	
	function addvendor()
	{
	$error = FALSE;
	// $data = $this->managevendorm->editvendors($vendorid);
	if($this->input->post())
	{
	$vname = $this->input->post('vname');
	$vusername = $this->input->post('vusername');
	$vemail = $this->input->post('vemail');
	$vdetails = $this->input->post('vdetails');
	$vhostip = $this->input->post('vhostip');
	$vstatus = $this->input->post('vstatus');
	$vid = $this->input->post('vid');
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
	if($vid == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor id not null"; 
	}
	if($vhostip == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor Host IP not null"; 
	}
	if($vdetails == "")
	{
		$error = TRUE;
		$data['error'] = "Vendor details not null"; 
	}
	if($error == FALSE)
	{
		$result = $this->managevendorm->addvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vid);
		if($result)
		{
		$this->session->set_userdata('pnm','Editing DONE');
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
	$dup_result = $this->managevendorm->vendor_duplicate($vendorid);
	if($dup_result)
	{
	$this->session->set_userdata('update',"this vendor template already exist");
	}
	if($error)
	{
	}
	else
	{
	// Upload Vendor File Starts
	$config['upload_path'] = UPLOADEDFILES_URL.'/vendorfiles/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '100';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_userdata('update',$this->upload->display_errors());
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$filename = $data['file_name'];
			$result = $this->managevendorm->savevendor($filename,$vendorid);
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
	$data['dropdown'] = $this->managevendorm->listvendors();
	$data['content'] = $this->managevendorm->filequeue();
	$this->load->view("header");	
	$this->load->view('vendoraddtemplatev',$data);
	$this->load->view("footer");	
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */