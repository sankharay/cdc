<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class updateapi extends CI_Controller {

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
           parent::__construct();
		   $this->load->model("updateapim");
    }
	 
	 function index()
	 {
		 $vendorid = $this->uri->segment(3);
		 $vendorverified = $this->updateapim->verifyvendor($vendorid);
		 if($vendorverified)
		 redirect(BASE_URL.'/updateapi/apiaccess/'.$vendorid);
	 }
	 
	 function apiaccess()
	 {
		 $vendorid = $this->uri->segment(3);
		 $data['vendorverified'] = $this->updateapim->verifyvendor($vendorid);
		 $vendordata = $this->updateapim->getvendordetails($vendorid);
		 $vendorfilename = $this->updateapim->ftpcopyfile($vendordata,$vendorid);
		 echo $vendorfilename;
		 $vendortemplatedetails = $this->updateapim->getvendortemplate($vendorid);
		 if($vendortemplatedetails)
		 {
		 $validateexcel = $this->updateapim->matchexcelfields($vendorfilename,$vendortemplatedetails->template_excelstructure);
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
			 $result = $this->updateapim->senddatatodb($vendorfilename,$vendortemplatedetails,$vendorid,$vendortemplatedetails->id);
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