<form action="<?php echo BASE_URL; ?>/attributemanagement/addnewattributestypes/" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td>Select Category</td>
    <td><select name="parentattid" required>
      <option value="">Please Select Attribure Name</option>
    <?php foreach($subattributes as $values)
				{
				echo "<option value=".$values->id.">".$values->attributename."</option>";
				}
	 ?>
   </select>
    </td>
  </tr>
  <tr>
    <td>Property Name</td>
    <td><input type="text" name="attpropertyname" required value=""></td>
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