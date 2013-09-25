<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendorupdateprocessor extends CI_Controller {

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
		   $this->load->model('vendorupdateprocessorm');
    }
	 
	function index()
	{
		$filename = $this->input->get("file");
		$vendorid = $this->input->get("vendorid");
		if($this->input->post())
		{
			$skipid = $this->input->post("skip");
			$dbfieldess="";
			$excelfieldess="";
			$dbfieldes = $this->input->post('fieldsdata');
			$excelfieldes = $this->input->post('cells');
			$numcol = sizeof($dbfieldes);
			for($i=0;$i<$numcol;$i++)
			{
			if(in_array($i,$skipid))
			{
			}
			else
			{
			$dbfieldess.=$dbfieldes[$i].",";
			$excelfieldess.=$excelfieldes[$i].",";
			}
			}
			$updatefile = $this->vendorupdateprocessorm->addnewtemplate($dbfieldess,$excelfieldess,$vendorid);
		}
		$data['header'] = $this->vendorupdateprocessorm->getheader($filename);
		$data['numcolumns'] = $this->vendorupdateprocessorm->numcolumns($filename);
		$data['numrows'] = $this->vendorupdateprocessorm->numrows($filename);
		$data['fields'] = $this->vendorupdateprocessorm->listfields();
		$this->load->view('vendortemplateprocessorv',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */