<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome <?php echo $this->session->userdata('fname'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">

	<!-- The styles -->
	<link  href="<?php echo BASE_URL; ?>/css/bootstrap-united.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo BASE_URL; ?>/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo BASE_URL; ?>/css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo BASE_URL; ?>/css/chosen.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/uploadify.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/custom.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo BASE_URL; ?>"> <img alt="icuracao" src="<?php echo BASE_URL; ?>/img/logo.png" /> </a>
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
				</div>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"><?php 
if($this->session->userdata('fname') == "")
// redirect(BASE_URL.'/logout');
echo $this->session->userdata('fname');echo " ".$this->session->userdata('lname'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<!-- <li><a href="#">Profile</a></li>
						<li class="divider"></li> -->
						<li><a href="<?php echo BASE_URL; ?>/logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li></li>
						<li>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/home"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
<?php
if($this->session->userdata('accesslevel') != 3 AND $this->session->userdata('accesslevel') != 4)
{
?>
						<li class="nav-header hidden-tablet">Product Section</li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/categorymanagement"><i class="icon-th-large"></i><span class="hidden-tablet">Category Management</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/attributemanagement"><i class="icon-th-large"></i><span class="hidden-tablet">Attribute Management</span></a></li>
<!--						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addonmanagement"><i class="icon-th-large"></i><span class="hidden-tablet">Addon Management</span></a></li>-->
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/attributemanagement/commoncontent"><i class="icon-th-large"></i><span class="hidden-tablet">Common Content</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/brandmanagement"><i class="icon-th-large"></i><span class="hidden-tablet">Brand Management</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/disclaimermanagement"><i class="icon-th-large"></i><span class="hidden-tablet">Disclaimer Management</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/finaproducts/getstagingproduct"><i class="icon-th-large"></i><span class="hidden-tablet">Staging Products</span></a></li>
<?php
}
?>
						<li class="nav-header hidden-tablet">Content Section</li>
<?php
if($this->session->userdata('accesslevel') != 3 AND $this->session->userdata('accesslevel') != 4)
{
	?>
                        <li><a class="ajax-link" href="<?php echo BASE_URL; ?>/crud/api"><i class="icon-search"></i><span class="hidden-tablet"> API Data</span></a></li>
                        <li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch/allcontent"><i class="icon-search"></i><span class="hidden-tablet"> All Data</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addproduct"><i class="icon-eye-open"></i><span class="hidden-tablet">Add Raw New Product</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addfinalproductdata"><i class="icon-eye-open"></i><span class="hidden-tablet">Add Final Products</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addfinalspanishdata"><i class="icon-eye-open"></i><span class="hidden-tablet">Add Spanish Data</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch"><i class="icon-search"></i><span class="hidden-tablet"> Raw Data</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addcontent/reviewcontent"><i class="icon-search"></i><span class="hidden-tablet">Data Pending Review</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addfinalspanishdata/reviewpending"><i class="icon-search"></i><span class="hidden-tablet">Spanish Data Pending Review</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/directmagento/"><i class="icon-search"></i><span class="hidden-tablet">Direct Magento Push</span></a></li>
<?php
}
if($this->session->userdata('accesslevel') == 3)
{
?>
						
<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch/pendingurgent/"><i class="icon-screenshot"></i><span class="hidden-tablet">Internal Data Pending</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch/inprocessing/"><i class="icon-screenshot"></i><span class="hidden-tablet">Data In Processing</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch/pending/"><i class="icon-screenshot"></i><span class="hidden-tablet">External Data Pending</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addfinalspanishdata/pendingz/"><i class="icon-screenshot"></i><span class="hidden-tablet">External Spanish Data Pending</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch/englishreadycontent/"><i class="icon-font"></i><span class="hidden-tablet">Spanish Translation</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/contentsearch/finalproductinqueue/"><i class="icon-picture"></i><span class="hidden-tablet">Product Images</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/finaproducts/"><i class="icon-globe"></i><span class="hidden-tablet">Add Related Products</span></a></li>
<!--						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/finaproducts/productnotification"><i class="icon-globe"></i><span class="hidden-tablet">Product Notification</span></a></li> -->
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addfinalspanishdata/finalz"><i class="icon-globe"></i><span class="hidden-tablet">Send Spanish to Magento</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/magentoediting"><i class="icon-globe"></i><span class="hidden-tablet">Magento Management</span></a></li>
<?php
if($this->session->userdata('user_id') == "49")
{
?> 
<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/finaproducts/getstagingproduct"><i class="icon-search"></i><span class="hidden-tablet">Staging Products</span></a></li>
                        <?php
}
}
?>
<?php
if($this->session->userdata('accesslevel') == 4)
{
?>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/crud/yourdata"><i class="icon-screenshot"></i><span class="hidden-tablet">New Assign Data</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addcontent/"><i class="icon-screenshot"></i><span class="hidden-tablet">Rejected Data</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/addcontent/addlistimageready/"><i class="icon-font"></i><span class="hidden-tablet">Add Images</span></a></li>
<?php
}
if($this->session->userdata('accesslevel') != 3 AND $this->session->userdata('accesslevel') != 4)
{
?>
						<li class="nav-header hidden-tablet">Vendor Management</li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/managevendor/viewvendors"><i class="icon-leaf"></i><span class="hidden-tablet">Manage Vendor</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/managevendor/vdbtemplate"><i class="icon-move"></i><span class="hidden-tablet">Set Vendor DB Template</span></a></li>
<?php
}
?>
<?php
if($this->session->userdata('accesslevel') != 3 AND $this->session->userdata('accesslevel') != 4)
{
?>
						<li class="nav-header hidden-tablet">User Management</li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/adduser/listusers"><i class="icon-tags"></i><span class="hidden-tablet">Manage Users</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/activity"><i class="icon-exclamation-sign"></i><span class="hidden-tablet">User Activities</span></a></li>
<!-- 						
<li><a class="ajax-link" href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet">Options</span></a></li>
						<li><a href="tour.html"><i class="icon-globe"></i><span class="hidden-tablet">New EDI</span></a></li>
						<li><a class="ajax-link" href="icon.html"><i class="icon-star"></i><span class="hidden-tablet">Vendor Management</span></a></li>
						<li><a href="error.html"><i class="icon-ban-circle"></i><span class="hidden-tablet">Category Management</span></a></li>
						<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet">KPIs</span></a></li>
						<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet">Apple KPIs</span></a></li>
                        -->
                        
						<li class="nav-header hidden-tablet">Reporting</li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/reporting/"><i class="icon-user"></i><span class="hidden-tablet">Generate Report</span></a></li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/systemupdates/"><i class="icon-user"></i><span class="hidden-tablet">System Updates</span></a></li>
<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/magentoquantity/"><i class="icon-user"></i><span class="hidden-tablet">Update Products</span></a></li>
<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/manageupdatevendor/vdbtemplate/"><i class="icon-user"></i><span class="hidden-tablet">Update from vendors</span></a></li>
<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/copyimages/"><i class="icon-user"></i><span class="hidden-tablet">Get Images</span></a></li>
<?php
}
?>
<?php
if($this->session->userdata('accesslevel') != 3 AND $this->session->userdata('accesslevel') != 4)
{
?>
<li class="nav-header hidden-tablet">Ordering</li>
						<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/orderstatus/index/"><i class="icon-user"></i><span class="hidden-tablet">Order Status</span></a></li>
<li><a class="ajax-link" href="<?php echo BASE_URL; ?>/crud/apiinventry"><i class="icon-search"></i><span class="hidden-tablet"> API Inventry</span></a></li>
<?php
}
?>

					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->