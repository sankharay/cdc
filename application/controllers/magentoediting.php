<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class magentoediting extends CI_Controller {

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
		   $this->load->model('magentoeditingm');
    }
	
	function index()
	{
		$data['content'] = $this->magentoeditingm->magentoeditinglist();
		$this->load->view('header');
		$this->load->view('magentoeditingv',$data);
		$this->load->view('footer');
	}
	
	function mproductlisting()
	{
	$this->load->model('addcontentm');
	$fplid = $this->uri->segment(3);
	$data['disclaimer']= $this->addcontentm->get_disclaimer();
	$data['branddropdown'] = $this->addcontentm->get_brand_dropdown();
	$data['english_content'] = $this->magentoeditingm->getothersenglishproductsqa($fplid);
	$data['spanish_content'] = $this->magentoeditingm->getotherspanishproductspqa($fplid);
	$this->load->view("header");
	$this->load->view("mproductlistingv",$data);
	$this->load->view("footer");
	}
	
	function editrpdoducttosend()
	{
	$fpl_id = $this->input->post('fpl_id');	
	if($fpl_id != "")
	{
	$data = array (
		'prduct_name' => $this->input->post('pName'),
		'short_description' => $this->input->post('finalpsdesc'),
		'product_description' => $this->input->post('pDesc'),
		'product_specs' => $this->input->post('pSpecs'),
		'product_cost' => $this->input->post('pcost'),
		'product_msrp' => $this->input->post('pmsrp'),
		'isset' => $this->input->post('pisset'),
		'onlineonly' => $this->input->post('ponlineonly'),
		'height' => $this->input->post('pHeight'),
		'width' => $this->input->post('pWidth'),
		'length' => $this->input->post('pLength'),
		'weight' => $this->input->post('pWeight'),
		'product_brand' => $this->input->post('pBrand'),
		'product_disclaimer' => $this->input->post('pDisclaimer'),
		'product_metatags' => $this->input->post('pkeywords'),
		'product_metadescription' => $this->input->post('pkeyworddescription')	
	);
		$update = $this->magentoeditingm->update_english($data,$fpl_id);
		if($update == 1 )
		echo "Data Updated";
		else
		echo "Data Not Updated";
	}
	}
	
	function editorspanishtosend()
	{
	$sppr_id = $this->input->post('sppr_id');	
	if($sppr_id != "")
	{
	$data = array (
		'prduct_name' => $this->input->post('pName'),
		'short_description' => $this->input->post('finalpsdesc'),
		'product_description' => $this->input->post('pDesc'),
		'product_specs' => $this->input->post('pSpecs'),
		'product_disclaimer' => $this->input->post('pDisclaimer'),
		'product_metatags' => $this->input->post('pkeywords'),
		'product_metadescription' => $this->input->post('pkeyworddescription')	
	);	
	$update = $this->magentoeditingm->update_spanish($data,$sppr_id);
	if($update == 1 )
	echo "Data Updated";
	else
	echo "Data Not Updated";
	}
	}
	
	
	function onlyenglishready()
	{
	if($this->input->post('category'))
	{
		$update = $this->magentoeditingm->updatecontentdone();
		if($update)
		{
		redirect(BASE_URL.'/contentsearch/pending/');
		exit;
		}
	}
	}
	
	function updateaddons()
	{
	$fpl_id = $this->input->post('fpl_id');	
	if($fpl_id != "")
	{
	$valuess = $this->input->post('values');
	$update = $this->magentoeditingm->update_addons_categories($valuess,$fpl_id);
	}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */