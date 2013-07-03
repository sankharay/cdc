<?php

class vendortemplateprocessorm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		include(PLUGINS_URL.'/excelreader/reader.php');
		$process = 1;
    }
  
  function getheader($file)
  {
   $excel = new Spreadsheet_Excel_Reader();
   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/'.$file);
   $x=2;
  $numcolums = $excel->sheets[0]['numCols'];
  $data = "<table width='200' border='0' cellpadding='8' cellspacing='5'>";
  for($i=1;$i<=$numcolums;$i++){
  $data.="<tr>";
  $data.="<td>";
  $data.="<input type='hidden' name='cells[]' value='".$excel->sheets[0]['cells'][1][$i]."'>";
  $data.=$excel->sheets[0]['cells'][1][$i];
  $data.="</td></tr>";
		}
  $data.="</table>";
  return $data;
  }
  
  function numcolumns($file)
  {
  $excel = new Spreadsheet_Excel_Reader();
   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/'.$file);
  return $numcolums = $excel->sheets[0]['numCols'];
  }
  
  function numrows($file)
  {
  $excel = new Spreadsheet_Excel_Reader();
   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/'.$file);
  return $numcolums = $excel->sheets[0]['numRows'];
  }
  
  function get_excel_data()
  {
   $excel = new Spreadsheet_Excel_Reader();
   $excel->read(UPLOADEDFILES_URL.'/vendorfiles/'.$file);
   $x=2;
   $numrows = $excel->sheets[0]['numRows'];
   $numcolums = $excel->sheets[0]['numCols'];
  for($i=2;$i<=$numrows;$i++){
		for($j=1;$j<=$numcolums;$j++){
				echo $cell = $excel->sheets[0]['cells'][$i][$j];
			}
	     }
  }
	
    function listfields()
    {
		$fields = $this->db->list_fields('masterproducttable');
		$selectdata = "<select name='fieldsdata[]'>";
		$selectdata .= "<option value=''>Please Select Column</option>";
		foreach ($fields as $field)
		{
		$selectdata .= "<option value='$field'>".$field."</option>";
		}
		$selectdata .= "</select>";
		return $selectdata;	
	}
	
	function num_fields()
    {
		$fields = $this->db->list_fields('masterproducttable');
		return sizeof($fields);
	}
	
	function updatetemplate($dbfields,$excelfields,$vendorid)
	{
		$data = array
				(	
				'template_excelstructure'=>"$excelfields",
				'template_dbstructure'=>"$dbfields",
				'status'=>'2'
				);
		$this->db->where('vendor_id',$vendorid);
		$this->db->update('vendortemplate',$data);
		
	}
  
  
}
?>
