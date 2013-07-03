<table width="600px" border="0" cellpadding="5" cellspacing="5">
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
	foreach($images as $imagedatarow)
{
if($imagedatarow->fileplacement == 2 )
$imagelocation = IMAGES_LOCATION_CDC_WEB_URL."/resize/".$imagedatarow->img_name;
else
$imagelocation = IMAGES_LOCATION_CDC_WEB_URL."/images/".$imagedatarow->img_name;
							// copy image section starts
?>					
<img src="<?php echo $imagelocation; ?>"  />
	<?php						
							// copy image section ends
}
	?>
    </td>
  </tr>
</table>
