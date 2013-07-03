<form action="<?php echo BASE_URL; ?>/disclaimermanagement/disedit/<?php echo $this->uri->segment(3); ?>" method="post">
<table width="400" height="300" border="0">
  <tr>
    <td><strong>Disclaimer Name</strong></td>
    <td><?php echo $content->name; ?></td>
  </tr>
  <tr>
    <td><strong>English</strong></td>
    <td><?php echo $content->english; ?></td>
  </tr>
  <tr>
    <td><strong>Spanish</strong></td>
    <td><?php echo $content->spanish; ?></td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>
    <?php echo $this->log->active_status($content->status); ?>
    </td>
  </tr>
  <tr>
  <td>&nbsp;
  </td>
  <td>
  <input type="submit" name="submit" value=" Delete " class="btn btn-primary">
  </td>
  </tr>
</table>
</form>