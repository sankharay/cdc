<form action="<?php echo BASE_URL; ?>/brandmanagement/brandedit/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Brand Name</strong></td>
    <td><input type="text" name="brandName" required value="<?php echo $content->brandName; ?>" /> </td>
  </tr>
  <tr>
    <td><strong>Brand Magento Id</strong></td>
    <td><input type="number" name="brandMagentoId" required value="<?php echo $content->bMagentoId; ?>" /></td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>
    <select name="status" required >
    <option value="">Please select Status</option>
    <option value="1" <?php if($content->status == 1 ) { echo "selected='selected'"; } ?>>Active</option>
    <option value="2" <?php if($content->status == 2 ) { echo "selected='selected'"; } ?>>De-Active</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-primary" value="Edit Brand"></td>
  </tr>
</table>
</form>