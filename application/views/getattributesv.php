<table width="100%" border="0">
<?php
if($main_attribut)
{
foreach($main_attribut as $values)
{
if($values->section_scope == 2)
{
$style = "style='height:150px;' multiple";
$name = "name=subattributes_".$values->id."[]";
}
else
{
$style = "";
$name = "name=subattributes_".$values->id;	
}
?>
  <tr >
    <td valign="top"><strong><?php echo $values->attributename; ?></strong></td>
    <td><?php 
	$subatt = $this->attributemanagementm->get_sub_attributes($values->id);
	?>
    <select <?php echo $name; ?> <?php echo $style; ?> >
    <option value="">Select Attributes</option>
    <?php 
	foreach($subatt as $values)
	{
		?>
    <option value="<?php echo  $values->value; ?>"><?php echo  $values->name; ?></option>
    <?php
	}
	?>
    </select>
    </td>
  </tr>
<?php
}
}
else
{
?>
<tr><td><strong>No Attribute relate to this product</strong></td></tr>
<?php
}
?>
</table>