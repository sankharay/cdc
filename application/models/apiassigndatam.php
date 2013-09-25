<?php
class apiassigndatam extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	function processproducts(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			$aidatacontent = $this->getdatafromapi($id);
			$aidatacontent['user_assign'] = $this->input->get('userid');
			$aidatacontent['priority'] = $_GET['priority'];
			unset($aidatacontent['mpt_id']);
			unset($aidatacontent['sppr_id']);
			unset($aidatacontent['returnable']);
			unset($aidatacontent['isset']);
			unset($aidatacontent['onlineonly']);
			$aidatacontent['inmagento']=1;
			$aidatacontent['status']=2;
			unset($aidatacontent['product_category']);
			if($aidatacontent['product_features'] == "")
			$aidatacontent['product_features']=".";
			$finalid = $this->insertfinaltable($aidatacontent);
			$aidatacontent['fpl_id'] = $finalid;
			$finalid = $this->insertmaster($aidatacontent);
			$this->updateapidataid($id);
		}
		if($err == 0){
			
			$msg = '<span class="label label-success">Products Processed Successfully</span>';
		}else{
			$msg = 'Products are not processed successfully';
		}
		
		return $msg;
	}
	
	function getdatafromapi($apmpt)
	{
	$this->db->select('*');
	$this->db->where('mpt_id',$apmpt);
	$this->db->from('api_masterproducttable');	
	$data = $this->db->get();
	if($data->num_rows() > 0 )
	return $data->row_array();
	else
	return FALSE;
	}
	
	function insertfinaltable($data)
	{
	$this->db->insert('finalproductlist',$data);
	return $this->db->insert_id();	
	}
	
	function insertmaster($data)
	{
	$this->db->insert('masterproducttable',$data);
	return $this->db->insert_id();	
	}
	
	function processassignthird(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			$aidatacontent = $this->setdataidsinapitable($id);
		}
		if($err == 0){
			
			$msg = '<span class="label label-success">Products Processed Successfully</span>';
		}else{
			$msg = 'Products are not processed successfully';
		}
		
		return $msg;
	}
	
	function setdataidsinapitable($id)
	{
	$data = array (
			'status' => "4"
					);
	$this->db->where('mpt_id',$id);
	$this->db->update('api_masterproducttable',$data);
	if($this->db->affected_rows() > 0)
	return TRUE;
	else
	return FALSE;
	}
	
	function updateapidataid($id)
	{
	$data = array (
			'status' => "2"
					);
	$this->db->where('mpt_id',$id);
	$this->db->update('api_masterproducttable',$data);
	if($this->db->affected_rows() > 0)
	return TRUE;
	else
	return FALSE;
	}
	
}
?>
