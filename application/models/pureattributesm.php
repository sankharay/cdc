<?php

class pureattributesm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function get_attributes()
    {
     $this->db->select('*');
	 $this->db->from('attributehandler');
	 $data = $this->db->get();
	 if($data->num_rows() > 0 )
	 return $data->result();
	 else
	 return false;
	}
	
	function get_allfinalproducts()
	{
	$this->db->select('*');
	$this->db->where('status',1);
	$this->db->where('inmagento',1);
	$this->db->from('finalproductlist');
	$finaldata = $this->db->get();
	if($finaldata->num_rows() > 0)
	{
	return $finaldata->result();	
	}
	else
	{
	return FALSE;	
	}
	}
	
	function update_attributes($data)
	{
		foreach($data as $datavalue)
		{
		$attributes = $this->callattributes($datavalue->product_sku);
		$this->updatefinaltabelattributre($datavalue->product_sku,$attributes);
		}
	}
	
	function callattributes($sku)
	{
	$this->db->select('*');
	$this->db->from('masterproducttable');
	$finaldata = $this->db->get();
	if($finaldata->num_rows() > 0)
	{
	return $finaldata->row()->attributes;	
	}
	else
	{
	return FALSE;	
	}
	}
	
	function updatefinaltabelattributre($sku,$attributes)
	{
	$data  = array(
			'attributes'=> "$attributes"
					);
	$this->db->where('product_sku',$sku);
	$this->db->update('finalproductlist',$data);
	echo $this->db->last_query();
	}
	
	
}
?>
