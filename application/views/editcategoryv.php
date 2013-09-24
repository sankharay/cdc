<form action="<?php echo BASE_URL; ?>/attributemanagement/editcategory/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td>Select Category</td>
    <td><select name="catid" required>
      <option value="">Please Select Category</option>
    <?php foreach($categories as $values)
				{
				echo "<option value=".$values->id.">".$values->name."</option>";
				}
	 ?>
   </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" class="btn btn-primary" value="Update Category"></td>
  </tr>
</table>
</form>