<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class addrelatedproducts extends CI_Controller {

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
		   $this->load->model('addrelatedproductsm');
    }
	
	function index()
	{
	$data['dropdown'] = $this->addrelatedproductsm->listcategories();
	$this->load->view('relatedproductsv',$data);
	}
	
	
	function products()
	{
	$catid = $this->uri->segment(3);
	$data['content'] = $this->addrelatedproductsm->get_allproducts($catid );
	$this->load->view('catmagproductsv',$data);
	}
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */