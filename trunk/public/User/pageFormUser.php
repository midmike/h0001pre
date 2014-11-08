<html>
	<body>
		<div class="row">
			<div class="col-sm-8">
				<div class="the-box">
					<h4 class="small-title">SIGN UP</h4>
					<form id="FormExample1" method="post" class="form-horizontal" action="http://diliat.in/themeforest/sentir/1.0.0/target.php"
						  data-bv-message="This value is not valid"
						  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
						  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
						  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
						<div class="form-group">
							<label class="col-lg-3 control-label">Full name</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="firstName" placeholder="First name" required data-bv-notempty-message="The first name is required and cannot be empty" />
							</div>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="lastName" placeholder="Last name" required data-bv-notempty-message="The last name is required and cannot be empty" />
							</div>
						</div>
		
						<div class="form-group">
							<label class="col-lg-3 control-label">Username</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" name="username"
									   data-bv-message="The username is not valid"
									   required data-bv-notempty-message="The username is required and cannot be empty"
									   pattern="[a-zA-Z0-9_\.]+" data-bv-regexp-message="The username can only consist of alphabetical, number, dot and underscore"
									   data-bv-stringlength="true" data-bv-stringlength-min="6" data-bv-stringlength-max="30" data-bv-stringlength-message="The username must be more than 6 and less than 30 characters long"
									   data-bv-different="true" data-bv-different-field="password" data-bv-different-message="The username and password cannot be the same as each other"
									   data-bv-remote="true" data-bv-remote-url="remote.php" data-bv-remote-message="The username is not available"
										/>
							</div>
						</div>
		
						<div class="form-group">
							<label class="col-lg-3 control-label">Address</label>
							<div class="col-lg-5">
								<input class="form-control" name="address" type="email" data-bv-emailaddress-message="The input is not a valid email address" />
							</div>
						</div>
						
						<div class="form-group has-feedback has-success">
							<label class="col-lg-3 control-label">Phone number</label>
							<div class="col-lg-5">
								<input data-bv-field="phone" class="form-control" name="phoneNumber" type="text"><i data-bv-field="phoneNumber" class="form-control-feedback glyphicon glyphicon-ok" style="display: block;"></i>
							<small class="help-block" data-bv-validator="digits" style="display: none;">The value can contain only digits</small></div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Password</label>
							<div class="col-lg-5">
								<input type="password" class="form-control" name="password"
									   required data-bv-notempty-message="The password is required and cannot be empty"
									   data-bv-identical="true" data-bv-identical-field="confirmPassword" data-bv-identical-message="The password and its confirm are not the same"
									   data-bv-different="true" data-bv-different-field="username" data-bv-different-message="The password cannot be the same as username"/>
							</div>
						</div>
		
						<div class="form-group">
							<label class="col-lg-3 control-label">Retype password</label>
							<div class="col-lg-5">
								<input type="password" class="form-control" name="confirmPassword"
									   required data-bv-notempty-message="The confirm password is required and cannot be empty"
									   data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="The password and its confirm are not the same"
									   data-bv-different="true" data-bv-different-field="username" data-bv-different-message="The password cannot be the same as username"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Birthday</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" name="birthday" data-bv-date="false" data-bv-date-format="YYYY/MM/DD" data-bv-date-message="The birthday is not valid" /> (YYYY/MM/DD)
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<button type="submit" class="btn btn-primary">Sign up</button>
							</div>
						</div>
					</form>
				</div><!-- /.the-box -->
			</div><!-- /.col-sm-8 -->
	</body>
</html>