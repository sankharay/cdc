<form action="<?php echo BASE_URL; ?>/brandmanagement/brandadd" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Brand Name</strong></td>
    <td><input type="text" name="brandName" required /> </td>
  </tr>
  <tr>
    <td><strong>Brand Magento Id</strong></td>
    <td><input type="number" name="brandMagentoId" required /></td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>
    <select name="status" required >
    <option value="">Please select Status</option>
    <option value="1">Active</option>
    <option value="2">De-Active</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-primary" value="Add Brand"></td>
  </tr>
</table>
</form>