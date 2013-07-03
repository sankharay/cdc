<?php
function get_cat()
{
	$query = mysql_query("select * from categories where status=1");
	return $query;
}

function checksubcat($id)
{
	$query = mysql_query("SELECT * FROM `categories` WHERE `parent_id`='$id'AND `status`='1'");
	$status = mysql_num_rows($query);
	if($status > 0 )
	return TRUE;
	else
	return FALSE;
}

    function get_categories()
{
     $category=array();
     $res=mysql_query('SELECT * FROM categories');
      while($arr=mysql_fetch_assoc($res))
      {
           $category[$arr['parent_id']][$arr['id']]=$arr['name'];
      }
      return $category;
}
	
	class RightMenu {
    public $menu;
    public $patch = '';

    public function getMenu($parent = 0) {
		$i = 1;
		static $parents ='';
        $result = mysql_query("SELECT * FROM categories WHERE parent_id = $parent AND status = 1 ORDER BY name");
        if(mysql_num_rows($result) > 0) {
			if($i == 1)
			{
            echo '<ul id="tree1">';
			$i = $i+1;
			}
			else
			{
			echo '<ul>';
			}
            while($row = mysql_fetch_assoc($result)) {
                if($row['parent_id'] == 0){
                    $this->patch = '';
                }
                $this->patch .= '/';
                echo '<li><input type="checkbox" class="checking" id="'.$row["id"].'"  onchange="return getattrianddata('.$row["id"].');"  name="category[]" value="'.$row["id"].'"><label>' . $row["name"] . '</label>';

                echo $this->getMenu($row["id"]);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
	
	
	
	public function getaddonMenu($parent = 0) {
		$i = 1;
		static $parents ='';
        $result = mysql_query("SELECT * FROM categories WHERE parent_id = $parent AND status = 1 ORDER BY name;");
        if(mysql_num_rows($result) > 0) {
			if($i == 1)
			{
            echo '<ul id="tree1">';
			$i = $i+1;
			}
			else
			{
			echo '<ul>';
			}
            while($row = mysql_fetch_assoc($result)) {
                if($row['parent_id'] == 0){
                    $this->patch = '';
                }
                $this->patch .= '/';
                echo '<li><input type="checkbox"  name="addoncategory[]" value="'.$row["id"].'"><label>' . $row["name"] . '</label>';
                echo $this->getaddonMenu($row["id"]);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
	
	public function getselectedMenu($parent = 0) {
		
		echo $this->get_categoriess($fpl_id);
		$i = 1;
		static $parents ='';
        $result = mysql_query("SELECT * FROM categories WHERE parent_id = $parent AND status = 1 ORDER BY name;");
        if(mysql_num_rows($result) > 0) {
			if($i == 1)
			{
            echo '<ul id="tree1">';
			$i = $i+1;
			}
			else
			{
			echo '<ul>';
			}
            while($row = mysql_fetch_assoc($result)) {
                if($row['parent_id'] == 0){
                    $this->patch = '';
                }
                $this->patch .= '/';
                echo '<li><input type="checkbox" name="category[]" value="'.$row["id"].'"><label>' . $row["name"] . '</label>';
                echo $this->getselectedMenu($row["id"]);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
	
}
	
	class RightMenu_internal {
    public $menu;
    public $patch = '';

    public function getMenu($parent = 0) {
		$i = 1;
		static $parents ='';
        $result = mysql_query("SELECT * FROM categories WHERE parent_id = $parent AND status = 1 ORDER BY name;");
        if(mysql_num_rows($result) > 0) {
			if($i == 1)
			{
            echo '<ul id="tree1">';
			$i = $i+1;
			}
			else
			{
			echo '<ul>';
			}
            while($row = mysql_fetch_assoc($result)) {
                if($row['parent_id'] == 0){
                    $this->patch = '';
                }
                $this->patch .= '/';
				$subcatstatus = checksubcat($row["id"]);
				if(!$subcatstatus)
echo '<li><input type="checkbox" name="category[]" value="'.$row["id"].'" onclick="getproducts('.$row["id"].')"><label>' . $row["name"] . '</label>';
				else
				echo '<li><label>' . $row["name"] . '</label>';
                echo $this->getMenu($row["id"]);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
	
	
	
	public function getselectedMenu($parent = 0) {
		$i = 1;
		static $parents ='';
        $result = mysql_query("SELECT * FROM categories WHERE parent_id = $parent AND status = 1 ORDER BY name;");
        if(mysql_num_rows($result) > 0) {
			if($i == 1)
			{
            echo '<ul id="tree1">';
			$i = $i+1;
			}
			else
			{
			echo '<ul>';
			}
            while($row = mysql_fetch_assoc($result)) {
                if($row['parent_id'] == 0){
                    $this->patch = '';
                }
                $this->patch .= '/';
                echo '<li><input type="checkbox" name="category[]" value="'.$row["id"].'"><label>' . $row["name"] . '</label>';
                echo $this->getMenu($row["id"]);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
	
}
	
	function get_products($id)
	{
	$got = array();
	$query = mysql_query("SELECT * FROM `finalproductlist` WHERE `status`=1");
	$data = mysql_num_rows($query);
	while($queryrow = mysql_fetch_array($query))
	{
	$catque = explode('_',$queryrow['product_category']);
	$success = in_array($id,$catque);
	if($success)
	{
	$got[] = $queryrow;
	}
	echo "<br>";
	}
	return $got;
	}
	
	

	
	
?>