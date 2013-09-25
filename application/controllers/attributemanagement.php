<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attributemanagement extends CI_Controller {

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
		   $this->load->model("attributemanagementm");
    }
	
	function index()
	{
		$data['content'] = $this->attributemanagementm->get_all_attributes();
		$this->load->view('header');
		$this->load->view('attributemanagementv',$data);
		$this->load->view('footer');
	}
	
	function addnewattributes()
	{
		if($this->input->post())
		{
		$data = array (
				'categoryid' =>$this->input->post('catid'),
				'attributename' =>$this->input->post('attname'),
				'section_scope' =>$this->input->post('attscope'),
				'status' =>$this->input->post('status')
						);
		$result = $this->attributemanagementm->add_attributes($data);
		if($result)
		redirect(BASE_URL.'/attributemanagement');
		}
		$data['categories'] = $this->attributemanagementm->list_categories();
		$this->load->view('addnewattributesv',$data);
	}
	
	function addnewattributestypes()
	{
		if($this->input->post())
		{
		$data = array (
				'attributeid' =>$this->input->post('parentattid'),
				'name' => htmlspecialchars($this->input->post('attpropertyname')),
				'status' =>$this->input->post('status')
						);
		$result = $this->attributemanagementm->add_subattributes($data);
		if($result)
		redirect(BASE_URL.'/attributemanagement');
		}
		$data['subattributes'] = $this->attributemanagementm->list_attributes();
		$this->load->view('addnewattributestypesv',$data);
	}
	
	function editsubtree()
	{
	$attt = $this->uri->segment(3);
	$data['attributes'] = $this->attributemanagementm->get_sub_attribute_names($attt);
	$this->load->view('editsubtreev',$data);
	}
	
	function deletesubtreeelement()
	{
	$attt = $this->uri->segment(3);
	$delelte_dub = $this->attributemanagementm->delete_sub($attt);
	echo "<script>alert('Atribute Value Deleted');</script>";
	}
	
	function commoncontent()
	{
		$data['categories'] = $this->attributemanagementm->list_categories();
		$data['content'] = $this->attributemanagementm->common_meta_content();
		$this->load->view('header');
		$this->load->view('commoncontentv',$data);
		$this->load->view('footer');
	}
	
	function addnewcommoncontent()
	{
		$idduplicate = $this->attributemanagementm->idduplicate($this->input->post('catid'));
		if($idduplicate)
		{
		$this->session->set_userdata('update',"<strong>Warning!</strong> <br>Content for selected category Already Exist");
		redirect(BASE_URL.'/attributemanagement/commoncontent/');
		}
		else
		{
		if($this->input->post())
		{
			$data = array (
					'categoryid' => $this->input->post('catid'),
					'metakeywords' => $this->input->post('metakeywords'),
					'metadescription' => $this->input->post('metadescription'),
					'spanish_metakeywords' => $this->input->post('spanishmetakeywords'),
					'spanish_metadescription' => $this->input->post('spanishmetadescription'),
					'status' => $this->input->post('status')
							);
		$metainsert = $this->attributemanagementm->insert_common_data($data);
		if($metainsert)
		{
		$this->session->set_userdata('update',"<strong>Congratulations</strong> <br>Content Added Successfully");
		redirect(BASE_URL.'/attributemanagement/commoncontent/');
		exit;
		}
		}
		}
		$data['categories'] = $this->attributemanagementm->list_categories();
		$this->load->view('addnewcommoncontentv',$data);
	}
	
	function editcommoncontent()
	{
		$contentid = $this->uri->segment(3);
		if($this->input->post())
		{
			$data = array (
					'categoryid' => $this->input->post('catid'),
					'metakeywords' => $this->input->post('metakeywords'),
					'metadescription' => $this->input->post('metadescription'),
					'spanish_metakeywords' => $this->input->post('spanishmetakeywords'),
					'spanish_metadescription' => $this->input->post('spanishmetadescription'),
					'status' => $this->input->post('status')
							);
		$metainsert = $this->attributemanagementm->update_common_data($data,$contentid);
		$this->session->set_userdata('update',"<strong>Congratulations</strong> <br>Content Edited Successfully");
		redirect(BASE_URL.'/attributemanagement/commoncontent/');
		exit;
		}
		$data['categories'] = $this->attributemanagementm->list_categories();
		$data['content'] = $this->attributemanagementm->get_common_content($contentid);
		$this->load->view('editcommoncontentv',$data);
	}
	 
	 function getattributes()
	 {
		$categoryid = $this->uri->segment(3);
		$data['main_attribut'] = $this->attributemanagementm->get_main_attributes($categoryid);
		$this->load->view('getattributesv',$data);
	 }
	 
	 function getmetainformation()
	 {
	 $categoryid = $this->uri->segment(3);
		$data['main_metainfo'] = $this->attributemanagementm->get_metainformationcat($categoryid);
		$this->load->view('getmetainformationv',$data);
	 }
	 
	 function editcategory($id)
	 {
		 $id = $this->uri->segment(3);
		 if($this->input->post('catid'))
		 {
			 $datae = $this->attributemanagementm->updatecat($id,$this->input->post('catid'));
			 redirect(BASE_URL.'/attributemanagement');
		 }
		$data['categories'] = $datas = $this->attributemanagementm->list_categories();
		$this->load->view('editcategoryv',$data);
	 }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */