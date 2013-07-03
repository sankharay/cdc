<?php
include("dbw.php");
include("functions.php");
$value = "";
$pid = $_GET['pid'];
$addons = $_GET['addons'];
$fpl_id = $_GET['fpl_id'];
$data = explode('_',$addons);
$pos = array_search($pid, $data);
unset($data[$pos]);
$sizeofdata = sizeof($data);
for($i=0;$i<$sizeofdata-1;$i++)
$value.= $data[$i]."_";
mysql_query("UPDATE finalproductlist SET addons='$value' where fpl_id=$fpl_id");
?>
<script>
location.reload();
</script>