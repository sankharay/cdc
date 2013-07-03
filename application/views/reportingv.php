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
						<h2><i class="icon-list-alt"></i> Add New User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table width="100%" border="0">
  <tr>
    <td>User</td>
    <td>
	<?php
		if(isset($users))
		{
    	$select = "<select id='user' name='user' required>";
		foreach($users as $value)
		{
		$select.="<option value='".$value->user_id."'>";
		$select.=$value->fname." ".$value->lname;
		$select.="</option>";
		}
		$select.="</select>";
		}
		echo $select;
	?>
    </td>
  </tr>
  <tr>
    <td>From Date</td>
    <td><input type="date" name="fromDate" id="fromDate" class="datepicker"  required="required" /></td>
  </tr>
  <tr>
    <td>To Date</td>
    <td><input type="date" name="toDate" id="toDate" class="datepicker"  required="required" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="sumit" id="sumit" class="btn btn-primary"  required="required" onclick="return get_report('<?php echo BASE_URL; ?>');" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="notify"></div></td>
    </tr>
</table>

					</div>
				</div>
			</div><!--/row-->
			
			<div class="row-fluid sortable"></div><!--/row-->
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		