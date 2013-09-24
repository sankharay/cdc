<?php

class processfilebyuserm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/excelreader/reader.php');
		$process = 1;
    }
	
    	function get_vendors()
	{
        $this->db->select('*');
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		return $data->result();
	}
	
	function get_filename($id,$userid)
	{
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->where('userid',$userid);
		$this->db->from('files_foraddproduct');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
		return $data->row();
		}
		else
		{
		redirect(BASE_URL.'/unauthorized');	
		}
	}
	
	function updatefilerecord($fileid,$userid)
	{
	$data = array (
		 		'status' => '2'
		 				);
		$this->db->where('id',$fileid);
		$this->db->where('userid',$userid);	
		$this->db->update('files_foraddproduct',$data);
		return TRUE;	
	}
	
	function verifyvendor($id)
	{
        $this->db->select('*');
        $this->db->where('vmID',$id);
		$this->db->from('vendormanagement');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
		return TRUE;
		}
		else
		{
		redirect(BASE_URL.'/unauthorized');	
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
        $this->db->from("vendortemplate");
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row();
		else
		return FALSE;
	}
	
	function matchexcelfields($file,$vendortemplatedetails)
	{
		$error = array();
		$count = 0;
		// echo $file;
	    $excel = new Spreadsheet_Excel_Reader();
	    $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	    $x=2;
	    $numcolums = $excel->sheets[0]['numCols'];
		$vendortemplatearray = array_filter(explode(",",$vendortemplatedetails));
		$vtemplatesize = sizeof($vendortemplatearray);
	    for($i=1;$i<=$numcolums;$i++)
		{
		$dataa = $excel->sheets[0]['cells'][1][$i];
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
	
	function senddatatodb($file,$vendortemplatedetails,$vendorid,$attributes)
	{
		$columns = array();
		$attributesa = explode(',',$attributes);
		$attributesasize = sizeof($attributesa);
		$vendortemplateexcels = $vendortemplatedetails->template_excelstructure;
		$vendortemplatedb = $vendortemplatedetails->template_dbstructure;
		$vendortemplatedbrray = array_filter(explode(",",$vendortemplatedb));
		$vendortemplatearray = array_filter(explode(",",$vendortemplateexcels));
		$vtemplatesize = sizeof($vendortemplatearray);
		// print_r($vendortemplatearray)."<br>";
		// column postion in excel start
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
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
			//echo "<br><pre>";
			//print_r($arraykey);
			//echo "</pre>";
			//echo "<br><pre>";
			//print_r($vendortemplatearray);
			//echo "</pre>";
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
						$currentupc = $data;
					}elseif($newarray[$j] == "product_sku")
					{
						$data = str_replace(' ', '', $data);
						$currentsku = $data;
					}
    	   			$dbdataarray[$newarray[$j]] = htmlspecialchars($data);
				}
			$dbdataarray['attributes']="";
			for($a=0;$a < $attributesasize;$a++)
			{
			$duta = str_replace(" ","",$excel->sheets[0]['cells'][$i][$attributesa[$a]]);
			$subattributevalue = $this->getsubattribute_name_to_id($excel->sheets[0]['cells'][$i][$attributesa[$a]]);
			$dbdataarray['attributes'].= "(".$excel->sheets[0]['cells'][1][$attributesa[$a]]."-".$subattributevalue.")";
			}
			$dbdataarray['product_source'] = "$vendorid";
			// echo "<br><pre>";
			// print_r($dbdataarray);
			// echo "<br></pre>";
			$upc_exist = $this->check_upc_vendor($currentupc,$vendorid,$dbdataarray);
			if($upc_exist == FALSE)
			$this->db->insert('masterproducttable', $dbdataarray);
			// echo $this->db->last_query();exit;
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			
			// makeing query for data entering in database - first array ends
		
	}
	
	function getattribute_name_to_id($value)
	{
	$this->db->select('*');
	$this->db->where('attributename',"$value");
	$this->db->from('attribute_types');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
		return $data->row()->id;
	}
	else
	{
	return FALSE;	
	}
	}
	
	function getsubattribute_name_to_id($value)
	{
	$this->db->select('*');
	$this->db->where('name',"$value");
	$this->db->from('attribute_types_sub');
	$data = $this->db->get();
	if($data->num_rows() > 0)
	{
		return $data->row()->value;
	}
	else
	{
	return FALSE;	
	}
	}
	
	
	
	function matchexcelupdatefields($file,$vendortemplatedetails)
	{
		$error = array();
		$count = 0;
	    $excel = new Spreadsheet_Excel_Reader();
	    $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	    $x=2;
	    $numcolums = $excel->sheets[0]['numCols'];
		$vendortemplatearray = array_filter(explode(",",$vendortemplatedetails));
		$vtemplatesize = sizeof($vendortemplatearray);
	    for($i=1;$i<=$numcolums;$i++)
		{
		$dataa = $excel->sheets[0]['cells'][1][$i];
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
		if($count == $numcolums)
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
	
	function updatedatatodb($file,$vendortemplatedetails,$vendorid)
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
	   $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
	   for($i=1;$i<=$numcolums;$i++){
	   $data = $excel->sheets[0]['cells'][1][$i];
	   if(in_array($data,$vendortemplatearray))
	   {
		  $key = array_search($data,$vendortemplatearray);
		  $arraykey[] =  $key;
		  $columns[] =  $i;
	   }
			}
			//echo "<br><pre>";
			//print_r($arraykey);
			//echo "</pre>";
			//echo "<br><pre>";
			//print_r($vendortemplatearray);
			//echo "</pre>";
			$arraysize = sizeof($arraykey);
			$newarray = array();
			for($i=0;$i<$arraysize;$i++)
			{
				$value = $arraykey[$i];
				$newarray[] = $vendortemplatedbrray[$value];
			}
			//echo "<br><pre>";
			//print_r($newarray);
			//echo "</pre>";
			//echo "<br>Column numberss<pre>";
			//print_r($columns);
			$numberofcolumnsadd = sizeof($columns);
			//echo "</pre>";
			
			// makeing query for data entering in database - first array start
			
			for($i=2;$i<=$numrows;$i++){
				$dbdataarray = array();
			for($j=1;$j<$numberofcolumnsadd;$j++){
				$columnval = $columns[$j];
				$columnsval = $columns[0];
		   $data = $excel->sheets[0]['cells'][$i][$columnval];
		   $primaryvalue = $excel->sheets[0]['cells'][$i][$columnsval];
    	   $dbdataarray[$newarray[$columnval-1]] = "$data";
				}
			$this->db->where($newarray[0],$primaryvalue);
			$this->db->update('masterproducttable', $dbdataarray);
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			echo "<strong>Products Updated Successfully</strong>";
			// makeing query for data entering in database - first array ends
		
	}
	
	function check_upc_vendor($upc,$vendorid,$dbdataarray)
	{
	$this->db->select('product_upc,fpl_id,sppr_id');
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->from('masterproducttable');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	{
		$product_fpl_id = $data->row()->fpl_id;
		$product_sppr_id = $data->row()->sppr_id;
		if($product_fpl_id != "" AND $product_sppr_id != "")
		{
			if($dbdataarray['product_cost'] != "")
			{
					$updatestring = array (
								'product_cost' => $dbdataarray['product_cost'],
								'status' => '9'
											);
					$this->spanishupdate($upc,$vendorid,$updatestring);
					$this->englishupdate($upc,$vendorid,$updatestring);
					return TRUE;
			}
		}
		else
		{
		if($dbdataarray['product_cost'] != "")
			{
					$updatestring = array (
								'product_cost' => $dbdataarray['product_cost'],
								'status' => '3'
											);
					$this->mastertable($upc,$vendorid,$updatestring);
					return TRUE;
			}
		}
	}
	else
	{
	return FALSE;	
	}
	}
	
	function spanishupdate($upc,$vendorid,$updatestring)
	{
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->update('spenishdata',$updatestring);
	return TRUE;
	}
	
	function englishupdate($upc,$vendorid,$updatestring)
	{
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->update('finalproductlist',$updatestring);
	return TRUE;
	}
	
	function mastertable($upc,$vendorid,$updatestring)
	{
	$this->db->where('product_upc',$upc);
	$this->db->where('product_source',$vendorid);
	$this->db->update('masterproducttable',$updatestring);
	return TRUE;
	}
	
	
	
	
}
?>
