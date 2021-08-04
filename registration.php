<?php
include("inc/auth/header.php");
?>
	<section class="login common-img-bg">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<div class="row">
					<div class="col-sm-12">
						<div class="login-card card-block bg-white">

							<form action="" method="POST" class="md-float-material">
								<div class="text-center">
									<img src="admin/assets/images/logo-black.png" alt="logo">
								</div>
								<h3 class="text-center txt-primary">Create an account </h3>
								<div class="row">
									<div class="col-md-6">
										<div class="md-input-wrapper">
											<input type="text" name="fullname" class="md-form-control" required="">
											<label>Full Name</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="md-input-wrapper">
											<input type="text" name="username" class="md-form-control" required="">
											<label>User Name</label>
										</div>
									</div>
								</div>
								<div class="md-input-wrapper">
									<input type="email" name="email" class="md-form-control" required="required">
									<label>Email Address</label>
								</div>
								<div class="md-input-wrapper">
									<input type="password" name="password" class="md-form-control" required="required">
									<label>Password</label>
								</div>
								<div class="md-input-wrapper">
									<input type="password" name="repassword" class="md-form-control" required="required">
									<label>Confirm Password</label>
								</div>
								<div class="rkmd-checkbox checkbox-rotate checkbox-ripple b-none m-b-20">
									<label class="input-checkbox checkbox-primary">
										<input type="checkbox" id="checkbox">
										<span class="checkbox"></span>
									</label>
									<div class="captions">Remember Me</div>
								</div>

								<div class="col-xs-10 offset-xs-1">
									<input type="submit" name="signup" class="btn btn-primary btn-md btn-block waves-effect waves-light m-b-20" value="Sign up">
								</div>

								<div class="row">
									<div class="col-xs-12 text-center">
										<span class="text-muted">Already have an account?</span>
										<a href="index.php" class="f-w-600 p-l-5"> Login In Here</a>

									</div>
								</div>
							</form>
							<!-- end of form -->
							<!-- register sql part start -->
							<?php
							if( isset($_POST['signup']) )
							{
								$fullname 	= mysqli_real_escape_string( $connect, $_POST['fullname'] );
								$username 	= mysqli_real_escape_string( $connect, $_POST['username'] );
								$email 		= mysqli_real_escape_string( $connect, $_POST['email'] );
								$password 	= mysqli_real_escape_string( $connect, $_POST['password'] );
								$repassword = mysqli_real_escape_string( $connect, $_POST['repassword'] );

								if( $password==$repassword )
								{
									$hassedPass = sha1($password);

									$query = "INSERT INTO user(fullname, username, email, password) VALUES ('$fullname','$username','$email','$hassedPass') ";
									$data = mysqli_query($connect, $query);

									if($data)
									{
										echo '<div class="btn btn-danger mt-2">Please wait for approval</div> ';
									}
									else
									{
										die("Database Connection is Failed". mysqli_error($connect));
									}
								}
							}
							?>
							<!-- register sql part end -->

						</div>
						<!-- end of login-card -->
					</div>
					<!-- end of col-sm-12 -->
				</div>
				<!-- end of row-->
			</div>
			<!-- end of container-fluid -->
	</section>

<?php
include("inc/auth/footer.php");
?>