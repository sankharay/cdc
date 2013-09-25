<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class addtempdata extends CI_Controller {

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
		   $this->load->model('adddatam');
    }
	
	function index()
	{
	exit;
	}
	
	function adddata()
	{
		echo $this->input->post('category');
		exit;
	if($this->input->post('category'))
	{
		$update = $this->adddatam->updatecontentdone();
		if($update)
		{
		// redirect(BASE_URL.'/contentsearch/pending/');
		exit;
		}
	}
	}
	
	function addname()
	{
	if($this->input->post('name'))
	{
	$result = $this->adddatam->addtempname($this->input->post('name'),$this->input->post('mptid'));
	}
	}
	
	function addshort()
	{
	if($this->input->post('short'))
	{
	$result = $this->adddatam->addtempshort($this->input->post('short'),$this->input->post('mptid'));
	}
	}
	
	function addtempdes()
	{
	if($this->input->post('des'))
	{
	$result = $this->adddatam->addtempdescription($this->input->post('des'),$this->input->post('mptid'));
	}
	}
	
	function addtemppspecs()
	{
	if($this->input->post('pspecs'))
	{
	$result = $this->adddatam->addtempspecification($this->input->post('pspecs'),$this->input->post('mptid'));
	}
	}
	
	function savetempvideo()
	{
	if($this->input->post('pvideo'))
	{
	$result = $this->adddatam->savetempvideo($this->input->post('pvideo'),$this->input->post('mptid'));
	}
	}
	
	function savetempsku()
	{
	if($this->input->post('psku'))
	{
	$result = $this->adddatam->savetempsku($this->input->post('psku'),$this->input->post('mptid'));
	}
	}
	
	function savetempcost()
	{
	if($this->input->post('pcost'))
	{
	$result = $this->adddatam->savetempcost($this->input->post('pcost'),$this->input->post('mptid'));
	}
	}
	
	function savetempretail()
	{
	if($this->input->post('pretail'))
	{
	$result = $this->adddatam->savetempretail($this->input->post('pretail'),$this->input->post('mptid'));
	}
	}
	
	function savetempsprice()
	{
	if($this->input->post('pspecialprice'))
	{
	$result = $this->adddatam->savetempsprice($this->input->post('pspecialprice'),$this->input->post('mptid'));
	}
	}
	
	function savetempspricefromdate()
	{
	if($this->input->post('pspecialdromdate'))
	{
	$result = $this->adddatam->savetempspricefromdate($this->input->post('pspecialdromdate'),$this->input->post('mptid'));
	}
	}
	
	function savetempspricetodate()
	{
	if($this->input->post('pspecialtodate'))
	{
	$result = $this->adddatam->savetempspricetodate($this->input->post('pspecialtodate'),$this->input->post('mptid'));
	}
	}
	
	function savetempmrsp()
	{
	if($this->input->post('pmsrp'))
	{
	$result = $this->adddatam->savetempmrsp($this->input->post('pmsrp'),$this->input->post('mptid'));
	}
	}
	
	function savetemppmap()
	{
	if($this->input->post('pmap'))
	{
	$result = $this->adddatam->savetemppmap($this->input->post('pmap'),$this->input->post('mptid'));
	}
	}
	
	function savetempshipping()
	{
	if($this->input->post('pshipping'))
	{
	$result = $this->adddatam->savetempshipping($this->input->post('pshipping'),$this->input->post('mptid'));
	}
	}
	
	function savetempinventry()
	{
	if($this->input->post('pinventory'))
	{
	$result = $this->adddatam->savetempinventry($this->input->post('pinventory'),$this->input->post('mptid'));
	}
	}
	
	function savetempheight()
	{
	if($this->input->post('pheight'))
	{
	$result = $this->adddatam->savetempheight($this->input->post('pheight'),$this->input->post('mptid'));
	}
	}
	
	function savetempwidth()
	{
	if($this->input->post('pwidth'))
	{
	$result = $this->adddatam->savetempwidth($this->input->post('pwidth'),$this->input->post('mptid'));
	}
	}
	
	function savetemplength()
	{
	if($this->input->post('plength'))
	{
	$result = $this->adddatam->savetemplength($this->input->post('plength'),$this->input->post('mptid'));
	}
	}
	
	function savetempweight()
	{
	if($this->input->post('pweight'))
	{
	$result = $this->adddatam->savetempweight($this->input->post('pweight'),$this->input->post('mptid'));
	}
	}
	
	function saveattributes()
	{
	if($this->input->post('attid'))
	{
	$result = $this->adddatam->saveattributes($this->input->post('mptid'),$this->input->post('attid'),$this->input->post('replacevalue'));
	}
	}
	
	function savetempbrand()
	{
	if($this->input->post('vbrand'))
	{
	$result = $this->adddatam->savetempbrand($this->input->post('mptid'),$this->input->post('vbrand'));
	}
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */