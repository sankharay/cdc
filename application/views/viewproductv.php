<table width="800px" border="0">

<?php
while (list($key, $value) = each($content)) 
{
	?>
  <tr>
    <td valign="top"><strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?></strong></td>
    <td valign="top">
	<?php 
	if($value != "")
	{
		if($key == "product_img_path")
		{
		$images = explode(",",$value);
		foreach($images as $value)
		{
		?>
<img src="<?php echo $value; ?>" height="50" width="50" />
        <?php
		}
		}
		else
		{
		echo $value;
		} 
	}
	else
	{
		if($key == "product_img_path")
		{
		echo "<strong>No Image Uploaded</strong>";
		}
		else
		{
		echo "<strong>No</strong>";
		}
	}
	?>
    </td>
  </tr>
    <?php
}
?>
</table>
