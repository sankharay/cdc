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
                            <td>File Name</td>
                            <td><?php echo $filename->filename; ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" class="btn btn-primary" value="Process File" onclick="return aprocessmagentodata('<?php echo BASE_URL; ?>',<?php echo $this->uri->segment(3); ?>);" /></td>
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

		<script>
function aprocessmagentodata(url,file){
	// $('#s'+id).htmlarea('updateHtmlArea','');
	$("#waiting").removeClass("waiting");
	$("#waiting").addClass("waitings");
	var fileid=file;
	if(fileid == "")
	exit;
	$.ajax({
		  type: "GET",
		  url: url+"/magentoquantity/updateapiinventrytable/"+fileid,
		}).done(function( msg ) {
		 alert( "Data Send: " + msg );
		 if(msg){
			alert("Data send to magento")
			$("#updating").hide();
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
			
		}
		else
		{
			alert("Data Updated in Magento");
			$("#waiting").removeClass("waitings");
			$("#waiting").addClass("waiting");
		}		 
		});
}

</script>