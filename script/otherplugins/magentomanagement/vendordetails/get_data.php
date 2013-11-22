<?php
	ini_set('max_execution_time', 3000);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include('dbw_magento.php');
	$orderid = $_GET['orderid'];
	if($orderid == "")
	exit;
	$getcomments = mysql_query("SELECT * FROM  `sales_flat_order` WHERE  `increment_id`='$orderid'") or die(mysql_error());
	if(mysql_num_rows($getcomments) > 0 )
	{
		$getcontent = mysql_fetch_object($getcomments);
		$entityid = $getcontent->entity_id;
		// start getting comment
		$commentdata = mysql_query("SELECT * FROM  `sales_flat_order_status_history` WHERE  `parent_id` ='$entityid' ORDER BY `created_at` DESC ");
		echo "<table width='100%' border='0'><tr><td>Status</td><td>Comments</td><td>Comment Date</td></tr>";
		while($commentrow = mysql_fetch_object($commentdata))
		{
			?>
<tr>
           <td><?php echo $commentrow->status; ?></td>
    <td><?php 
	if($commentrow->comment == "")
	echo "No Comment";
	else
	echo 
	$commentrow->comment; ?></td>
    <td><?php echo $commentrow->created_at; ?></td>
  </tr>
            <?php
		}
		echo "</table>";
		// end getting comment
	}
?>