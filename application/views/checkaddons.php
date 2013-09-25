<?php
if($content)
{
	?>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Product Name</th>
								  <th>Product SKU</th>
								  <th>Product UPC</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
<?php
$productid = explode('_',$content);
$productids = array_filter($productid);
$productids = array_unique(array_slice($productids, 0));
$numproducts = sizeof($productids);
for($i=0;$i<$numproducts;$i++)
{
$data = $this->addonmanagementm->productdetailing($productids[$i]);
?>
<tr>
        <td><?php echo $data->productname; ?></td>
        <td class="center"><?php echo $data->productsku; ?></td>
        <td class="center">
        <?php echo $data->productupc; ?>
        </td>
        <td class="center">
<li class="icon icon-color icon-trash" onClick="return deladon('<?php echo $fplid; ?>','<?php echo $content; ?>','<?php echo $productid[$i]; ?>');"></li>
        </td>
    </tr>
<?php
}
?>
						  </tbody>
					  </table>
                      <?php
}
else
{
echo "NO ADDON ADDED";	
}
?>
<div id="notify"></div>
<script>
function deladon(fpl_id,addons,pid)
{
	$('#notify').load('<?php echo PLUGINS_WEB_URL; ?>/categorytree/delproducts.php?pid='+pid+'&addons='+addons+'&fpl_id='+fpl_id);
	return false;
}
</script>