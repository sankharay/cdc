<?php

	include("dbw.php");
	
	$sql = 'select * from users where username = "'.$_POST['uname'].'"';
	$result = mysql_query($sql);
	echo mysql_num_rows($result);
	if(mysql_num_rows($result)>0){
		return 1;
	}else{
		return 0;
	}