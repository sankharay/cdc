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
		if(isset($_POST['pDisclaimer']))
		$disclaimer = $_POST['pDisclaimer'];
		else
		$disclaimer = "";
		$spdata = array(
			'prduct_name'=>htmlspecialchars($_POST['pName'],ENT_QUOTES),
			'product_description'=>htmlspecialchars($_POST['spDesc'],ENT_QUOTES),
			'short_description'=>htmlspecialchars($_POST['spFeature'],ENT_QUOTES),
			'product_specs'=>htmlspecialchars($_POST['pSpecs'],ENT_QUOTES),
			'product_disclaimer'=>htmlspecialchars($disclaimer,ENT_QUOTES),
			'spanish_video'=>htmlspecialchars($_POST['psVideo'],ENT_QUOTES),
			'inmagento'=>3,
			'status'=>'1'
					);
			
		$this->db->where('sppr_id', $_POST['sppr_id']);
		$spanishupdated = $this->db->update('spenishdata', $spdata);
		$somethngupdated = $this->db->affected_rows();
		// echo $this->db->last_query();
		if($somethngupdated == TRUE){
			$msg = 1;
		
		}else{
			$msg = 0;
		}
		echo $msg;
		
	}	
	
	
	function engsave(){
		if(isset($_POST['pDisclaimer']))
		$disclaimer = $_POST['pDisclaimer'];
		else
		$disclaimer = "";
		$data = array(
				'prduct_name'=>htmlspecialchars($_POST['pName'],ENT_QUOTES),
				'product_description'=>htmlspecialchars($_POST['pDesc'],ENT_QUOTES),
				'short_description'=>htmlspecialchars($_POST['pFeature'],ENT_QUOTES),
				'product_specs'=>htmlspecialchars($_POST['pSpecs'],ENT_QUOTES),
				'product_disclaimer'=>htmlspecialchars($disclaimer,ENT_QUOTES),
				'eng_video'=>htmlspecialchars($_POST['pVideo'],ENT_QUOTES),
				'inmagento'=>3,
				'status'=>'1'
					);
		$this->db->where('fpl_id', $_POST['fpt_id']);
		$dataupdated = $this->db->update('finalproductlist', $data);
		// echo $this->db->last_query();
		$somethngupdateds = $this->db->affected_rows();
		if($somethngupdateds){
			
			$data = array(
						'status'=>'1'
					);
					
		$this->db->where('sppr_id', $_POST['sppr_id']);
		$this->db->update('spenishdata', $data);
			
			$msg = 1;
		
		}else{
			$msg = 0;
		}
		echo $msg;
		
	}	
	
	function spanishfinalsave(){
		if(isset($_POST['pDisclaimer']))
		$disclaimer = $_POST['pDisclaimer'];
		else
		$disclaimer = "";
		$data = array(
			'prduct_name'=>htmlspecialchars($_POST['pName'],ENT_QUOTES),
			'product_description'=>htmlspecialchars($_POST['spDesc'],ENT_QUOTES),
			'short_description'=>htmlspecialchars($_POST['spFeature'],ENT_QUOTES),
			'product_specs'=>htmlspecialchars($_POST['pSpecs'],ENT_QUOTES),
			'product_disclaimer'=>htmlspecialchars($disclaimer,ENT_QUOTES),
			'spanish_video'=>htmlspecialchars($_POST['psVideo'],ENT_QUOTES),
			'inmagento'=>3,
			'status'=>'1'
					);
					
		$this->db->where('sppr_id', $_POST['sppr_id']);
		$spanishupdated = $this->db->update('spenishdata', $data);
		// echo $this->db->last_query();
		$spanishidd = $_POST['sppr_id'];
		if($spanishupdated)
		$masterspanid = $this->update_upc_id_content($spanishidd);
		if($masterspanid){
			$msg = 1;
		
		}else{
			$msg = 0;
		}
		echo $msg;
		
	}


	

	function update_upc_id_content($spanishidd)
	{
		
		$data = array(
		   'status' => '8'
		);
		$this->db->where('sppr_id', $spanishidd);
		$this->db->update('masterproducttable', $data);
		return true;
	}	
	 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */