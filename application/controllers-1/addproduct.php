<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addproduct extends CI_Controller {

	 function __construct(){
        parent::__construct(); 
		$this->load->model('log');
		$this->load->model('addproductm');
    }
	 
	public function index()
	{
			$data['content'] = $this->addproductm->listfile($this->session->userdata('user_id'));
			$this->load->view('header');
			$this->load->view('addproductv',$data);
			$this->load->view('footer');
	}
	 
	 function uploadfile()
	{
		if($this->input->post())
		{
		$config['upload_path'] = UPLOADEDFILES_URL.'/useruploadfiles/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '100';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_userdata('update',$this->upload->display_errors());
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$uploaddata = array (
						'userid' => $this->session->userdata('user_id'),
						'filename' => $data['file_name'],
						'status' => '1'
						);
			$this->db->insert('files_foraddproduct',$uploaddata);
	}
			
		}$data['content'] = $this->addproductm->listfile($this->session->userdata('user_id'));
			
			$this->load->view('header');
			$this->load->view('addproductv',$data);
			$this->load->view('footer');
	}
	
	function manualaddproduct()
	{
	$sql2 = "SELECT * FROM `masterproducttable` WHERE `product_sku` = '".$_POST['psku']."' and `product_source` = '".$_POST['pSource']."'";
	 
	 $result = mysql_query($sql2);
	 
	 $num = mysql_num_rows($result);
	 
	 $sql1 = "SELECT * FROM `deletedproducts` WHERE `sku` = '".$_POST['psku']."' and `vendor` = '".$_POST['pVendor']."'";
	 
	 $result1 = mysql_query($sql1);
	 $num1 = mysql_num_rows($result1);
		 if($num == 0 && $num1 ==0){ 
	echo $sql = "INSERT INTO `masterproducttable` (`prduct_name`, `product_description`, `product_sku`, `product_upc`, `product_msrp`, `product_map`, `product_brand`, `product_features`, `product_source`, `product_specs`, `product_metatags`) VALUES ('".htmlspecialchars($_POST['pname'],ENT_QUOTES)."', '".htmlspecialchars($_POST['pDesc'],ENT_QUOTES)."', '".$_POST['psku']."', '".$_POST['pupc']."', '".$_POST['pmsrp']."', '".$_POST['pmap']."', '".$_POST['pbrand']."', '".htmlspecialchars($_POST['pFeature'],ENT_QUOTES)."','".$_POST['pSource']."', '".htmlspecialchars($_POST['pSpecs'],ENT_QUOTES)."', '".$_POST['pMetatags']."')";
	if(mysql_query($sql)){
		echo 1;
	}else{
		echo 0;	
	}
			 }
	}
	
}

?>