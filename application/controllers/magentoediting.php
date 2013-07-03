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
		$fpl_id = $this->uri->segment(3);
		if($this->input->post())
		{
		$this->magentoeditingm->insert_attributes($fpl_id);
		}
		$data['content'] = $this->magentoeditingm->browse_english_product($fpl_id);
		$sppr_id = $this->magentoeditingm->get_spanish_id($fpl_id);
		$data['contents'] = $this->magentoeditingm->browse_spanish_product($sppr_id);
		$data['selected_category'] = $this->magentoeditingm->get_selected_categories($fpl_id);
		$data['branddropdown'] = $this->magentoeditingm->list_brands();
		$data['disclaimerdropdown'] = $this->magentoeditingm->list_disclaimers();
		$this->load->view('header');
		$this->load->view('mproducteditingv',$data);
		$this->load->view('footer');
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