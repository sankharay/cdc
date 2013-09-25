<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class apiassigndata extends CI_Controller {
	 
	 function __construct()
	 {
		parent::__construct();
		$this->load->model('apiassigndatam');
     }
	
	function processassign()
	{
	$activity = " Product Processed After Review assign to USA Team";
	$this->log->logdata($activity);
	$content = $this->apiassigndatam->processproducts();
	echo $content;
	}
	
	function processassignthird()
	{
	$activity = " Product Processed After Review assign to USA Team";
	$this->log->logdata($activity);
	$content = $this->apiassigndatam->processassignthird();
	echo $content;
	}
	 
	
}