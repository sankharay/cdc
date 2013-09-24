<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div style="height:350px; width:500px;">
<?php
foreach($userdata as $row)
{
?>
<table width="100%" border="1" cellpadding="5" cellspacing="5">
  <tr>
    <td width="40%"><h4>First Name</h4></td>
    <td width="60%"><input type="text" name="fName" value="<?php echo $row->fname; ?>" id="fName" /> </td>
  </tr>
  <tr>
    <td width="40%"><strong>Last Name</strong></td>
    <td><input type="text" name="lName" value="<?php echo $row->lname; ?>" id="lName" /></td>
  </tr>
  <tr>
    <td><h4>User Name</h4></td>
    <td><input type="text" value="<?php echo $row->username; ?>" readonly="readonly" name="uName" id="uName" /></td>
  </tr>
  <tr>
    <td><h4>Password</h4></td>
    <td><input type="password" value="" name="pass" id="pass" /></td>
  </tr>
  <tr>
    <td><h4>Email Adress</h4></td>
    <td><input type="text" value="<?php echo $row->email; ?>"  name="email" id="email" required="required" /></td>
  </tr>
  <tr>
    <td><h4>Access Level</h4></td>
    <td>
    						<select name="aLevel" id="aLevel" required>
                            <option value="">Please select Access Level</option>
                            <?php if($this->session->userdata('accesslevel') == 1)
							{
							?>
                            <option value="1">Adminstrator</option>
                            <?php
							}
							?>
                            <option value="2"<?php if($row->access_level == 2) { echo "selected='selected'";  } ?>>Manager</option>
                            <option value="3"<?php if($row->access_level == 3) { echo "selected='selected'";  } ?>>User</option>
                            <option value="4"<?php if($row->access_level == 4) { echo "selected='selected'";  } ?>>Other Company</option>
                            </select>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input onclick="return updateuser(<?php echo $this->uri->segment(3); ?>);" type="button" class="btn btn-primary" value="Edit User" /></td>
  </tr>
</table>
<div id="notify"></div>
<?php
}
?>
</div>
</body>
</html>