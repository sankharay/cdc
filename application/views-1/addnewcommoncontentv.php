<form action="<?php echo BASE_URL; ?>/attributemanagement/addnewcommoncontent/" method="post">
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
    <td>Meta Keywords</td>
    <td>
<textarea rows="5" cols="35" name="metakeywords" required></textarea>
</td>
  </tr>
  <tr>
    <td>Meta Description</td>
    <td>
<textarea rows="5" cols="35" name="metadescription" required></textarea>
</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>
      <select name="status" required>
        <option value="">Please Select Status</option>
        <option value="1">Active</option>
        <option value="2">De-Active</option>
        </select>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" class="btn btn-primary" value="Add Attribute"></td>
  </tr>
</table>
</form>