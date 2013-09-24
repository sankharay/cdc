<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Icuracao - Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Icuracao">
	<meta name="author" content="Icuracao">

	<!-- The styles -->
	<link id="bs-css" href="<?php echo BASE_URL; ?>/css/bootstrap-cerulean.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>/css/charisma-app.css" rel="stylesheet">
	<link href='<?php echo BASE_URL; ?>/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo BASE_URL; ?>/css/jquery.iphone.toggle.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/img/favicon.ico">
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome to iCuracao</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					
                        <?php if($this->session->userdata('error')){ ?>
                        <div class="alert alert-error">
							<button data-dismiss="alert" class="close" type="button">×</button>
							<?php
							echo $this->session->userdata('error');
							$this->session->unset_userdata('error');
							?>
						</div>
                        <?php }else{ ?>
                        <div class="alert alert-info">
                        Please login with your Username and Password.
                        </div>
                        <?php } ?>
					
					<form class="form-horizontal" action="<?php echo BASE_URL; ?>/login/chklogin" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							
							<div class="clearfix"></div>
							
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="js/jquery-1.7.2.min.js"></script>
	
		
</body>
</html>