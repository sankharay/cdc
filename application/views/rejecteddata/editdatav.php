<table width="500px" height="250px" border="0">
  <tr>
    <td valign="top"><strong>Error Header</strong></td>
    <td valign="top"><input type="text" name="header" id="header" value="<?php echo $content->header; ?>" /></td>
  </tr>
  <tr>
    <td valign="top"><strong>Error Details</strong></td>
    <td valign="top"><textarea rows="10" cols="80" name="details" id="details"><?php echo $content->details; ?></textarea></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"><input type="submit" class="btn btn-primary" name="header" id="header" value=" Edit " onclick="return qaerrorediting('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);" /></td>
  </tr>
</table>
