<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class uploadproductpics extends CI_Controller {

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
		   $this->load->model('uploadproductpicsm');
    }
	 
	function index()
	{
		
	}
	 
	function images()
	{
		$upc = $this->uri->segment(3);
		if($this->input->post('submit'))
		{
		echo "dfsdasdsa";
		$config['upload_path'] = PLUGINS_URL.'/cropping/images';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '100';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('home/upload', $error);
		}
		else
		{
			$data =  $this->upload->data();
			$this->uploadproductpicsm->imgupload($upc,$data['file_name']);
			$this->session->set_userdata('success',"Image Uploaded");
			redirect(BASE_URL.'/uploadproductpics/images/'.$upc);
		}
		}
		$this->load->view('uploadproductpicsv');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */