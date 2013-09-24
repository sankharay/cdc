<table width="1000px" height="1000px" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td><strong>Product Name</strong></td>
  </tr>
  <tr>
    <td><?php echo $content->prduct_name; ?></td>
  </tr>
  <tr>
    <td><strong>Product Short Description</strong></td>
  </tr>
  <tr>
    <td><?php echo htmlspecialchars_decode($content->short_description); ?></td>
  </tr>
  <tr>
    <td><strong>Product Description</strong></td>
  </tr>
  <tr>
    <td><?php echo htmlspecialchars_decode($content->product_description); ?></td>
  </tr>
  <tr>
    <td><strong>Product Specifications</strong></td>
  </tr>
  <tr>
    <td><?php echo htmlspecialchars_decode($content->product_specs); ?></td>
  </tr>
  <tr>
    <td><strong>Product Images</strong></td>
  </tr>
  <tr>
    <td>
    <?php
	if($content->product_img_path != "")
	{
	$images = explode(',',$content->product_img_path);
	if(sizeof($images) > 0)
	{
	foreach($images as $imagedatarow)
{
?>					
<img src="<?php echo $imagedatarow; ?>"  />
	<?php						
							// copy image section ends
}
	}
	else
	{
		?>
<img src="<?php echo $content->product_img_path; ?>"  />
	
<?php
	}
	}
	?>
    </td>
  </tr>
</table>
