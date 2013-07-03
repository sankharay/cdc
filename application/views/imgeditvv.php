<form action="<?php echo BASE_URL; ?>/addcontent/imgedit/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" method="post">
<table class="table table-striped table-bordered ">
						   
						  <tbody>
							  <tr>
							    <td>Language</td>
<td>
<select name="imagelang" required="required">
<option value="">Select Language</option>
<option value="3" <?php if($content->image_lanauage == 3) { echo "selected='selected'"; } ?>>All Languages</option>
<option value="1" <?php if($content->image_lanauage == 1) { echo "selected='selected'"; } ?>>English</option>
<option value="2" <?php if($content->image_lanauage == 2) { echo "selected='selected'"; } ?>>Spanish</option>
</select>
</td>
						    </tr>
							  <tr>
							    <td>Image Irder</td>
<td>
<input type="text" value="<?php echo $content->image_position; ?>"  name="imgposition" required placeholder="Please enter only numeric data" pattern="[-+]?[0-9]?[0-9]+" />
</td>
						    </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td><input type="submit" name="submit" class="btn btn-primary" value="Update" /></td>
						    </tr>
                              </tbody>
                              </table>
                              </form>