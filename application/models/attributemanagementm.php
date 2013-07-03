<?php

class attributemanagementm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function get_all_attributes()
    {
		$this->db->select("*");
		$this->db->from('attribute_types');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function get_main_attributes($id)
	{
		$this->db->select("*");
		$this->db->from('attribute_types');
		$this->db->where('categoryid',$id);
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function get_sub_attributes($id)
	{
		$this->db->select("*");
		$this->db->from('attribute_types_sub');
		$this->db->where('attributeid',$id);
		$this->db->where('status',1);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function attribute_status($id)
	{
	if($id == 1)
	{
	$status = "active";
	return $status;	
	}
	else
	{
	$status = "De-active";
	return $status;
	}
	}
	
    function get_category_name($id)
    {
		$this->db->select("name");
		$this->db->where('id',$id);
		$this->db->from('categories');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->row()->name;
		else
		return FALSE;
	}
	
    function get_sub_attribute_names($id)
    {
		$this->db->select("*");
		$this->db->where('attributeid',$id);
		$this->db->from('attribute_types_sub');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		return $data->result();
		else
		return FALSE;
	}
	
	function list_categories()
	{
		$this->db->select("*");
		$this->db->from('categories');
		$this->db->order_by('name',DESC);
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->result();
		}
		else
		{
		return FALSE;
		}
	}
	
	function add_attributes($data)
	{
	$request = $this->db->insert('attribute_types',$data);
	return TRUE;
	}
	
	function add_subattributes($data)
	{
	$request = $this->db->insert('attribute_types_sub',$data);
	return TRUE;
	}
	
	function list_attributes()
	{
		$this->db->select("*");
		$this->db->from('attribute_types');
		$data = $this->db->get();
		if($data->num_rows() > 0 )
		{
		return $data->result();
		}
		else
		{
		return FALSE;
		}
	}
	
	function delete_sub($id)
	{
	$this->db->where('id',$id);
	$result = $this->db->delete('attribute_types_sub');
	return TRUE;
	}
	
	function common_meta_content()
	{
	$this->db->select("*");
	$this->db->from('common_meta_content');
	$result = $this->db->get();
	if($result->num_rows() > 0 )
	return $result->result();
	else
	return FALSE;
	}
	
	function insert_common_data($data)
	{
	$request = $this->db->insert('common_meta_content',$data);
	return $request;
	}
	
	function update_common_data($data,$id)
	{
	$this->db->where('id',$id);
	$this->db->update('common_meta_content',$data);
	return TRUE;
	}
	
	
	function idduplicate($id)
	{
	$this->db->select("*");
	$this->db->where('categoryid',$id);
	$this->db->from('common_meta_content');
	$result = $this->db->get();
	if($result->num_rows() > 0 )
	return TRUE;
	else
	return FALSE;
	}
	
	function get_common_content($id)
	{
	$this->db->select("*");
	$this->db->where('id',$id);
	$this->db->from('common_meta_content');
	$result = $this->db->get();
	if($result->num_rows() > 0 )
	return $result->row();
	else
	return FALSE;
	}
	
	function get_metainformation($catid)
	{
	$this->db->select("*");
	$this->db->where('categoryid',$catid);
	$this->db->from('common_meta_content');
	$result = $this->db->get();
	if($result->num_rows() > 0 )
	return $result->row();
	else
	return FALSE;
	}
	
	function updatecat($id,$catid)
	{
	$data = array (
			'categoryid'=> $catid
					);
	$this->db->where('id',$id);
	$this->db->update('attribute_types',$data);
	if($this->db->affected_rows() > 0 )
	return TRUE;
	else
	return FALSE;
	}
	
	
}
?>
