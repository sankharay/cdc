<?php

class categorymanagementm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function listcat()
    {
        $this->db->select("*");
		$this->db->where("status",1);
		$this->db->from("categories");
		$this->db->group_by("magento_category_id");
		$data = $this->db->get();
		return $data->result();
	}
	
    function gatcatname($id)
    {
        $this->db->select("*");
		$this->db->from("categories");
		$this->db->where("status",1);
		$this->db->where("id",$id);
		$data = $this->db->get();
		if($data->result())
		return $data->row()->name;
		else
		return "No Parent Cat.";
	}
	
    function gatspanishcatname($id)
    {
        $this->db->select("*");
		$this->db->from("categories");
		$this->db->where("id",$id);
		$data = $this->db->get();
		if($data->result())
		return $data->row()->name;
		else
		return "No Spanish Name";
	}
	
    function listcatdropdown()
    {
        $this->db->select("*");
		$this->db->where("status",1);
		$this->db->from("categories");
		$data = $this->db->get();
		$datas = $data->result();
		$select = "<select name='parentcatid'>";
		$select.= "<option value=''>Please select Parent Category</option>";
		foreach($datas as $value)
		$select.= "<option value='".$value->id."'>".$value->name."</option>";
		return $select.= "</select>";
	}
	
    function listcatdropdownselected($id)
    {
        $this->db->select("*");
		$this->db->from("categories");
		$this->db->group_by('magento_category_id');
		$data = $this->db->get();
		$datas = $data->result();
		$select = "<select name='parentcatid'>";
		$select.= "<option value=''>Please select Parent Category</option>";
		foreach($datas as $value)
		{
		if($id == "$value->id" )
		$selection= 'selected=selected';
		else
		echo $selection= "";
		$select.= "<option $selection value='".$value->id."'>".$value->name."</option>";
		}
		return $select.= "</select>";
	}
	
    function listselectedcatdropdown($id)
    {
        $this->db->select("*");
		$this->db->where("status",1);
		$this->db->from("categories");
		$data = $this->db->get();
		$datas = $data->result();
		$select = "<select name='parentcatid'>";
		$select.= "<option value=''>Please select Parent Category</option>";
		foreach($datas as $value)
		{
		if($id == $value->id)
		$selection = "selected='selected'";
		else
		$selection = "";
		$select.= "<option $selection value='".$value->id."'>".$value->name."</option>";
		}
		return $select.= "</select>";
	}
	
	function insertcat($catname,$cattitle,$parentcatid,$magengDesc,$imagename,$magspanishname,$metaKeywords,$metaDescription,$smetaKeywords,$smetaDescription)
	{
	
	$dataarray = array (
				'name' =>$catname,
				'cattitle' =>$cattitle,
				'parent_id' =>$parentcatid,
				'categorydes' =>$magengDesc,
				'image' =>$imagename,
				'metakeywords' =>$metaKeywords,
				'metadescrption' =>$metaDescription,
				'spanish_metakeywords' =>$smetaKeywords,
				'spanish_metadescription' =>$smetaDescription,
				'spanish_name' => $magspanishname,
				'status' => '1'
						);
	$this->db->insert('categories',$dataarray);
	return $this->db->insert_id();
	}
	
	function updatecat($catname,$cattitle,$parentcatid,$magengDesc,$imagename,$magspanishname,$metaKeywords,$metaDescription,$smetaKeywords,$smetaDescription,$status,$catid)
	{
	$dataarray = array (
				'name' =>$catname,
				'cattitle' =>$cattitle,
				'parent_id' =>$parentcatid,
				'categorydes' =>$magengDesc,
				'image' =>$imagename,
				'metakeywords' =>$metaKeywords,
				'metadescrption' =>$metaDescription,
				'spanish_metakeywords' =>$smetaKeywords,
				'spanish_metadescription' =>$smetaDescription,
				'spanish_name' => $magspanishname,
				'status' => $status
						);
	$this->db->where('id',$catid);
	$result = $this->db->update('categories',$dataarray);
	return $result;
	}
	
	function delcat($catid)
	{
	$dataarray = array (
				'status' =>2
						);
	$this->db->where('id',$catid);
	$result = $this->db->update('categories',$dataarray);
	return $result;
	}
	
    function findsubcatexist($id)
    {
        $this->db->select("*");
		$this->db->from("categories");
		$this->db->where("status",1);
		$this->db->where("parent_id",$id);
		$data = $this->db->get();
		if($data->num_rows() > 0)
		return TRUE;
		else
		return FALSE;
	}
	
    function catexist($id)
    {
        $this->db->select("*");
		$this->db->from("categories");
		$this->db->where("id",$id);
		$data = $this->db->get();
		if($data->num_rows() > 0)
		return TRUE;
		else
		redirect(BASE_URL."/unauthorized/");
	}
	
	function catdetail($catid)
	{
        $this->db->select("*");
		$this->db->from("categories");
		$this->db->where("id",$catid);
		$this->db->limit('1');
		$data = $this->db->get();
		return $data->row();
	}
	
}
?>
