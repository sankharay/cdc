<?php
class trashcontentm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function rejectcontent($ids)
    {
     $iddata = explode(",",$ids);
	 foreach($iddata as $values)
	 {
		 echo $values;
		$this->mastertable($values);
	 }
	}
	
	function mastertable($values)
	{	
	 $status = array
	 			(
			'status'=> '16'
				);
	 $this->db->where('mpt_id',$values);
	 $this->db->update('masterproducttable',$status);
	 return $this->db->affected_rows();
	}
}
?>
