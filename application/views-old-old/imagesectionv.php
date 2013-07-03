<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo BASE_URL; ?>">Home</a> 
                        
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<?php
				if($this->session->userdata('update'))
				{
					?>
                    <div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							
							<p><?php echo $this->session->userdata('update');$this->session->unset_userdata('update'); ?></p>
						</div>
                    <?php
				}
				?>
			  <div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Upload Images</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
				  <div class="box-content">
                    <table class="table table-striped table-bordered ">
						   
						  <tbody>
							  <tr>
								  <td>File</td>
								  <td>
                                  

    <?php echo form_open_multipart('');?>

<input type="file" name="userfile" size="20" required="required" pattern="jpg,gif,png only" /><input type="hidden" name="userfiles" value="123"  />
</td>
							  </tr>
							  <tr>
							    <td>&nbsp;</td>
<td>
<select name="imagelang" required="required">
<option value="">Select Language</option>
<option value="3">All Languages</option>
<option value="1">English</option>
<option value="2">Spanish</option>
</select>
</td>
						    </tr>
							  <tr>
							    <td>&nbsp;</td>
<td>
<input type="text" name="imgposition" required="required numeric" placeholder="Please enter only numeric data" pattern="[-+]?[0-9]?[0-9]+" />
</td>
						    </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td><input type="submit" name="submit" class="btn btn-primary" value="Upload" /></td>
						    </tr>
                              </tbody>
                              </table>
				</div>
                
			</div>
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Manage Images</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
				  <div class="box-content">
                    <div class="advancesearchdata">
                    <a  onclick="return getvendorscontent('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>,'<?php echo $this->uri->segment(4); ?>','<?php echo $this->uri->segment(5); ?>');"><input type="button" class="btn btn-mini btn-primary" value="Get Vendor Images"></a>&nbsp;&nbsp;<a href="<?php echo BASE_URL; ?>/productpreview/index.php?fpl_id=<?php echo $this->uri->segment(3); ?>" target="_blank"><button class="btn btn-mini btn-primary" id="finalproductview">Final Preview</button></a>&nbsp;&nbsp;
                    <button class="btn btn-mini btn-primary" id="asearch">Advance Search</button></div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
                        
                          
						  <thead>
							  <tr>
								  <th width="47">Source</th>
								  <th width="67">Source Image</th>
								  <th width="67">Resized Image</th>
								  <th width="32">Cropped Image</th>
								  <th width="33">Image Lang. / Pos.</th>
								  <th width="55">Product SKU</th>
								  <th width="55">Product UPC</th>
							    <th width="51">Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  if($content)
						  {
						  foreach($content as $value)
						  {
$product_details = $this->imagesectionm->get_content_englishtables($value->finalproductlist_fpl_id);
							  ?>
							  
							<tr>
				<td><?php echo $this->imagesectionm->getvendorname($product_details->product_source); ?></td>
								<td>
<a class="cboxElement" href="<?php echo PLUGINS_WEB_URL; ?>/cropping/images/<?php echo $value->img_name; ?>"><img src="<?php echo PLUGINS_WEB_URL; ?>/cropping/images/<?php echo $value->img_name; ?>" width="50px" height="50px" /></a>
<?php
$url = PLUGINS_WEB_URL."/cropping/images/".$value->img_name;
$details  = getimagesize($url);
echo "<br>".$details['3'];
?>
  
<button onclick="return myPopup2('<?php echo PLUGINS_WEB_URL; ?>/cropping/crop.php?type=1&imgid=<?php echo $value->img_id; ?>&img=<?php echo $value->img_name; ?>')" class="btn btn-mini btn-primary">Crop Source</button>                              
</td>
				<td>
				<a class="cboxElement" href="<?php echo PLUGINS_WEB_URL; ?>/cropping/autoresizeimages/<?php echo $value->img_name; ?>"><img src="<?php echo PLUGINS_WEB_URL; ?>/cropping/autoresizeimages/<?php echo $value->img_name; ?>" width="50px" height="50px" /></a>
<?php
$url = PLUGINS_WEB_URL."/cropping/autoresizeimages/".$value->img_name;
$details  = getimagesize($url);
echo "<br>".$details['3'];
?>
<button onclick="return myPopup2('<?php echo PLUGINS_WEB_URL; ?>/cropping/crop.php?type=2&imgid=<?php echo $value->img_id; ?>&img=<?php echo $value->img_name; ?>')" class="btn btn-mini btn-primary">Crop Resized Image</button>
                </td>
<td class="center"><?php 
if($value->fileplacement == 2)
{
 ?>
 <a class="cboxElement" href="<?php echo PLUGINS_WEB_URL; ?>/cropping/resize/<?php echo $value->img_name; ?>">
 <img src="<?php echo PLUGINS_WEB_URL; ?>/cropping/resize/<?php echo $value->img_name; ?>" width="50px" height="50px" /></a>
 <?php
}
else
{
echo "Image cropping pending";
}
?>
 </td>
<td class="center"><?php echo $this->imagesectionm->imagelang($value->image_lanauage); ?> / <?php echo $value->image_position; ?> </td>
<td class="center"><?php echo $product_details->product_sku; ?></td>
								<td class="center">
  <?php echo $product_details->product_upc; ?>
							    </td>
								<td class="center">
<a href="<?php echo BASE_URL; ?>/imagesection/imgedit/<?php echo $value->img_id; ?>/<?php echo $this->uri->segment(3); ?>" class="cboxElement"><button class="btn btn-mini btn-primary">Edit</button></a>&nbsp;
<button class="btn btn-mini btn-primary" onclick="return delimg('<?php echo BASE_URL; ?>','<?php echo $value->img_id; ?>');">Delete </button>
								</td>
							</tr>
							
							  <?php
						  }
						  }
						  ?>
						  </tbody>
                          <tfoot>
<tr>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Source" name="search_platform">
	  </th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search image Name" name="search_images">
	</th>
	<th rowspan="1" colspan="1">
		<input type="hidden" class="search_init" value="Search SKU" name="search_sku">
	</th>
	<th rowspan="1">
	  <input type="hidden" class="search_init" value="Search UPC" name="search_upc">
	  </th>
	<th rowspan="1">&nbsp;</th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search SKU" name="search_sorting">
	  </th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search UPC" name="search_sorting">
	  </th>
	<th rowspan="1" colspan="1">
	  <input type="text" class="search_init" value="Search Source" name="search_sorting" style="display:none;">
	  <a class="btn btn-info btn-setting" href="#">Pro. Ready</a>
      <div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Final Confirmation</h3>
			</div>
			<div class="modal-body">
				<p>Product ready to go</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancel</a>
				<a href="#" onclick="return confirmfinalproduct('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);" class="btn btn-primary">Save changes</a>
			</div>
		</div>
      </th>
</tr>
</tfoot>
					  </table>
					</div>
				</div>
                
                <!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
<div id="notify"></div>
		<hr>
<script type="text/javascript">
<!--
function myPopup2(url) {
window.open( url, "myWindow", "status = 1, height = 700, width = 800, resizable = 0" )
}
//-->
</script>
		