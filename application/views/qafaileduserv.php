<table width="500px" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td><strong>Comment</strong></td>
  </tr>
  <tr>
    <td><select name="producterror" id="producterror" multiple="multiple" style="height:200px; width:500px;" class="chzn-done">
	<?php print_r($content); 
	foreach($content as $value)
	{
		?>
        <option value="<?php echo $value->header; ?>"><?php echo $value->header; ?></option>
        <?php
	}	
	?>
    </select></td>
  </tr>
  <tr>
    <td><textarea rows="5" style="width:500px;" name="qafailedComments" id="qafailedComments"></textarea></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" class="btn btn-primary" value=" Submit " onclick="return qafaileduserj('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);"></td>
  </tr>
</table>