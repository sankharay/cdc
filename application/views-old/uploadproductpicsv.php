<?php
if($this->session->userdata('success'))
{
	echo "Image Uploaded Successfuly";
	$this->session->unset_userdata('success');
}
?>
<form action="<?php echo BASE_URL;?>/uploadproductpics/images/<?php echo $this->uri->segment(3); ?>" method="post" enctype="multipart/form-data">
<table width="500px" border="0">
  <tr>
    <td>Upload Images</td>
    <td><input type="file" name="userfile"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Upload File" name="submit"></td>
  </tr>
</table>
</form>
<script language="JavaScript">
window.parent.reload()
</script>