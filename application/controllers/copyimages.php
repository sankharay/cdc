<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class copyimages extends CI_Controller {

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
		    $this->load->model('copyimagesm');
			include(PLUGINS_URL.'/excelreader/reader.php');
			$this->load->library('image_lib');
			$process = 1;
    }
	 
	function index()
	{
		if($this->input->post())
		{
		$config['upload_path'] = UPLOADEDFILES_URL.'/useruploadfiles/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '10000000000';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_userdata('update',$this->upload->display_errors());
			redirect(BASE_URL.'/copyimages/index');
			exit;
		}
		else
		{
			$data = $upload_data = $this->upload->data();
			$uploaddata = array (
						'userid' => $this->session->userdata('user_id'),
						'filename' => $data['file_name'],
						'filefor' => '6',
						'status' => '1'
						);
			$this->db->insert('files_foraddproduct',$uploaddata);
			redirect(BASE_URL.'/copyimages/index');
			exit;
	}
			
		}
			$data['content'] = $this->copyimagesm->listfile($this->session->userdata('user_id'));
			$this->load->view('header');
			$this->load->view('copyimagesv',$data);
			$this->load->view('footer');
	}
	
	function copyfinalfilebyuser()
	{
	$fileid = $this->uri->segment(3);
	$userid = $this->session->userdata('user_id');
	$data['vendors'] = $this->copyimagesm->get_vendors();
	$data['filename'] = $run = $this->copyimagesm->get_filename($fileid,$userid);
	$this->load->view('header');
	$this->load->view('copyfinalfilebyuserv',$data);
	$this->load->view('footer');	
	}
	
	function getimages()
	{
	//echo $this->input->get('vendorid');
	//	echo $this->input->get('fileid');
	$filename = $this->copyimagesm->filedetails($this->input->get('fileid'));
	$vendordetails = $this->copyimagesm->vendordetails($this->input->get('vendorid'));
	$filelocation = UPLOADEDFILES_URL.'/useruploadfiles/'.$filename->filename;
	$excel = new Spreadsheet_Excel_Reader();
	$excel->read("$filelocation");
	$numrows = $excel->sheets[0]['numRows'];
	$numcolums = $excel->sheets[0]['numCols'];
	$this->load->library('ftp');
	$config['hostname'] = "$vendordetails->hostip";
	$config['username'] = "$vendordetails->username";
	$config['password'] = "$vendordetails->password";
	$config['port']     = "$vendordetails->portnumber";
	$config['passive']  = TRUE;
	$config['debug']	= TRUE;
	
	$this->ftp->connect($config);
	$list = $this->ftp->list_files("$vendordetails->filelocation");
	$images = array();
	
	if(isset($list))
	{
		for($i=2;$i<=$numrows;$i++){
			if(isset($excel->sheets[0]['cells'][$i][1]))
		   			$sku = trim($excel->sheets[0]['cells'][$i][1]);
		   			else
		   			$sku = "";
    	   			foreach($list as $imagename)
					{
					$dataarray = explode("$sku","$imagename");
					if(sizeof($dataarray) > 1)
					{
					$sourcepath="$vendordetails->filelocation/$imagename";
					$copypath = UPLOADEDFILES_URL."/images/".$imagename;
					$this->ftp->download($sourcepath, $copypath, 'auto');
					$images[]= BASE_URL."/uploadedfiles/images/".$imagename;
					}
					}
					$comma_separated = implode(",", $images);
					 unset($images);
				// END
				$data[] = array("Product SKU"=>$sku,"Image URL"=>$comma_separated);
							}
	
	$filename = "images.xls";
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
	$flag = false;
	  foreach($data as $row) {
	
		if(!$flag) {
		  // display field/column names as first row
		  echo implode("\t", array_keys($row)) . "\r\n";
		  $flag = true;
		}
	   // array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\r\n";
	  }
	
	
	exit;
	
	
	}
	else
	{
	echo "Folder Emplty";
	exit;
	}
		}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */