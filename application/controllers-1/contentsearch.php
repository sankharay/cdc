<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contentsearch extends CI_Controller {
	 
	 function __construct(){
        // Note that there are (2) underscores (_)
           parent::__construct();  // Should always be the first thing you call.
			$this->load->model("log");
		require_once(PLUGINS_URL.'/apiClient.php');
		require_once(PLUGINS_URL.'/contrib/apiTranslateService.php');
		require_once(PLUGINS_URL.'/LanguageTranslator.php');
    }
	 
	function index()
	{
	$activity = " Checking Raw Data";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['allusers'] = $this->contentsearchm->all_users();
	$data['content'] = $this->contentsearchm->search_products_raw();
	$this->load->view("header");
	$this->load->view("contentsearchv",$data);
	$this->load->view("footer");
	}
	 
	function allcontent()
	{
	$activity = " Checking All Data";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['allusers'] = $this->contentsearchm->all_users();
	$data['content'] = $this->contentsearchm->search_products();
	$this->load->view("header");
	$this->load->view("allcontentv",$data);
	$this->load->view("footer");
	}
	
	function viewproduct($id)
	{
	$this->load->model("contentsearchm");
	$data['content'] = $this->contentsearchm->getproduct($id);
	$this->load->view("viewproductv",$data);
	}
	
	function process()
	{
	$activity = " Search Activity";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$content = $this->contentsearchm->processproducts();
	echo $content;
	}
	
	function processing()
	{
	$activity = " Search Activity";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$content = $this->contentsearchm->processproductss();
	echo $content;
	}
	
	function pending()
	{
	$activity = " Pending Content";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['content'] = $this->contentsearchm->pending_products();
	$this->load->view("header");
	$this->load->view("pendingproductsv",$data);
	$this->load->view("footer");
	}
	
	function productwiz()
	{
	$activity = " has initiated a product wizard";
	$this->log->logdata($activity);
	$productsku = $this->uri->segment(3);
	$productsource = $this->uri->segment(4);
	$this->session->set_userdata('productupc',$productsku);
	$this->session->set_userdata('productsource',$productsource);
	$this->log->check_sku_exist($productsku);
	$this->load->model("contentsearchm");
	$data['categories'] = $this->contentsearchm->get_categories();
	$data['content'] = $this->contentsearchm->productwiz($productsku,$productsource);
	$this->load->view("header");
	$this->load->view("productwizv",$data);
	$this->load->view("footer");
	}
	
	function englishreadycontent()
	{
	$activity = " has Check English Ready Content";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['content'] = $this->contentsearchm->englishreadycontentm();
	$this->load->view("header");
	$this->load->view("englishreadycontentv",$data);
	$this->load->view("footer");
	}
	
	function productwizdata()
	{
	$activity = " has checking a product wizard data";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['content'] = $this->contentsearchm->search_products_wiz();
	$this->load->view("header");
	$this->load->view("productwizdatav",$data);
	$this->load->view("footer");
	}
	
	function finalproduct()
	{
	$activity = " has initiated a Final Product wizard";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$productupc = $this->uri->segment(3);
	$productsource = $this->uri->segment(4);
	$datas['branddropdown'] = $this->contentsearchm->get_brand_dropdown();
	$datas['disclaimerdropdown'] = $this->contentsearchm->get_disclaimer_dropdown();
	$datas['productdetails'] = $this->contentsearchm->get_product_detail($productupc,$productsource);
	$this->load->view("header");
	$this->load->view("finalproductv",$datas);
	$this->load->view("footer");
	}
	
	function englishready()
	{
	$this->load->model("google");
	$activity = " has initiated a Final Product wizard - english ready";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	if($this->input->post())
	{
	$msg = $this->contentsearchm->englishready();
	$content = $this->contentsearchm->pending_transition_products();
	$data['content'] = $content;
	$data['msg'] = $msg;
	redirect(BASE_URL.'/contentsearch/englishreadycontent/');
	exit;
	}
	else
	{
	$user_id = $this->session->userdata('user_id');
	$accesslevel = $this->session->userdata('accesslevel');
	$data['content'] = $this->contentsearchm->englshreadycontentshow($accesslevel,$user_id);
	}
	$this->load->view("header");
	$this->load->view("englishreadyv",$data);
	$this->load->view("footer");
		
	}
	
	function reviewspanish()
	{
	$activity = " is reviewing Spanish Data";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['disclaimer']= $this->contentsearchm->get_disclaimer();
	$data['sku'] = $this->uri->segment(3);
	$this->load->view("header");
	$this->load->view("reviewspanishv",$data);
	$this->load->view("footer");
	}
	
	function finalproductinqueue()
	{
	$activity = " Going to Upload Images";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$user_id = $this->session->userdata('user_id');
	$accesslevel = $this->session->userdata('accesslevel');
	$data['content'] = $this->contentsearchm->englshreadycontentshow($accesslevel,$user_id);
	$this->load->view("header");
	$this->load->view("englishready_image_ready_v",$data);
	$this->load->view("footer");
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */