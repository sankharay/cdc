<?php

class contentsearchm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
    	
	function search_products(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc, product_brand, 	product_source, status');
		$this->db->from('masterproducttable');
		$this->db->where('status != ', 1);
		if(strtolower($this->session->userdata('lname')) == 'vindia'){
			$this->db->where('status = ', 3);
		}
		$q = $this->db->get();		
		if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        	return $data;
        }
		
	}
	
	function processproducts(){
		$v = explode(',',$_GET['vals']);
		$err = 0;
		for($i=0;$i<sizeof($v);$i++){
			
			$id = $v[$i];
			
			$data = array(
               'status' => '2',
			   'priority' => $_GET['priority']
            );
			$this->db->where('mpt_id', $id);
			$this->db->where('status', '3');
			if($this->db->update('masterproducttable', $data)){
				$err = 0;
			}else{
				$err = 1;
			}
		}
		if($err == 0){
			
			 
			$activity = " Search Activity";
			$this->log->logdata($activity);
			
			$msg = '<span class="label label-success">Products Processed Successfully</span>';
		}else{
			$msg = 'Products are not processed successfully';
		}
		
		return $msg;
	}
	
	function pending_products(){
		
		$this->db->select('mpt_id, prduct_name, product_sku, product_upc, product_brand, product_source, status,priority,comment');
		$this->db->from('masterproducttable');
		$this->db->where('status', 2);
		$this->db->group_by('product_sku');
		$this->db->order_by("priority", "desc"); 
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
	
	function productwiz($upc){
	
		$data = array(
		   'status' => '4'
		);
		$this->db->where('product_upc', $upc);
		$this->db->update('masterproducttable', $data);
		
		$this->db->select('*');
		$this->db->from('masterproducttable');
		$this->db->where('product_upc', $upc);
//		$this->db->limit(1);
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                //$data[''] = $row;
				
				$pname[] = $row['prduct_name'];
				$psku[] = $row['product_sku'];
				$pupc[] = $row['product_upc'];
				$pcost[] = $row['product_cost'];
				
				$pretail[] = $row['product_retail'];
				$pmsrp[] = $row['product_msrp'];
				$pmap[] = $row['product_map'];
				$pimg[] = $row['product_img_path'];
				$pId[] = $row['mpt_id'];
				$brand[] = $row['product_brand'];
				$pdesc[] = $row['product_description'];
				$pfeature[] = $row['product_features'];
				$pspecs[] = $row['product_specs'];
				
				$etilizeproid = $row['etilizeProId'];
				
				$sql = 'select vendorName from vendormanagement where vendorID = "'.$row['product_source'].'"';
				$re = mysql_query($sql);
				$ro = mysql_fetch_array($re);
				$psource[] = $ro['vendorName'];
            }

			$data['pname'] =	$pname;
			$data['psku'] = $psku;
			$data['pupc'] = $pupc;
			$data['pcost'] = $pcost;
			$data['pretail'] = $pretail;
			$data['pmsrp'] = $pmsrp;
			$data['pmap'] = $pmap;
			$data['psource'] = $psource;
			$data['pimg'] = $pimg;
			$data['brand'] = $brand;
			$data['pId'] = $pId;
			$data['pdesc'] = $pdesc;
			$data['pfeature'] = $pfeature;
			$data['pspecs'] = $pspecs;
			
			$data['etilizeName'] = '';
			$data['etilizeDesc'] = '';
			$data['etilizeFeature'] = '';
			$data['etilizeSpecs'] = '';
			$data['etilizeimg']	= '';		
			echo $etilizeproid."dasdsadasdas";
			if($etilizeproid!='0'){
			
			$conn1 = mysql_connect('localhost','root','',true);
			mysql_select_db('etilizeproduct',$conn1);
			
				$s = 'SELECT a.name, pa.`displayvalue`
						FROM `productattribute` AS pa, attributenames AS a
						WHERE pa.`attributeid` = a.`attributeid`
						AND pa.`productid` ='.$etilizeproid.'
						AND pa.`localeid` =1
						GROUP BY pa.`attributeid` , `displayvalue`';
						
					$sr = mysql_query($s,$conn1);
					$specs = array();
					while($sro = mysql_fetch_array($sr)){
						if(array_key_exists($sro['name'],$specs)){
							$specs[$sro['name']] = $specs[$sro['name']].','.$sro['displayvalue'];
						}else{
							$specs[$sro['name']] = $sro['displayvalue'];
						}
						
					}
					
					$p = 'select description from productdescriptions where productid = "'.$etilizeproid.'" and localeid = "1" and isdefault = "1"';
					$pr = mysql_query($p,$conn1);
					$pro = mysql_fetch_array($pr);
								
					$b = 'SELECT p.`manufacturerid` , mf.name FROM `product` AS p, manufacturer AS mf WHERE p.`manufacturerid` = mf.`manufacturerid` AND p.productid ="'.$etilizeproid.'"' ;
					//$b = 'select name from manufacturer where productid = "'.$etilizeproid.'" and localeid = "1" and isdefault = "1"';
					
					$br = mysql_query($b,$conn1);
					$bro = mysql_fetch_array($br);
					
					
					$i = 'SELECT type FROM `productimages`WHERE `productid` = "'.$etilizeproid.'"';
					$ir = mysql_query($i,$conn1);
					$img = array();
					while($iro = mysql_fetch_array($ir)){
						
						$img[] = 'http://content.etilize.com/'.$iro['type'].'/'.$etilizeproid.'.jpg';					
						// To save the image please follow the line of code below
						/*$url = 'http://content.etilize.com/'.$iro['type'].'/'.$etilizeproid.'.jpg';
						$img = 'images/'.$etilizeproid.'.jpg';
						file_put_contents($img, file_get_contents($url));*/
					}
   					
					
				 $data['etilizeName'] = $pro['description'];
				 $data['etilizeDesc'] = $specs['Marketing Information'];
				 $data['etilizeFeature'] = $specs['Package Contents'];
				 
				 $new = $specs;
					
				  unset($new['Marketing Information']);
				  unset($new['Package Contents']);
				 
				 $data['etilizeSpecs'] = $new;
				 $data['etilizeimg']	= $img;	
				
					
			}
		
		
		
		return $data;

        }
	}
	
	
}
?>
