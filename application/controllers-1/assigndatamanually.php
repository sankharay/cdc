<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class assigndatamanually extends CI_Controller {

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
		   $this->load->model('assigndatamanuallym');
    }
	
	function index()
	{
		$userid = $this->input->get('userid');
		$pName = $this->input->get('pName');
		$pSku = $this->input->get('pSku');
		$pUpc = $this->input->get('pUpc');
		$pSource = $this->input->get('pSource');
		$check_sku = $this->assigndatamanuallym->check_sku($pSku);
		if($pUpc != "")
		{
		$check_upc = $this->assigndatamanuallym->check_upc($pUpc);
		$check_upc == TRUE;
		}
		else
		{
		$check_upc = FALSE;
		$pUpc = "";
		}
		if($check_sku == TRUE OR $check_upc == TRUE )
		{
		echo "Product SKU or UPC already in USE";	
		}
		else
		{
			$data = array (
					'prduct_name'=>$pName,
					'product_sku'=>$pSku,
					'product_upc'=> $pUpc,
					'user_assign'=>$userid,
					'product_source'=>$pSource,
					'comment'=>1,
					'status'=> 2
							);
			$this->assigndatamanuallym->assign_to_user($data);
			$insertid = $this->db->insert_id();
			if($insertid)
			echo "Product Inserted Successfully";
			else
			echo "Problem in Product insert please try laster";
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */