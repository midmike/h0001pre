	<head>
		<meta charset="utf-8">
		<?php require_once 'public/require_meta.php';?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Sentir, Responsive admin and dashboard UI kits template">
		<meta name="keywords" content="admin,bootstrap,template,responsive admin,dashboard template,web apps template">
		<meta name="author" content="Ari Rusmanto, Isoh Design Studio, Warung Themes">
		<title><?php echo SITE_TITLE;?> - <?php i18n::getLabel("message.user.titile.register");?></title>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- PLUGINS CSS -->
		<link href="assets/plugins/prettify/prettify.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.theme.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.transitions.min.css" rel="stylesheet">
		<link href="assets/plugins/icheck/skins/all.css" rel="stylesheet">
		<link href="assets/plugins/chosen/chosen.min.css" rel="stylesheet">


		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/style-responsive.css" rel="stylesheet">
	</head>
 
	<body class="login tooltips">

		
		
		
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="login-header text-center">
			<img src="assets/img/logo-login.png" class="logo" alt="Logo">
		</div>
		<div class="login-wrapper">
			<form role="form" method="post" action="controls/UserControl.php?Create">
				<div class="form-group has-feedback lg left-feedback no-label">
				  <input name="name" type="text" class="form-control no-border input-lg rounded" placeholder="<?php i18n::getLabel("message.user.register.fullname");?>" autofocus>
				  <span class="fa fa-male form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback lg left-feedback no-label">
				  <input  name="username" type="text" class="form-control no-border input-lg rounded" placeholder="<?php i18n::getLabel("message.user.register.username");?>">
				  <span class="fa fa-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback lg left-feedback no-label">
				  <textarea name="address" class="form-control no-border input-lg rounded" placeholder="<?php i18n::getLabel("message.user.register.address");?>"></textarea>
				  <span class="fa fa-home form-control-feedback"></span>
				</div>
                <div class="form-group has-feedback lg left-feedback no-label">
				  <input name="phone" type="text" class="form-control no-border input-lg rounded" placeholder="<?php i18n::getLabel("message.user.register.phone");?>">
				  <span class="fa fa-mobile-phone form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback lg left-feedback no-label">
				  <input name="password" type="password" class="form-control no-border input-lg rounded" placeholder="<?php i18n::getLabel("message.user.register.password");?>">
				  <span class="fa fa-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback lg left-feedback no-label">
				  <input name="confirm-password" type="password" class="form-control no-border input-lg rounded" placeholder="<?php i18n::getLabel("message.user.register.confirmpassword");?>">
				  <span class="fa fa-unlock form-control-feedback"></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block"><?php i18n::getLabel("message.user.titile.register");?></button>
					<button onclick="" class="btn btn-danger btn-lg btn-perspective btn-block"><?php i18n::getLabel("cancel");?></button>
				</div>
			</form>
		</div><!-- /.login-wrapper -->
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->

		<!--
		===========================================================
		Placed at the end of the document so the pages load faster
		===========================================================
		-->
		<!-- MAIN JAVASRCIPT (REQUIRED ALL PAGE)-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/plugins/retina/retina.min.js"></script>
		<script src="assets/plugins/nicescroll/jquery.nicescroll.js"></script>
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>

        <!-- PLUGINS -->
		<script src="assets/plugins/prettify/prettify.js"></script>
        <script src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="assets/plugins/icheck/icheck.min.js"></script>
		<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
		<script src="assets/plugins/mask/jquery.mask.min.js"></script>

		<!-- MAIN APPS JS -->
		<script src="assets/js/apps.js"></script>
		
	</body>