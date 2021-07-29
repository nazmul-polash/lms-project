<?php
include("inc/auth/header.php");
?>

<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-12">
				<div class="login-card card-block">

					<form action="" method="POST">
						<div class="text-center">
							<img src="assets/images/logo-black.png" alt="logo">
						</div>
						<h3 class="text-center txt-primary">
							Log In your account
						</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="md-input-wrapper">
									<input type="email" name="email" class="md-form-control" required="required"/>
									<label>Email</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="md-input-wrapper">
									<input type="password" name="password" class="md-form-control" required="required"/>
									<label>Password</label>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
							<div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
								<label class="input-checkbox checkbox-primary">
									<input type="checkbox" id="checkbox">
									<span class="checkbox"></span>
								</label>
								<div class="captions">Remember Me</div>

							</div>
								</div>
							<div class="col-sm-6 col-xs-12 forgot-phone text-right">
								<a href="forgot-password.php" class="text-right f-w-600"> Forget Password?</a>
								</div>
						</div>
						<div class="row">
							<div class="col-xs-10 offset-xs-1">
								<input type="submit" name="login" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Log In">
							</div>
						</div>
						<!-- <div class="card-footer"> -->
						<div class="col-sm-12 col-xs-12 text-center">
							<span class="text-muted">Don't have an account?</span>
							<a href="register.php" class="f-w-600 p-l-5">Registration Now</a>
						</div>
					</form>
				</div>
				<!-- end of login-card -->

	<!-- user login sql part start -->
	<?php
		if( isset($_POST['login']) )
		{
			$email 		= mysqli_real_escape_string($connect, $_POST['email']);
			$password 	= mysqli_real_escape_string($connect, $_POST['password']);
			$hassedPass = sha1($password);

			$query = "SELECT * FROM user WHERE email='$email' AND status= 1 ";
			$data = mysqli_query($connect, $query);
			$count = mysqli_num_rows($data);
			if( $count==1 )
			{
				while( $row = mysqli_fetch_array($data) )
				{
					$_SESSION['user_id']  	= $row['user_id'];
    				$_SESSION['fullname'] 	= $row['fullname'];
    				$_SESSION['username'] 	= $row['username'];
    				$_SESSION['email'] 		= $row['email'];
    				$password 				= $row['password'];
    				$phone 					= $row['phone'];
    				$address 				= $row['address'];
    				$_SESSION['status'] 	= $row['status'];
    				$_SESSION['user_role'] 	= $row['user_role'];
    				$join_date 				= $row['join_date'];
    				$image 					= $row['image'];

    				if( $_SESSION['email'] == $email && $password == $hassedPass )
    				{
    					header("Location:dashboard.php");
    				}
    				else if( $_SESSION['email'] == $email && $password != $hassedPass )
    				{
    					// header("Location:index.php");
    					echo '<div class="btn btn-danger">wrong password....</div>"';
    				}
    				else if( $_SESSION['email'] != $email || $password != $hassedPass )
    				{
    					// header("Location:index.php");
    					echo '<div class="btn btn-danger">Your email and password wrong....</div>"';
    				}
    				
				}
			}
			else if( $count==0 )
			{
				echo '<div class="btn btn-danger">Your Information is wrong....</div>"';
			}
		}

	?>
	<!-- user login sql part end -->
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

