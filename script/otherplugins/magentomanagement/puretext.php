<?php
	set_time_limit(0);
include("../dbw.php");
$contents = mysql_query("select * from direct_mosse_products");
while($content = mysql_fetch_object($contents))
{
echo $content->Size;
echo "<br>";
}
?>