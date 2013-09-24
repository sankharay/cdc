<form action="<?php echo BASE_URL; ?>/disclaimermanagement/disedit/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="100%" border="0">
  <tr>
    <td>Disclaimer Name</td>
    <td><input type="text" name="name" required value="<?php echo $content->name; ?>"></td>
  </tr>
  <tr>
    <td>English</td>
    <td><textarea rows="5" cols="30" required name="english"><?php echo $content->english; ?></textarea></td>
  </tr>
  <tr>
    <td>Spanish</td>
    <td><textarea rows="5" cols="30" required name="spanish"><?php echo $content->spanish; ?></textarea></td>
  </tr>
  <tr>
    <td>Status</td>
    <td>
    <select name="status" required>
    <option value="">Please select status</option>
    <option value="1" <?php if($content->status == 1 ) { echo "selected='selected'";  } ?> >Active</option>
    <option value="2"<?php if($content->status == 2 ) { echo "selected='selected'";  } ?> >De-Active</option>
    </select>
    </td>
  </tr>
  <tr>
  <td>&nbsp;
  </td>
  <td>
  <input type="submit" name="submit" value=" Edit " class="btn btn-primary">
  </td>
  </tr>
</table>
</form>