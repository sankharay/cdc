<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
foreach($userdata as $row)
{
?>
<table width="100%" border="1">
  <tr>
    <td width="40%"><h4>Full Name</h4></td>
    <td width="60%"><?php echo $row->fname; ?> <?php echo $row->lname; ?></td>
  </tr>
  <tr>
    <td><h4>User Name</h4></td>
    <td><?php echo $row->username; ?></td>
  </tr>
  <tr>
    <td><h4>Email Adress</h4></td>
    <td><?php echo $row->email; ?></td>
  </tr>
  <tr>
    <td><h4>Access Level</h4></td>
    <td><?php echo $this->usermanagement->access_level($row->access_level); ?></td>
  </tr>
</table>
<?php
}
?>
</body>
</html>