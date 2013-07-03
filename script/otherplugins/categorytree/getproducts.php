<?php
include("dbw.php");
include("functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if($_GET['catid'] == "")
{
	echo "please select category";
}
else
{
$catid = get_products($_GET['catid']);
?>
<div style="height:400px; overflow:scroll;">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td><strong>Select Product</strong></td>
    <td><strong>Product Name</strong></td>
    <td><strong>Product Brand</strong></td>
  </tr>
<?php
$arraysize = sizeof($catid);
for($i=0;$i< $arraysize ; $i++)
{
?>
  <tr>
    <td><input type="checkbox" class="addsons" name="addon[]" value="<?php echo $catid[$i]['fpl_id']; ?>" /></td>
    <td><?php echo $catid[$i]['prduct_name']; ?></td>
    <td><?php echo $catid[$i]['product_brand']; ?></td>
  </tr>

<?php
}
}
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="addaddon" value="Add Addon's" onclick="return addproductsaddon();" /></td>
  </tr>
</table>
</div>
</body>
</html>