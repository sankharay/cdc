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
						<a href="#">Home</a> 
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> Process Your File</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table width="100%" border="0" cellpadding="5">
                          <tr>
                            <td width="19%">File Name</td>
                            <td width="23%"><?php 
							echo $filename->filename; ?>
                            </td>
                            <td width="17%">Select Vendor</td>
                            <td width="41%">
<?php
$select = "<select name='vname' id='vname' required onchange='getvendortem(this.value);'>";
$select.= "<option value=''>Please select Vendor</option>";
foreach($dropdown as $value)
{
$select.= "<option value=".$value->vmID.">".$value->vendorName."</option>";
}
$select.="</select>";
echo $select;
?></td>
<script language="javascript">
function getvendortem(id){
	if(id)
	{
	var fileid = <?php echo $this->uri->segment(3); ?>;
	$("#notify").html('<img src="images/loading.gif">');
	$("#notify").load('<?php echo BASE_URL; ?>/manageupdatevendor/getvendortemplates/'+id+'/'+fileid);
	return false;
	}
	else
	{
	alert("select vendor");
	}
}
</script>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td colspan="2" rowspan="3">
<div id="notify"></div>


                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" class="btn btn-primary" value="Process File" onclick="return processupdatemagentodata('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);" /></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                 </div>
				</div>
			</div><!--/row-->
<div id="resutingdata"></div>
<div id="waiting" class="waiting" ><img src="<?php echo BASE_URL; ?>/img/loader.gif" width="32" height="32" /></div>

			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
		<script type="text/javascript">
function myPopup1(file,vendorid) {
window.open( "<?php echo BASE_URL; ?>/vendorupdateprocessor/?file="+file+"&vendorid="+vendorid, "myWindow", 
"status = 1, height = 600, width = 800,resizable=yes,scrollbars=yes" )
}
function processupdatemagentodata(urll,file)
			{
            var fileid=file;
var selected = $("#notify input[type='radio']:checked");
if (selected.length > 0)
{
    var templateid = selected.val();

}
else
{
alert("template selection important");
}
			var vendorid = $('#vname').val();
			if(file != "0")
			{
			$("#waiting").removeClass("waiting");
			$("#waiting").addClass("waitings");
            $.ajax({
                type: 'GET',
                url: urll+'/manageupdatevendor/apiaccess/'+fileid+'/'+templateid+'/'+vendorid,
                success: function(data) {
                $('#resutingdata').html(data);
				$("#waiting").removeClass("waitings");
				$("#waiting").addClass("waiting");
          }
        });
			}
		  else
		  {
			alert("You need to select vendor and user");  
		  }
			}
</script>