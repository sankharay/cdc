<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class addcontent extends CI_Controller {
	 
	 function __construct(){
        // Note that there are (2) underscores (_)
           parent::__construct();
		   $this->load->model('addcontentm');
		   $this->load->library('image_lib');
		require_once(PLUGINS_URL.'/apiClient.php');
		require_once(PLUGINS_URL.'/contrib/apiTranslateService.php');
		require_once(PLUGINS_URL.'/LanguageTranslator.php');
    }
	
	function index()
	{
	$activity = " Pending Content";
	$this->log->logdata($activity);
	$this->load->model("contentsearchm");
	$data['content'] = $this->addcontentm->pending_products();
	$this->load->view("header");
	$this->load->view("addcontentv",$data);
	$this->load->view("footer");
	}
	
	function desc()
	{
	$activity = " has initiated a product wizard";
	$this->log->logdata($activity);
	$productupc = $this->uri->segment(3);
	$productsource = $this->uri->segment(4);
	$this->session->set_userdata('productupc',$productupc);
	$this->session->set_userdata('productsource',$productsource);
	$this->log->check_upc_exist($productupc);
	$data['content'] = $this->addcontentm->productwiz($productupc,$productsource);
	$this->load->view('header');
	$this->load->view('descv',$data);
	$this->load->view('footer');
	}
	
	function addenglishready()
	{
	$activity = " convert product to spanish via google";
	$this->log->logdata($activity);
	$productupc = $this->uri->segment(3);
	$productsource = $this->uri->segment(4);
	$data['content'] = $this->addcontentm->addenglishready($productupc,$productsource);
	redirect(BASE_URL.'/addcontent');
	exit;
	}
	
	function addlistimageready()
	{
	$activity = " Visiting Image Section";
	$this->log->logdata($activity);
	$user_id = $this->session->userdata('user_id');
	$accesslevel = $this->session->userdata('accesslevel');
	$data['content'] = $this->addcontentm->get_imageready_product($accesslevel,$user_id);
	$this->load->view('header');
	$this->load->view('addlistimagereadyv',$data);
	$this->load->view('footer');
	}
	 
	function addimagesection()
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
		$this->addcontentm->fitimage($resized_path);
		// image resize ends
		redirect(BASE_URL.'/addcontent/addimagesection/'.$fpl_id.'/'.$imgsku.'/'.$imgsource);
		exit;		
		}	
		}
		$data['content'] = $this->addcontentm->get_product_images($fpl_id);
		$this->load->view("header");
		$this->load->view("addimagesectionv",$data);
		$this->load->view("footer");
	}
	
	function confirmproductothers()
	{
	$fplid = $this->uri->segment(3);
	$result = $this->addcontentm->confirmproductothersm($fplid);
	if($result == TRUE)
	redirect(BASE_URL.'/finaproducts');
	}
	
	function reviewcontent()
	{
		$data['contents'] = $this->addcontentm->reviewcontentsm();
		$data['content'] = $this->addcontentm->reviewcontentm();
		$data['allusers'] = $this->addcontentm->all_users();
		$this->load->view("header");
		$this->load->view("reviewcontentv",$data);
		$this->load->view("footer");
	}
	
	function viewproductothers()
	{
	$mpt_id=$this->uri->segment(3);
	$data['content'] = $this->addcontentm->getothersproduct($mpt_id);
	$this->load->view("viewotherproductv",$data);
	}
	
	function viewproductothersqa()
	{
	$mpt_id = $data['mpt_iid'] = $this->uri->segment(3);
	$data['content'] = $this->addcontentm->getothersproductqa($mpt_id);
	$fpl_id = $this->addcontentm->get_fpl_id($mpt_id);
	$data['images'] = $this->addcontentm->get_images($fpl_id);
	$this->load->view("viewotherproductqav",$data);
	}
	
	function qafailed()
	{
	$data['content'] = $this->addcontentm->getallqafailed();
	$mpt_id = $this->uri->segment(3);
	$this->load->view("qafailedv",$data);
	}
	
	function qafaileduser()
	{
	$data['content'] = $this->addcontentm->getallqafailed();
	$mpt_id = $this->uri->segment(3);
	$this->load->view("qafaileduserv",$data);
	}
	
	function reviewagain()
	{
	if($this->input->post())
	{
	$mptid = $this->input->post('mptid');
	$comment = $this->input->post('content');
	$values = $this->input->post('values');
	if($mptid!= "" AND $comment != "")
	{
	$result = $this->addcontentm->rejectdata($mptid,$comment,$values);
	$result = $this->addcontentm->notefaileddata($mptid,$comment);
	}
	else
	{
	return '0';
	}
	}
	}
	
	function reviewuseragain()
	{
	if($this->input->post())
	{
	$mptid = $this->input->post('mptid');
	$comment = $this->input->post('content');
	$values = $this->input->post('values');
	if($mptid!= "" AND $comment != "")
	{
	$result = $this->addcontentm->rejectdatabyuser($mptid,$comment,$values);
	$result = $this->addcontentm->notefaileddata($mptid,$comment);
	// activity recording start
	$activity = " rejecting Data and send back to user Section";
	$this->log->logdata($activity);
	// activity recording start
	}
	else
	{
	return '0';
	}
	}
	}
	
	function contentfailed()
	{
	$mptid = $this->uri->segment(3);
	if($this->input->post('pFplid'))
	{
	$this->addcontentm->editenglishready();
	redirect(BASE_URL.'/addcontent/addlistimageready/');
	exit;
	}
	$data['content'] = $this->addcontentm->getothersproductqa($mptid);
	$this->load->view("header");
	$this->load->view("contentfailedv",$data);
	$this->load->view("footer");
	}
	
	function processassign()
	{
	$activity = " Product Processed After Review assign to USA Team";
	$this->log->logdata($activity);
	$content = $this->addcontentm->processproducts();
	echo $content;
	}
	
	function addreviewspanish()
	{
	$mptid = $this->uri->segment(3);
	$data['disclaimer']= $this->addcontentm->get_disclaimer();
	$data['branddropdown'] = $this->addcontentm->get_brand_dropdown();
	$data['master_content'] = $this->addcontentm->getothersproduct($mptid);
	$data['english_content'] = $this->addcontentm->getothersproductqa($mptid);
	$data['spanish_content'] = $this->addcontentm->getothersproductspqa($mptid);
	$this->load->view("header");
	$this->load->view("addreviewspanishv",$data);
	$this->load->view("footer");
	}
	
	function onlyenglishready()
	{
	if($this->input->post('category'))
	{
		$update = $this->addcontentm->updatecontentdone();
		if($update)
		{
		redirect(BASE_URL.'/contentsearch/pending/');
		exit;
		}
	}
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
			$editimg = $this->addcontentm->editingimg($imgdata,$imgid);
			if($editimg)
			{
			$this->session->set_userdata('update',"<strong>Congratulations</strong>&nbsp;Editing Done Successfully");
			redirect(BASE_URL.'/addcontent/addimagesection/'.$fpl_id);
			}
			else
			{
			$this->session->set_userdata('update',"<strong>Opps!</strong>&nbsp;Editing Not Done Successfully");
			redirect(BASE_URL.'/addcontent/addimagesection/'.$fpl_id);
			}
		}
		$data['content'] = $this->addcontentm->imagedetails($imgid);
		$this->load->view("imgeditvv",$data);
	}
	 
	
}