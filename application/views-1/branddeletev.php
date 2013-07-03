<form action="<?php echo BASE_URL; ?>/brandmanagement/branddelete/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="500" height="200" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Brand Name</strong></td>
    <td><?php echo $content->brandName; ?><input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>"></td>
  </tr>
  <tr>
    <td><strong>Brand Magento Id</strong></td>
    <td><?php echo $content->bMagentoId; ?></td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>
    <?php echo $this->log->active_status($content->status); ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-primary" value="Delete Brand"></td>
  </tr>
</table>
</form>