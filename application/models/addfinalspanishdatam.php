<?php

class addfinalspanishdatam extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/excelreader/reader.php');
    }
	
    function listfile($userid)
    {
        $this->db->select('*');
		$this->db->where('userid',$userid);
		$this->db->where('filefor',3);
		$this->db->where('status',1);
		$this->db->from('files_foraddproduct');
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
	
	function senddatatodb($file)
	{
		$dbdataarray = array();
		$skudup = array();
	   $excel = new Spreadsheet_Excel_Reader();
	   $excel->read(UPLOADEDFILES_URL.'/useruploadfiles/'.$file);
	   $x=2;
	   $numrows = $excel->sheets[0]['numRows'];
	   $numcolums = $excel->sheets[0]['numCols'];
			// echo "<br>Column numberss<pre>";
			// print_r($columns);
			// echo "<br>".$numrows;
			// echo "</pre>";
			
			// makeing query for data entering in database - first array start
			$tabelfields = array (
						'1' => 'product_sku',
						'2' => 'product_upc',
						'3' => 'prduct_name',
						'4' => 'product_description',
						'5' => 'product_specs',
						'6' => 'product_metatags',
						'7' => 'product_metadescription',
						'8' => 'status'
									);
			
			
			for($i=2;$i<=$numrows;$i++){
				$dbdataarray = array();
			for($j=0;$j<$numrows;$j++){
				if(isset($excel->sheets[0]['cells'][$i][$j]))
		   		$dbdataarray[$tabelfields[$j]] = htmlspecialchars($excel->sheets[0]['cells'][$i][$j]);
				}
				$validate = $this->checkupcsku($dbdataarray['product_sku'],$dbdataarray['product_upc']);
				if(!$validate)
				{
					$this->spsnishfinalinsert($dbdataarray);
				}
				else
				{
					
					$this->spsnishfinalinsertupdate($dbdataarray,$dbdataarray['product_sku']);
					$skudup[] = $dbdataarray['product_sku'];
				}
			}
			if($skudup)
			{
			$lenght = sizeof($skudup);
			for($i=0;$i<$lenght;$i++)
			echo $skudup[$i]."<br>";
			}
			else
			{
			echo "product insert done";
			}
			// $this->db->insert_batch('masterproducttable', $dbdataarray);
			
			// makeing query for data entering in database - first array ends
		
	}
	
	function checkupcsku($sku,$upc)
	{
	$this->db->select('*');
	$this->db->where('product_sku',$sku);
	$this->db->where('product_upc',$upc);
	$this->db->from('spenishfinaldata');
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return TRUE;
	else
	return FALSE;
	}
	
	function spsnishfinalinsert($dbdataarray)
	{
	$this->db->insert('spenishfinaldata',$dbdataarray);
	return $this->db->insert_id();
	}
	
	function spsnishfinalinsertupdate($dbdataarray,$sku)
	{
	$this->db->where('product_sku',$sku);
	$this->db->update('spenishfinaldata',$dbdataarray);
	return $this->db->insert_id();
	}
	
	function pending_products()
	{
		$this->db->from('spenishfinaldata');
		$this->db->where('status', 1);
		$this->db->where('userid', $this->session->userdata('user_id'));
		$this->db->order_by("dateandtime", "desc");
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
			return $data;
		}
			else
			{
			return FALSE;
        	
        }
		
	}
	
	function admin_pending_products()
	{
		$this->db->from('spenishfinaldata');
		$this->db->where('status', 1);
		$this->db->where('userid', '0');
		$this->db->order_by("dateandtime", "desc");
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
			return $data;
		}
			else
			{
			return FALSE;
        	
        }
		
	}
	
	function final_products()
	{
		$this->db->from('spenishfinaldata');
		$this->db->where('status', 2);
		$this->db->where('userid', $this->session->userdata('user_id'));
		$this->db->order_by("dateandtime", "desc");
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
			return $data;
		}
			else
			{
			return FALSE;
        	
        }
		
	}
	
	function getothersproductqa($id)
	{
		$this->db->select('*');
		$this->db->where('sppr_id', $id);
		$this->db->from('spenishfinaldata');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            return $q->row();
		}
			else
			{
			redirect(BASE_URL.'/logout');
        	
        }
	}
	
	function updatecontent($data,$sppr_id)
	{
	$this->db->where('sppr_id',$sppr_id);
	$this->db->update('spenishfinaldata',$data);
	if($this->db->affected_rows() > 0)
	return TRUE;
	else
	return FALSE;
	}
	
	function all_users()
	{
		$this->db->select('*');
		$this->db->where('access_level != 1');
		$this->db->from('users');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
            return $q->result();
		}
			else
			{
			redirect(BASE_URL.'/logout');
        	
        }
	}
	
	function processproducts(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			$data = array(
			   'userid' => $this->input->get('userid'),
			   'priority' => $_GET['priority']
            );
			$this->db->where('sppr_id', $id);
			if($this->db->update('spenishfinaldata', $data)){
				$err = 0;
			}else{
				$err = 1;
			}
		}
		if($err == 0){
			
			$msg = '<span class="label label-success">Products Processed Successfully</span>';
		}else{
			$msg = 'Products are not processed successfully';
		}
		
		return $msg;
	}
	
	
}
?>
