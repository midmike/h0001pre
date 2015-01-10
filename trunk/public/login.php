<!-- 	<head> -->
<!-- 		<meta charset="utf-8" http-equiv="refresh"> -->
<!-- 		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
<!-- 		<meta name="description" content="Sentir, Responsive admin and dashboard UI kits template"> -->
<!-- 		<meta name="keywords" content="admin,bootstrap,template,responsive admin,dashboard template,web apps template"> -->
<!-- 		<meta name="author" content="Ari Rusmanto, Isoh Design Studio, Warung Themes"> -->

<title><?php echo SITE_TITLE;?> - <?php i18n::getLabel("message.user.titile.login");?></title>

<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
<!-- 		<link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->

<!-- PLUGINS CSS -->
<!-- 		<link href="assets/plugins/prettify/prettify.min.css" rel="stylesheet"> -->
<!-- 		<link href="assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet"> -->
<!-- 		<link href="assets/plugins/owl-carousel/owl.theme.min.css" rel="stylesheet"> -->
<!-- 		<link href="assets/plugins/owl-carousel/owl.transitions.min.css" rel="stylesheet"> -->
<!-- 		<link href="assets/plugins/icheck/skins/all.css" rel="stylesheet"> -->
<!-- 		<link href="assets/plugins/chosen/chosen.min.css" rel="stylesheet"> -->


<!-- MAIN CSS (REQUIRED ALL PAGE)-->
<!-- 		<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
<!-- 		<link href="assets/css/style.css" rel="stylesheet"> -->
<!-- 		<link href="assets/css/style-responsive.css" rel="stylesheet"> -->
<!-- 	</head> -->
<?php require_once 'public/masterPages/head.php';?>
<?php
$message = "";
$style = "";
if (! isset ( $_POST [User::LOGIN_EVENT] )) {
	$style = "style='display:none;'";
} else {
	if ($_POST [User::LOGIN_EVENT] == User::LOGIN_FAIL) {
		$message = i18n::getLabelWithoutWrite ( "message.user.login.fail" );
	} else if ($_POST [User::LOGIN_EVENT] == User::LOGIN_NO_PASSWORD) {
		$message = "no password";
	} else if ($_POST [User::LOGIN_EVENT] == User::LOGIN_NO_USERNAME) {
		$message = "no Username";
	}
	$message = $_POST [User::LOGIN_EVENT];
	$style = "style='display:block;'";
}
?>
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
		<div id="warning"  <?php echo $style ?>
			class="alert alert-warning alert-bold-border fade in alert-dismissable">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">&times;</button>
			<strong><?php i18n::getLabel("warning");?></strong> <?php echo $message?>

			</div>
		<form role="form" action="controls/UserControl.php?login"
			method="post">
			<div class="form-group has-feedback lg left-feedback no-label">
				<input name="username" type="text"
					class="form-control no-border input-lg rounded"
					placeholder="<?php i18n::getLabel("message.user.login.enter.username");?>"
					autofocus> <span class="fa fa-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback lg left-feedback no-label">
				<input name="password" type="password"
					class="form-control no-border input-lg rounded"
					placeholder="<?php i18n::getLabel("message.user.login.enter.password");?>">
				<span class="fa fa-unlock-alt form-control-feedback"></span>
			</div>
			<div class="form-group">
				<div class="checkbox">
					<label> <input type="checkbox" name="rememberme" value="true"
						class="i-yellow-flat"><?php i18n::getLabel("message.user.login.remember.me");?>
					</label>
				</div>
			</div>
			<div class="form-group">
				<button type="submit"
					class="btn btn-warning btn-lg btn-perspective btn-block"><?php i18n::getLabel("login");?></button>
			</div>
		</form>
		<p class="text-center">
			<strong><a href="controls/site.php?switchLang=kh" target="_self">change to khmer</a></strong>
		</p>
		<p class="text-center">
			<strong><a href="controls/site.php?switchLang=en" target="_self">change to english</a></strong>
		</p>
	</div>
	<!-- /.login-wrapper -->
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