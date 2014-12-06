<?php 
	$page = CREATE;
	$user = new User();
	$edit = false;
	if( $_GET[VIEW] == EDIT) {
		$edit = true;
		$user = SessionHandlers::getObjSession('edit_user');
		//SessionHandlers::destroySession('edit_user');
		$page = EDIT;
	}
?>
<div class="container-fluid">
	<h1 class="page-heading"><?php i18n::getLabel("message.user.manageuser.title");?></h1>
	<div class="the-box rounded">
		<form id="UserForm" method="post" class="form-horizontal"
			action="controls/UserControl.php?<?php echo $page;?>"
			data-bv-message="This value is not valid"
			data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
			data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
			data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
			<input type="hidden" name="id" value="<?php echo $user->getId();?>"/>
			<div class="form-group">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.register.fullname");?></label>
				<div class="col-lg-5">
					<input type="text" class="form-control" name="name"
						placeholder="<?php i18n::getLabel("message.user.register.fullname");?>" required
						value='<?php echo $user->getName(); ?>'
						data-bv-notempty-message="<?php i18n::getLabel("message.user.manageuser.datanotempty");?>" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.manageuser.table.status");?></label>
				<div class="col-lg-5">
					<?php
					Tool::printSelectOption("status",$user->getStatusValues(),$user->getStatusTexts(),$user->getStatus());?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.register.address");?></label>
				<div class="col-lg-5">
					<input class="form-control" name="address" required placeholder="<?php i18n::getLabel("message.user.register.address");?>"
						value="<?php echo $user->getAddress();?>"
						data-bv-notempty-message="<?php i18n::getLabel("message.user.manageuser.datanotempty");?>"/>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.register.phone");?></label>
				<div class="col-lg-5">
					<input data-bv-field="phone" class="form-control phone_us_masking"
						value="<?php echo $user->getPhone();?>"
						name="phone" type="text" placeholder="<?php i18n::getLabel("message.user.register.phone");?>"
						data-bv-field="phoneNumber"
						><i class="form-control-feedback fa fa-phone"
						style="display: block;"></i>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.manageuser.table.username");?></label>
				<div class="col-lg-5">
					<input type="text" class="form-control" name="username"
						value="<?php echo $user->getUserName();?>"
						data-bv-message="The username is not valid" required
						data-bv-notempty-message="<?php i18n::getLabel("message.user.manageuser.datanotempty");?>"
						pattern="[a-zA-Z0-9_\.]+"
						data-bv-regexp-message="The username can only consist of alphabetical, number, dot and underscore"
						data-bv-stringlength-max="30"
						data-bv-stringlength-message="The username must be more than 6 and less than 30 characters long"
						data-bv-remote="true" data-bv-remote-url="controls/UserControl.php?UserNameValidate"
						data-bv-remote-message="The username is not available" 
						placeholder="<?php i18n::getLabel("message.user.register.username");?>"/>
						<!-- data-bv-different-message="The username and password cannot be the same as each other" -->
						<!-- data-bv-stringlength="true" data-bv-stringlength-min="6" -->
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.manageuser.password");?></label>
				<div class="col-lg-5">
					<input type="password" class="form-control" name="password"
						value="<?php if($edit) { echo $user->getPassword(); } ?>" required
						data-bv-notempty-message="<?php i18n::getLabel("message.user.manageuser.datanotempty");?>"
						data-bv-identical="true" data-bv-identical-field="confirmPassword"
						data-bv-identical-message="The password and its confirm are not the same"
						
						
						placeholder="<?php i18n::getLabel("message.user.register.password");?>"/>
						 <!-- data-bv-different-field="username" -->
						 <!-- data-bv-different="true" -->
						 <!-- data-bv-different-message="The password cannot be the same as username"  -->
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label"><?php i18n::getLabel("message.user.manageuser.confirm.password");?></label>
				<div class="col-lg-5">
					<input type="password" class="form-control" name="confirmPassword"
						required
						value="<?php if($edit) { echo $user->getPassword(); } ?>"
						data-bv-notempty-message="<?php i18n::getLabel("message.user.manageuser.datanotempty");?>"
						data-bv-identical="true" data-bv-identical-field="password"
						data-bv-different-message="The password cannot be the same as username" 
						placeholder="<?php i18n::getLabel("message.user.register.confirmpassword");?>"/>
						<!-- data-bv-identical-message="The password and its confirm are not the same"
						data-bv-different="true" data-bv-different-field="username" -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-3 control-label"></label>
				<div class="checkbox col-lg-5">
					<label class="">
					<?php 
					$checkedCache = "";
					if($edit) {
						if($user->getCache()==User::CACHE_HIDE) {
							$checkedCache = " checked ";
						}
					}?>
						<input type="checkbox" name="cache" value="<?php echo User::CACHE_HIDE;?>" 
							<?php  echo $checkedCache;?>/>
						<?php i18n::getLabel("message.user.manageuser.button.delete");?>
					</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-9 col-lg-offset-3">
					<button type="submit" class="btn btn-primary"><?php if($edit){ 
						echo "Edit";
					} else {
						echo "Create";
					}?></button>
					<a class="btn btn-warning" onclick="window.history.back()">Back</a>
				</div>
			</div>
		</form>
	</div>
	<!-- /.the-box -->
</div>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#UserForm').bootstrapValidator();
});
</script>