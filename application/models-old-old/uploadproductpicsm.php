<?php
class uploadproductpicsm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    function imgupload($upc,$imagename)
    {
	$query = $this->db->query("UPDATE `masterproducttable` SET `product_img_path`=CONCAT(`product_img_path`,',$imagename') where `product_upc`='$upc'");
	}
}
?>
