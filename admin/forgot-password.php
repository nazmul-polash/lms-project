<?php
include("inc/auth/header.php");
?>

	<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
		<div class="container-fluid">
			<div class="row">
				   <div class="col-xs-12">
						<div class="login-card card-block">
							<form class="md-float-material">
								<div class="text-center">
									<img src="assets/images/logo-black.png" alt="logo">
								</div>
								<h3 class="text-primary text-center m-b-25">Recover your password</h3>

								<div class="md-group">
									<div class="md-input-wrapper">
										<input type="text" class="md-form-control" />
										<label>Email or Mobile Number</label>
									</div>
								</div>
						<div class="btn-forgot">
							<button type="reset" class="btn btn-primary btn-md waves-effect waves-light text-center">SEND RESET LINK
							</button>
						</div>
								<div class="row">
									<div class="col-xs-12 text-center m-t-25">

										<a href="login.php" class="f-w-600 p-l-5"> Login In Here</a>

									</div>
								</div>
						<!-- end of btn-forgot class-->
					</form>
					<!-- end of form -->
				</div>
				<!-- end of login-card -->
			</div>
			<!-- end of col-sm-12 -->
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container-fluid -->
</section>
<?php
include("inc/auth/footer.php");
?>