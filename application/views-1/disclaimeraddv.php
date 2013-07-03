<form action="<?php echo BASE_URL; ?>/disclaimermanagement/disclaimeradd" method="post">
<table width="100%" border="0">
  <tr>
    <td>Disclaimer Name</td>
    <td><input type="text" name="name" required></td>
  </tr>
  <tr>
    <td>English</td>
    <td><textarea rows="5" cols="30" required name="english"></textarea></td>
  </tr>
  <tr>
    <td>Spanish</td>
    <td><textarea rows="5" cols="30" required name="spanish"></textarea></td>
  </tr>
  <tr>
    <td>Status</td>
    <td>
    <select name="status" required>
    <option value="">Please select status</option>
    <option value="1">Active</option>
    <option value="2">De-Active</option>
    </select>
    </td>
  </tr>
  <tr>
  <td>&nbsp;
  </td>
  <td>
  <input type="submit" name="submit" value=" Add " class="btn btn-primary">
  </td>
  </tr>
</table>
</form>