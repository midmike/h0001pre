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