<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processfilebyuser extends CI_Controller {
	
	 
	 function __construct(){
        // Note that there are (2) underscores (_)
           parent::__construct();
		   $this->load->model('processfilebyuserm');
    }
	
	function index()
	{
	$fileid = $this->uri->segment(3);
	$userid = $this->session->userdata('user_id');
	$data['vendors'] = $this->processfilebyuserm->get_vendors();
	$data['filename'] = $this->processfilebyuserm->get_filename($fileid,$userid);
	$this->load->view('header');
	$this->load->view('processfilebyuserv',$data);
	$this->load->view('footer');	
	}
	 
	 function useraccessingapi()
	 {
		 $fileid = $this->input->get('fileid');
		 $vendorid = $this->input->get('vendorid');
		 $attributes=$this->input->get('attributes');
		 if(isset($attributes))
		 $attributes = $this->input->get('attributes');
		 else
		 $attributes = "";

		 $userid = $this->session->userdata('user_id');
		 // update file records start
		 $updatefilerecord = $this->processfilebyuserm->updatefilerecord($fileid,$userid);
		 // update file records ends
		 $data['vendorverified'] = $this->processfilebyuserm->verifyvendor($vendorid);
		 $vendorfilename = $this->processfilebyuserm->get_filename($fileid,$userid);
		 $vendortemplatedetails = $this->processfilebyuserm->getvendortemplate($vendorid);
		 if($vendortemplatedetails)
		 {
		 $validateexcel = $this->processfilebyuserm->matchexcelfields($vendorfilename->filename,$vendortemplatedetails->template_excelstructure);
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
			 $result = $this->processfilebyuserm->senddatatodb($vendorfilename->filename,$vendortemplatedetails,$vendorid,"$attributes");
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
	
	function updatedata()
	{
	$fileid = $this->uri->segment(3);
	$userid = $this->session->userdata('user_id');
	$data['vendors'] = $this->processfilebyuserm->get_vendors();
	$data['filename'] = $this->processfilebyuserm->get_filename($fileid,$userid);
	$this->load->view('header');
	$this->load->view('updatedatav',$data);
	$this->load->view('footer');	
	}
	 
	 function useraccessingupdatingapi()
	 {
		 $fileid = $this->input->get('fileid');
		 $vendorid = $this->input->get('vendorid');
		 $userid = $this->session->userdata('user_id');
		 // update file records start
		 $updatefilerecord = $this->processfilebyuserm->updatefilerecord($fileid,$userid);
		 // update file records ends
		 $data['vendorverified'] = $this->processfilebyuserm->verifyvendor($vendorid);
		 $vendorfilename = $this->processfilebyuserm->get_filename($fileid,$userid);
		 $vendortemplatedetails = $this->processfilebyuserm->getvendortemplate($vendorid);
		 $validateexcel = $this->processfilebyuserm->matchexcelupdatefields($vendorfilename->filename,$vendortemplatedetails->template_excelstructure);
		 
		 if($validateexcel == TRUE)
		 {
			 // everything okay file is okay
			 // echo "TRUE";
			 $result = $this->processfilebyuserm->updatedatatodb($vendorfilename->filename,$vendortemplatedetails,$vendorid);
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
			echo $this->email->print_debugger();
		 }
	 }
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */