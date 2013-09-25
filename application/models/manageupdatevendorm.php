<?php
class manageupdatevendorm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/excelreader/reader.php');
		$this->load->library('image_lib');
		$process = 1;
    }
	
	function vendorstatus($id)
	{
	if($id == 1 )
	{
	$status = "<span class='label label-success'>Active</span>";
	return $status;
	}
	else
	{
	$status = "<span class='label label-important'>Pending</span>";
	return $status;
	}
	}
	
	function vendor_duplicate($vendorid)
	{
     $this->db->select("id");
     $this->db->where("vendor_id",$vendorid);
     $this->db->from("vendortemplate");
	 $result = $this->db->get();
	 if($result->num_rows() > 0 )
	 return TRUE;
	 else
	 return FALSE;
	}
	
	function deletevendor($id)
	{
	$data = array (
				'status' => 3
					);
	$this->db->where('vmID',$id);
	$this->db->update('vendormanagement',$data);
	return TRUE;
	}
	
    function listvendors()
    {
     $this->db->select("*");
     $this->db->where("status != ",3);
     $this->db->from("vendormanagement");
	 $query = $this->db->get();
	 if($query->num_rows())
	 {
		return $query->result(); 
	 }
	 else
	 {
		 return FALSE;
	 }
	}
	
	function editvendors($id)
	{
     $this->db->select("*");
     $this->db->from("vendormanagement");
     $this->db->where("vmID",$id);
     $this->db->limit("1");
	 $query = $this->db->get();
	 if($query->num_rows())
	 {
		return $query->row();
	 }
	 else
	 {
		 return FALSE;
	 }
	}
	
	function vendorexist($id)
	{
		
     $this->db->select("*");
     $this->db->from("vendormanagement");
     $this->db->where("vmID",$id);
     $this->db->limit("1");
	 $query = $this->db->get();
	 if($query->num_rows())
	 {
		return TRUE;
	 }
	 else
	 {
		redirect(BASE_URL."/unauthorized");
		exit;
	 }
	}
	
	function changepassword($password,$vendorid)
	{
	$data = array(
               'password' => md5($password)
            );
		$this->db->update('vendormanagement',$data);
		$this->db->where('vmID',$vendorid);
		return TRUE;
	}
	
function editvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vendorid,$vpassword)
	{
	$data = array(
               'vendorName' => $vname,
               'username' => $vusername,
               'password' => $vpassword,
               'vendoremail' => $vemail,
               'vendorextradetails' => $vdetails,
               'hostip' => $vhostip,
               'status' => $vstatus
            );
		$this->db->where('vmID',$vendorid);
		$this->db->update('vendormanagement',$data);
		return TRUE;
	}
	
function addvendor($vname,$vusername,$vemail,$vdetails,$vhostip,$vstatus,$vid,$vpassword)
	{
	$data = array(
               'vendorName' => $vname,
               'username' => $vusername,
               'password' => $vpassword,
               'vendoremail' => $vemail,
               'vendorID' => $vid,
               'vendorextradetails' => $vdetails,
               'hostip' => $vhostip,
               'status' => $vstatus
            );
		print_r($data);
		$this->db->insert('vendormanagement',$data);
		return TRUE;
	}
	
	function savevendor($filename,$vendorid)
	{
	$data = array(
               'vendor_id' => $vendorid,
               'filename' => $filename,
               'status' => '1'
            );
	$this->db->insert('update_vendortemplate',$data);
	return TRUE;
	}
	
	function filequeue()
	{
	$userid = $this->session->userdata("user_id");
	$this->db->select("*");
	$this->db->from("files_foraddproduct");
	$this->db->where("userid",$userid);
	$this->db->where("status","1");
	$this->db->order_by("dateandtime","DESC");
	$result = $this->db->get();
	if($result->num_rows())
	{
		return $result->result();
	}
	else
	{
		return FALSE;
	}
	}
	
	function templatestatus($id)
	{
		$status = array(
					'1'=>'Pending Processing',
					'2'=>'Processing Done',
					'3'=>'File Deleted'
				);
		return $status[$id];
	}
	
	function vendoridtoname($id)
	{
	$this->db->select("*");
	$this->db->where("vmID",$id);
	$this->db->from("vendormanagement");
	$this->db->limit("1");
	$result  = $this->db->get();
	return $result->row();
	}
	
	function getvendorlastid()
	{
		$query = $this->db->query('SELECT max(vmID) as id FROM vendormanagement');
		$id = $query->row();
		return (($id->id)+1).rand(0,1000);
	}
	
	function checkvendorname($vname)
	{
	$this->db->select("*");
	$this->db->where("vendorName",$vname);
	$this->db->where("status",1);
	$this->db->from("vendormanagement");
	$result  = $this->db->get();
	if($result->row())
	return TRUE;
	else
	return FALSE;
	}
	
	function deletetemplate($id)
	{
	$this->db->where('id',$id);
	$this->db->delete('vendortemplate');
	if($this->db->affected_rows() > 0)
	return TRUE;
	else
	return FALSE;	
	}
	
	function sendfileprocessingtable($filename)
	{
	$source_file_path = UPLOADEDFILES_URL.'/vendorfiles/'.$filename;
	$target_file_path = UPLOADEDFILES_URL.'/useruploadfiles/'.$filename;
	$contents=copy($source_file_path, $target_file_path);
	$data = array (
		'userid' => $this->session->userdata('user_id'),
		'filename' => $filename,
		'filefor' => 3,
		'status' => 1
					);
	$this->db->insert('files_foraddproduct',$data);
	return $this->db->insert_id();
	}
	
	function getfilename($fileid)
	{
	$this->db->select('*');
	$this->db->where('id',$fileid);
	$this->db->where('filefor','3');
	$this->db->from('files_foraddproduct');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->row();
	else
	return FALSE;
	}
	
	function getrealfilename($fileid)
	{
	$this->db->select('*');
	$this->db->where('id',$fileid);
	$this->db->where('filefor','3');
	$this->db->from('files_foraddproduct');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->row()->filename;
	else
	return FALSE;
	}
	
	function getvendortemplates($vendorid)
	{
	$this->db->select('*');
	$this->db->where('vendor_id',$vendorid);
	$this->db->from('update_vendortemplate');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	return $data->result();
	else
	return FALSE;
	}
	
	
    function verifyvendor($vendorid)
    {
        $this->db->select("*");
		$this->db->where("vmID",$vendorid);
		$this->db->where("status",1);
        $this->db->from("vendormanagement");
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
			return TRUE;
		}
		else
		{
		redirect(BASE_URL."/unauthorized");
		exit;
		}
	}
	
	function getvendordetails($vid)
	{
        $this->db->select("*");
		$this->db->where("vmID",$vid);
        $this->db->from("vendormanagement");
		$data = $this->db->get();
		return $data->row();
	}
	
	function getvendortemplate($vid)
	{
        $this->db->select("*");
		$this->db->where("vendor_id",$vid);
        $this->db->from("update_vendortemplate");
		$data = $this->db->get();
		return $data->row();
	}
	
	function gettemplatefromid($id)
	{
        $this->db->select("*");
		$this->db->where("id",$id);
        $this->db->from("update_vendortemplate");
		$data = $this->db->get();
		return $data->row();
	}
	
	function matchexcelfields($file,$vendortemplatedetails)
	{
		$error = array();
		$count = 0;
		// echo $file;
	    $excel = new Spreadsheet_Excel_Reader();
	    $excel->read(UPLOADEDFILES_URL.'/vendorfiles/'.$file);
	    $x=2;
	    $numcolums = $excel->sheets[0]['numCols'];
		$vendortemplatearray = array_filter(explode(",",$vendortemplatedetails));
		$vtemplatesize = sizeof($vendortemplatearray);
	    for($i=1;$i<=$numcolums;$i++)
		{
		$dataa = trim($excel->sheets[0]['cells'][1][$i]);
		if(in_array($dataa,$vendortemplatearray))
		{
		$count = $count +1;
		$error[] = TRUE;
		}
		else
		{
		$error[] = "Exist";
		}
		}
		if($count == $vtemplatesize)
		{
		// return false means in excel file fields matching and everything okay
		return TRUE;
		}
		else
		{
		// return false means in excel file fields not matching
		return FALSE;
		}
		exit;
	}
	
	function senddatatodb($file,$vendortemplatedetails,$vendorid,$templateid)
	{
		
		$columns = array();
		$vendortemplateexcels = $vendortemplatedetails->template_excelstructure;
		$vendortemplatedb = $vendortemplatedetails->template_dbstructure;
		$vendortemplatedbrray = array_filter(explode(",",$vendortemplatedb));
		$vendortemplatearray = array_filter(explode(",",$vendortemplateexcels));
		$vtemplatesize = sizeof($vendortemplatearray);
		// print_r($vendortemplatearray)."<br>";
		// column postion in excel start
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
	   for($i=0;$i<=$numcolums;$i++){
		if(isset($excel->sheets[0]['cells'][1][$i]))
	   $data = $excel->sheets[0]['cells'][1][$i];
	   else
	   $data = "";
	   if(in_array($data,$vendortemplatearray))
	   {
		  $key = array_search($data,$vendortemplatearray);
		  $arraykey[] =  $key;
		  $columns[] =  $i;
	   }
			}
			// echo "<br><pre>";
			// print_r($arraykey);
			// echo "</pre>";
			// echo "<br><pre>";
			// print_r($vendortemplatearray);
			// echo "</pre>";
			$arraysize = sizeof($arraykey);
			$newarray = array();
			for($i=0;$i<$arraysize;$i++)
			{
				$value = $arraykey[$i];
				$newarray[] = $vendortemplatedbrray[$value];
			}
			// echo "<br><pre>";
			// print_r($newarray);
			// echo "</pre>";
			// echo "<br>Column numberss<pre>";
			// print_r($columns);
			$numberofcolumnsadd = sizeof($columns);
			// echo "<br>".$numrows;
			// echo "</pre>";
			
			// makeing query for data entering in database - first array start
			
			for($i=2;$i<=$numrows;$i++){
				$dbdataarray = array();
			for($j=0;$j<$numberofcolumnsadd;$j++){
				$columnval = $columns[$j];
			if(isset($excel->sheets[0]['cells'][$i][$columnval]))
		   			$data = $excel->sheets[0]['cells'][$i][$columnval];
		   			else
		   			$data = "";
					if($newarray[$j] == "product_upc")
					{
						$data = str_replace(' ', '', $data);
						$currentupc = trim($data);
					}elseif($newarray[$j] == "product_sku")
					{
						$data = str_replace(' ', '', $data);
						$currentsku = $data;
					}
    	   			$dbdataarray[$newarray[$j]] = trim(htmlspecialchars($data, ENT_QUOTES));
				}
			$dbdataarray['product_source'] = "$vendorid";
			$dbdataarray['status'] = "1";
			$dbdataarray['templateid'] = "$templateid";
			$upc_exist = $this->check_upc_vendor($currentsku);
			if($upc_exist == FALSE)
			{
			$this->masterdata($dbdataarray);
			}
			else
			{
			// Duplicate UPC goes to finaliseduplicateproductlist start
			$englishid = $this->updateduplicatedata($dbdataarray,$currentsku);
			// Duplicate UPC goes to finaliseduplicateproductlist ends
			}
			// echo $this->db->last_query();exit;
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			$this->updatefilestatus($file);
			
			// makeing query for data entering in database - first array ends
		
	}
	
	function updatefilestatus($filename)
	{
	$data = array (
					'status' => "2"
					);
	$this->db->where('filename',"$filename");
	$this->db->update('files_foraddproduct',$data);
	if($this->db->affected_rows() > 0)
	return TRUE;
	else
	return FALSE;
	}
	
	function check_upc_vendor($sku)
	{
	$this->db->select('*');
	$this->db->where('product_sku',$sku);
	$this->db->from('update_queue_masterproducttable');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return TRUE;
	else
	return FALSE;
	}
	
	function masterdata($data)
	{
			$this->db->insert('update_queue_masterproducttable',$data);
			return $this->db->insert_id();
	}
	
	function updateduplicatedata($data,$sku)
	{
			$this->db->where('product_sku',$sku);
			$this->db->update('update_queue_masterproducttable',$data);
			return $this->db->insert_id();
	}
	
	
}
?>
