<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class crud extends CI_Controller {
	 
	 function __construct(){
header('Access-Control-Allow-Origin: *');
		parent::__construct();
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		$this->load->library('grocery_CRUD');
		$this->load->model('addcontentm');
    }
	
	function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->where('status = 5 AND status != 13');
		$crud->columns('product_source','prduct_name','product_sku','product_brand','status');
		$crud->set_table('masterproducttable');

			$output = $crud->render();
		$this->load->view("header");
		$this->load->view('example',$output);
		$this->load->view("crud_footer");
	}
	
	function alldata()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->where('status != 13');
		$crud->columns('product_source','prduct_name','product_sku','product_brand','user_assign','product_cost','status');
		$crud->set_table('masterproducttable');

		$output = $crud->render();
		$this->load->view("header");
		$this->load->view('example',$output);
		$this->load->view("crud_footer");
	}
	
	function api()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$this->db->where('status',1);
		$crud->columns('product_source','prduct_name','product_sku','product_brand','user_assign','product_cost','status');
		$crud->set_table('api_masterproducttable');

		$output = $crud->render();
		$this->load->view("header");
		$this->load->view('example',$output);
		$this->load->view("crud_footer");
	}
	
	function yourdata()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$this->db->where('status',4);
		 $crud->unset_delete();
		 $crud->unset_edit();
		 $crud->unset_add();
		$crud->columns('product_source','prduct_name','product_sku','product_brand','user_assign','product_cost','status');
		$crud->set_table('api_masterproducttable');

		$output = $crud->render();
		$this->load->view("header");
		$this->load->view('exampleyourdata',$output);
		$this->load->view("crud_footer");
	}
	
	function apiinventry()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->field_type('status','dropdown',array('1' => 'Active', '2' => 'Already Processed'));
		$crud->set_table('api_inventry');

		$output = $crud->render();

		$this->load->view("header");
		$this->load->view('exampleinventry',$output);
		$this->load->view("crud_footer");
	}
	 
	
}