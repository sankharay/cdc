<footer>
			<p class="pull-left">&copy; <a href="http://icurocao.com/" target="_blank">iCuracao</a> 2013</p>
			<p class="pull-right">Powered by: <a href="http://icurocao.com/">iCuracao</a></p>
		</footer>
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="<?php echo BASE_URL; ?>/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo BASE_URL; ?>/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo BASE_URL; ?>/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo BASE_URL; ?>/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo BASE_URL; ?>/js/jquery.dataTables.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo BASE_URL; ?>/js/ColumnFilterWidgets.js'></script>



	<!-- select or dropdown enhancer -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo BASE_URL; ?>/js/charisma.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo BASE_URL; ?>/js/custom.js"></script>

<script type="text/javascript" src="https://icuracao.atlassian.net/s/d41d8cd98f00b204e9800998ecf8427e/en_US-ylehnt-1988229788/6132/47/1.4.0-m5/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?collectorId=8005a122"></script>

<!-- validate form -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.validate.js"></script>
	<script>
$().ready(function() {
	$("#english-form").validate({
		ignore: "",
		rules: {
			pInventory: "required",
			pSku: "required",
			pcost: "required",
			pretail: "required",
			pmsrp: "required",
			pMAP: "required",
			pShipping: "required",
			pHeight: "required",
			pWidth: "required",
			pLength: "required",
			pWeight: "required"
		},
		messages: {
			pInventory: "Enter Product Inventory",
			pSku: "Enter Product Sku",
			pcost: "Enter Product Cost",
			pretail: "Enter Product Retail",
			pmsrp: "Enter Product MRSP",
			pMAP: "Enter Product MAP",
			pShipping: "Enter Product Shipping",
			pHeight: "Enter Product Height",
			pWidth: "Enter Product Width",
			pLength: "Enter Product Depth",
			pWeight: "Enter Product Weight"
		}
	});
	});
</script>
<style>
label.error
{
	position:fixed !important;
	z-index:100 !important;
	float:right !important;
	color:#FFFFFF !important;
	top: 20px;
	background:#F00;
	padding:5px;
    left: 10px;
	visibility: visible !important;
	display:block !important;
}
.myerror
{
	background:#F00 !important;
	color:#FFF !important;
}
.asterik
{
	color:#F00;
	font-size:10px;
	margin-left:10px;
}
</style>


<!-- end checkboxTree configuration -->



</body>
</html>