<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class savefinaldata extends CI_Controller {

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
    }	
	
	function spanishsave(){
	
		$data = array(
			'prduct_name'=>htmlspecialchars($_POST['pName'],ENT_QUOTES),
			'product_description'=>htmlspecialchars($_POST['pDesc'],ENT_QUOTES),
			'short_description'=>htmlspecialchars($_POST['pFeature'],ENT_QUOTES),
			'product_specs'=>htmlspecialchars($_POST['pSpecs'],ENT_QUOTES),
			'inmagento'=>3,
			'status'=>'1'
					);
					
		$this->db->where('sppr_id', $_POST['sppr_id']);
		$spanishupdated = $this->db->update('spenishdata', $data);
		if($spanishupdated){
			$msg = 1;
		
		}else{
			$msg = 0;
		}
		echo "DONE";
		return $msg;
		
	}	
	
	
	function engsave(){
	
		$data = array(
				'prduct_name'=>htmlspecialchars($_POST['pName'],ENT_QUOTES),
				'product_description'=>htmlspecialchars($_POST['pDesc'],ENT_QUOTES),
				'short_description'=>htmlspecialchars($_POST['pFeature'],ENT_QUOTES),
				'product_specs'=>htmlspecialchars($_POST['pSpecs'],ENT_QUOTES),
				'inmagento'=>3,
				'status'=>'1'
					);
		$this->db->where('fpl_id', $_POST['fpt_id']);
		$dataupdated = $this->db->update('finalproductlist', $data);
		if($dataupdated){
			
			$data = array(
						'status'=>'1'
					);
					
		$this->db->where('sppr_id', $_POST['sppr_id']);
		$this->db->update('spenishdata', $data);
			
			$msg = 1;
		
		}else{
			$msg = 0;
		}
		echo "DONE";
	
		return $msg;
		
	}	
	
	function spanishfinalsave(){
	
		$data = array(
			'prduct_name'=>htmlspecialchars($_POST['pName'],ENT_QUOTES),
			'product_description'=>htmlspecialchars($_POST['pDesc'],ENT_QUOTES),
			'short_description'=>htmlspecialchars($_POST['pFeature'],ENT_QUOTES),
			'product_specs'=>htmlspecialchars($_POST['pSpecs'],ENT_QUOTES),
			'inmagento'=>3,
			'status'=>'1'
					);
					
		$this->db->where('sppr_id', $_POST['sppr_id']);
		$spanishupdated = $this->db->update('spenishdata', $data);
		echo $this->db->last_query();
		exit;
		if($spanishupdated){
			$msg = 1;
		
		}else{
			$msg = 0;
		}
	
		return $msg;
		
	}	
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */