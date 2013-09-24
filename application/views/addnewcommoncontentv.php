<form action="<?php echo BASE_URL; ?>/attributemanagement/addnewcommoncontent/" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="3">Select Category
      <select name="catid" required>
        <option value="">Please Select Category</option>
        <?php foreach($categories as $values)
				{
				echo "<option value=".$values->id.">".$values->name."</option>";
				}
	 ?>
      </select>    </td>
    </tr>
  <tr>
    <td colspan="2"><label>English Meta Keywords</label>
  <textarea rows="5" cols="35" name="metakeywords" required></textarea></td>
    <td width="31%"><label>Spanish Meta Keywords</label><textarea rows="5" cols="35" name="spanishmetakeywords" required></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><label>English Meta Description</label>
  <textarea rows="5" cols="35" name="metadescription" required></textarea></td>
    <td><label>Spanish Meta Description</label><textarea rows="5" cols="35" name="spanishmetadescription" required></textarea></td>
  </tr>
  <tr>
    <td width="32%">Status</td>
    <td colspan="2">
      <select name="status" required>
        <option value="">Please Select Status</option>
        <option value="1">Active</option>
        <option value="2">De-Active</option>
        </select>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" name="submit" class="btn btn-primary" value="Add Attribute"></td>
  </tr>
</table>
</form>