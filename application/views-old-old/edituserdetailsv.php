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
    <td><?php $ac = explode(',',$row->access_level); ?>
    <input type="checkbox" name="aLevel" id="aLevel" value="1" <?php if(in_array('1',$ac)) { echo "checked='checked'";  } ?> > Upload Data <input value="2" type="checkbox" name="aLevel[]" id="aLevel" <?php if(in_array('2',$ac)) { echo "checked='checked'";  } ?>> Search Data <input value="3" type="checkbox" name="aLevel" id="aLevel" <?php if(in_array('3',$ac)) { echo "checked='checked'";  } ?>> Process Data <input value="4" type="checkbox" name="aLevel" id="aLevel" <?php if(in_array('4',$ac)) { echo "checked='checked'";  } ?>> Translate Data <input value="5" type="checkbox" name="aLevel" id="aLevel" <?php if(in_array('5',$ac)) { echo "checked='checked'";  } ?>> Push Data To Magento <input value="6" type="checkbox" name="aLevel" id="aLevel" <?php if(in_array('6',$ac)) { echo "checked='checked'";  } ?>>
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