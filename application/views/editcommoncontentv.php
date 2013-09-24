<form action="<?php echo BASE_URL; ?>/attributemanagement/editcommoncontent/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="100%" border="0" cellpadding="15" cellspacing="15">
  <tr>
    <td>Select Category</td>
    <td colspan="2">
    <select name="catid" required>
      <option value="">Please Select Category</option>
    <?php foreach($categories as $values)
				{
				if( $content->categoryid == $values->id) { $selection = "selected='selected'"; } else { $selection="";  }
				echo "<option value=".$values->id." $selection >".$values->name."</option>";
				}
	 ?>
   </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><label>English Meta Keywords</label>
  <textarea rows="5" cols="35" name="metakeywords" required><?php echo $content->metakeywords; ?></textarea></td>
    <td><label>Spanish Meta Keywords</label><textarea rows="5" cols="35" name="spanishmetakeywords" required><?php echo $content->spanish_metakeywords; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><label>English Meta Description</label>
  <textarea rows="5" cols="35" name="metadescription" required><?php echo $content->metadescription; ?></textarea></td>
    <td><label>Spanish Meta Description</label><textarea rows="5" cols="35" name="spanishmetadescription" required><?php echo $content->spanish_metadescription; ?></textarea></td>
  </tr>
  <tr>
    <td>Status</td>
    <td colspan="2">
      <select name="status" required>
        <option value="">Please Select Status</option>
        <option value="1" <?php if($content->status == 1) { echo  "selected='selected'"; } ?>>Active</option>
        <option value="2" <?php if($content->status == 2) { echo  "selected='selected'"; } ?>>De-Active</option>
        </select>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" name="submit" class="btn btn-primary" value="Add Attribute"></td>
  </tr>
</table>
</form>