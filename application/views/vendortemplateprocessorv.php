<style>
table
{
	font-family:"Arial", Gadget, sans-serif;
	font-size:12px;
}
</style>
<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
<form action="" method="post">
<table width="500px" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td><strong>Select Database Structure</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Excel File Fields</strong></td>
    <td><strong>Database Fields</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td valign="top">
  <?php 
  echo $header;
   ?>
  </td>
  <td valign="top">
  <table width="200" border="0" cellpadding="4" cellspacing="5">
  <?php
		for($i=0 ; $i < $numcolumns ; $i++)
		{
		   ?>
  <tr>
    <td><?php echo $fields; ?></td>
    <td><input type="checkbox" name="skip[]" value="<?php echo $i; ?>" /></td>
  </tr>
  <?php
		}
		?>
        </table>
        </td>
  <td valign="top"><!-- <table width="200" border="0" cellpadding="5" cellspacing="5">
  <?php
		for($i=0 ; $i < $numcolumns ; $i++)
		{
		   ?>
  <tr>
    <td><input type="checkbox" name="skip[]" value="<?php echo $i; ?>" /></td>
  </tr>
  <?php
		}
		?>
        </table>--></td>
  </tr> 
  <tr>
    <td colspan="3" align="center"><input type="submit" name="submit" value="Process Data" /></td>
  </tr>      
</table>
</form>
<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>