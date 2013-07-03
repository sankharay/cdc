<table width="500px" height="300px" border="0">
  <tr>
    <td valign="top"><strong>Error Header</strong></td>
    <td valign="top"><?php echo $content->header; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong>Error Details</strong></td>
    <td valign="top"><?php echo $content->header; ?></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"><input type="submit" class="btn btn-primary" name="header" id="header" value=" Delete " onclick="return qaerrordelete('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);"  /></td>
  </tr>
</table>
