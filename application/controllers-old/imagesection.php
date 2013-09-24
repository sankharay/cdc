<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imagesection extends CI_Controller {

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
		   $this->load->model("imagesectionm");
		   $this->load->library('image_lib');
    }
	
	function imgedit()
	{
		$imgid = $this->uri->segment(3);
		$fpl_id = $this->uri->segment(4);
		if($this->input->post())
		{
			$imgdata = array (
						'image_lanauage' =>$this->input->post('imagelang'),
						'image_position' =>	$this->input->post('imgposition')
							  );
			$editimg = $this->imagesectionm->editingimg($imgdata,$imgid);
			if($editimg)
			{
			$this->session->set_userdata('update',"<strong>Congratulations</strong>&nbsp;Editing Done Successfully");
			redirect(BASE_URL.'/imagesection/index/'.$fpl_id);
			}
			else
			{
			$this->session->set_userdata('update',"<strong>Opps!</strong>&nbsp;Editing Not Done Successfully");
			redirect(BASE_URL.'/imagesection/index/'.$fpl_id);
			}
		}
		$data['content'] = $this->imagesectionm->imagedetails($imgid);
		$this->load->view("imgeditv",$data);
	}
	 
	function getvendordata()
	{
	$fpl_id = $this->uri->segment(3);
	$product_sku = $this->uri->segment(4);
	$product_source = $this->uri->segment(5);
	$imagealreadycopied = $this->imagesectionm->checkimg($fpl_id);
	if(!$imagealreadycopied)
	$data['image_check'] = $this->imagesectionm->getimage_mastertable($fpl_id,$product_sku,$product_source);
	// redirect(BASE_URL."/imagesection/index/".$fpl_id);
	exit;
	}
	 
	function index()
	{
		$fpl_id = $this->uri->segment(3);
		$imgsku= $this->uri->segment(4);
		$imgsource=$this->uri->segment(5);
		$this->load->helper('form');
		if($this->input->post())
		{
		$config['upload_path'] = PLUGINS_URL.'/cropping/images/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '2024';
		$config['max_height']  = '2068';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
		$this->session->set_userdata('update',"$this->upload->display_errors()");
		}
		else
		{
			$imagedata = $this->upload->data();
			$filedetails = array (
		'finalproductlist_fpl_id' => $this->uri->segment(3),
		'image_lanauage' => $this->input->post('imagelang'),
		'image_position' => $this->input->post('imgposition'),
		'img_name' => $imagedata['file_name']
								  );
			$this->db->insert('product_images',$filedetails);
		// image resize start
		$resized_path = PLUGINS_URL.'/cropping/autoresizeimages/';
		$config = array(
		'source_image'      => PLUGINS_URL.'/cropping/images/'.$imagedata['file_name'],
		'new_image'         => $resized_path, //path to
		'maintain_ratio'    => true,
		'width'             => IMAGE_RESIZE_WIDTH,
		'height'            => IMAGE_RESIZE_HEIGHT
		);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$resized_path = PLUGINS_URL.'/cropping/images/'.$imagedata['file_name'];
		$this->imagesectionm->fitimage($resized_path);
		// image resize ends
		redirect(BASE_URL.'/imagesection/index/'.$fpl_id.'/'.$imgsku.'/'.$imgsource);
		exit;		
		}	
		}
		$data['content'] = $this->imagesectionm->get_product_images($fpl_id);
		$this->load->view("header");
		$this->load->view("imagesectionv",$data);
		$this->load->view("footer");
	}
	
	function deleteimg()
	{
	$imageid = $this->input->post('imgid');
	$this->imagesectionm->delimg($imageid);
	}
	
	function confirmproductready()
	{
	$fplid = $this->uri->segment(3);
	$result = $this->imagesectionm->confirmproductreadym($fplid);
	if($result == TRUE)
	redirect(BASE_URL.'/finaproducts');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */