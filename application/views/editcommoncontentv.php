<form action="<?php echo BASE_URL; ?>/attributemanagement/editcommoncontent/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="100%" border="0" cellpadding="15" cellspacing="15">
  <tr>
    <td>Select Category</td>
    <td>
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
    <td>Meta Keywords</td>
    <td>
<textarea rows="5" cols="35" name="metakeywords" required><?php echo $content->metakeywords; ?></textarea>
</td>
  </tr>
  <tr>
    <td>Meta Description</td>
    <td>
<textarea rows="5" cols="35" name="metadescription" required><?php echo $content->metadescription; ?></textarea>
</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>
      <select name="status" required>
        <option value="">Please Select Status</option>
        <option value="1" <?php if($content->status == 1) { echo  "selected='selected'"; } ?>>Active</option>
        <option value="2" <?php if($content->status == 2) { echo  "selected='selected'"; } ?>>De-Active</option>
        </select>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" class="btn btn-primary" value="Add Attribute"></td>
  </tr>
</table>
</form>