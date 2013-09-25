<?php
if($templates)
{
foreach($templates as $val)
{
?>
<input name="vendortemplateid" id="vendortemplateid" type="radio" value="<?php echo $val->id; ?>" checked>&nbsp;&nbsp;<?php echo $val->template_excelstructure; ?> ( <?php echo $val->template_dbstructure; ?> ) <br>
<?php	
}
}
else
{
echo "<br>No Existing Template";	
}
?>
<br><br>
<input type="button"  value="Add new template" class="btn btn-small btn-primary" onClick="myPopup1('<?php echo $filename->filename; ?>','<?php echo $vendorid; ?>')" />