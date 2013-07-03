<form action="<?php echo BASE_URL; ?>/attributemanagement/addnewattributes/" method="post">
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
    <td>Attribute Name</td>
    <td><input type="text" name="attname" required value=""></td>
  </tr>
  <tr>
    <td>Attribute Scope</td>
    <td>
    <select name="attscope" required>
      <option value="">Please Select Scope</option>
      <option value="1">Single Selection</option>
      <option value="2">Multiple Selection</option>
      </select>
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