<?php
include("inc/admin/header.php");
?>
<?php
include("inc/admin/manubar.php");
?>
<div class="content-wrapper">
	<!-- Main content starts -->
	<div class="container-fluid">
		<div class="row">
			<div class="main-header">
				<h4>Dashboard</h4>
			</div>
		</div>
		<!-- All users part start -->
		<div class="row">
			<div class="col-lg-12">
				<?php
				// this is the ternary condision
				// stracture>>url a jodi kono man jemon(do) paile--> sei value/man store hobe --> r value na hole default manage a chole jabe
				$do = isset($_GET['do']) ? $_GET['do']:'profile';
				
			

				if($do=='profile')
				{
					$profileID = $_SESSION['user_id'];

						$query = "SELECT * FROM user WHERE user_id='$profileID'";
						$editQuery = mysqli_query($connect, $query);
						while( $row = mysqli_fetch_assoc($editQuery) )
						{
							$user_id 		= $row['user_id'];
      				$fullname 	= $row['fullname'];
      				$username 	= $row['username'];
      				$email 			= $row['email'];
      				$password 	= $row['password'];
      				$phone 			= $row['phone'];
      				$address 		= $row['address'];
      				$status 		= $row['status'];
      				$user_role 	= $row['user_role'];
      				$join_date 	= $row['join_date'];
      				$image 			= $row['image'];
      				?>
      				<div class="card ">
		            <div class="card-primary title_color">
									<div class="card-header">
										<h5 class="card-header-text">Edit my profiles</h5>
									</div>
								</div>
		            <div class="card-block">
		            	<!-- add users form start -->
		            	<form action="user.php?do=update" method="POST" enctype="multipart/form-data">
		            		<div class="row">
		            			<div class="col-lg-6">
		            				<div class="form-group">
		            					<label>Full Name</label>
		            					<input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Username</label>
		            					<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Email</label>
		            					<input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Password</label>
		            					<input type="password" name="password" class="form-control" placeholder="******" >
		            				</div>
		            				<div class="form-group">
		            					<label>Re-Password</label>
		            					<input type="password" name="repassword" class="form-control" placeholder="******">
		            				</div>
		            			</div>
		            			<div class="col-lg-6">
		            				<div class="form-group">
		            					<label>Phone No</label>
		            					<input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Address</label>
		            					<input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Users Status</label>
		            					<select name="status" class="form-control">
		            						<option value="2">Pleace select the status</option>
		            						<option value="1" <?php if($status==1){echo 'selected'; } ?> >Active</option>
		            						<option value="2" <?php if($status==2){echo 'selected'; } ?> >Inactive</option>
		            					</select>
		            				</div>
		            				<div class="form-group">
		            					<label>Users Role</label>
		            					<select name="user_role" class="form-control">
		            						<option value="2">Pleace select the User Role</option>
		            						<option value="1" <?php if($user_role==1){echo 'selected'; } ?>>Super Admin</option>
		            						<option value="2" <?php if($user_role==2){echo 'selected'; } ?>>User</option>
		            					</select>
		            				</div>
		            				<div class="form-group">
		            					<label>Profile Picture</label>
		            					<?php
                      		if(!empty($image))
                      		{ ?>
                      			<img src="assets/images/img/<?php echo $image; ?>" width="50">
                      		<?php }
                      		else
                      		{
                      			echo "Upload a profile picture";
                      		}
                      		?><br>
		            					<input type="file" name="image" class="form-control-file"> 
		            				</div>
		            			</div>
		            			<div class=" offset-md-5">
		            				<div class="form-group">
		            					<input type="hidden" name="updateUserId" value="<?php echo $user_id ?>">
		            					<input type="submit" name="addusers" class="btn btn-primary" value="Update My Profile">
		            				</div>
		            			</div>
		            		</div>
		            	</form>
		            	<!-- add users form end -->
		        		</div>
		        	</div>

						<?php }

					
				}

				else if($do=='update')
				{
					if(isset($_POST['addusers']))
  				{
  					$updateUserId 	= $_POST['updateUserId'];
  					$fullname 			= $_POST['fullname'];
  					$username 			= $_POST['username'];
  					$email 					= $_POST['email'];

  					$password 			= $_POST['password'];
  					$repassword 		= $_POST['repassword'];

  					$phone 					= $_POST['phone'];
  					$address 				= $_POST['address'];
  					$status 				= $_POST['status'];
  					$user_role 			= $_POST['user_role'];

  					// this is tha image file and image_name
  					$image 		= $_FILES['image']['name'];
  					// this is the tmp image file and tmp image folder name
  					$tmp_image 	= $_FILES['image']['tmp_name'];

  					if( !empty($password) && !empty($image) )
  					{
  						if($password == $repassword)
    					{
    						// encription password
    						$hassedPass = sha1($password);

    						// change the image name with rand function
    						$randomNumber = rand(0,9999999);
    						$imageFile = $randomNumber . $image;

    						// remove the old image on my folder sql part start
    						$removeQuery = "SELECT * FROM user WHERE user_id = '$updateUserId'";
    						$removeImage = mysqli_query($connect, $removeQuery);
    						while( $row = mysqli_fetch_assoc($removeImage) )
  							{
  								$rem_image = $row['image'];
  								unlink("assets/images/img/" . $rem_image);
  							}
  							// remove the old image on my folder sql part end

    						// move the image it's distination
    						move_uploaded_file( $tmp_image, "assets/images/img/" . $imageFile);

  							$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email', password='$hassedPass', phone='$phone', address='$address', status='$status', user_role='$user_role', image='$imageFile' WHERE user_id = '$updateUserId'";

  							$updateUserInfo = mysqli_query($connect, $query);

  							if($updateUserInfo)
    						{
    							header("Location:user.php?do=manage");
    						}
    						else
    						{
    							die("database connection is failed".mysqli_error($connect));
    						}
  						}
  					}

  					else if( !empty($password) && empty($image) )
  					{
  						if($password == $repassword)
    					{
    						// encription password
    						$hassedPass = sha1($password);

  							$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email', password='$hassedPass', phone='$phone', address='$address', status='$status', user_role='$user_role' WHERE user_id = '$updateUserId'";

  							$updateUserInfo = mysqli_query($connect, $query);

  							if($updateUserInfo)
    						{
    							header("Location:user.php?do=manage");
    						}
    						else
    						{
    							die("database connection is failed".mysqli_error($connect));
    						}
  						}
  					}

  					else if( empty($password) && !empty($image) )
  					{
  						
  						// change the image name with rand function
  						$randomNumber = rand(0,9999999);
  						$imageFile = $randomNumber . $image;

  						// remove the old image on my folder sql part start
  						$removeQuery = "SELECT * FROM user WHERE user_id = '$updateUserId'";
  						$removeImage = mysqli_query($connect, $removeQuery);
  						while( $row = mysqli_fetch_assoc($removeImage) )
							{
								$rem_image = $row['image'];
								unlink("assets/images/img/" . $rem_image);
							}
							// remove the old image on my folder sql part end

  						// move the image it's distination
  						move_uploaded_file( $tmp_image, "assets/images/img/" . $imageFile);

							$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email',  phone='$phone', address='$address', status='$status', user_role='$user_role', image='$imageFile' WHERE user_id = '$updateUserId'";

							$updateUserInfo = mysqli_query($connect, $query);

							if($updateUserInfo)
  						{
  							header("Location:user.php?do=manage");
  						}
  						else
  						{
  							die("database connection is failed".mysqli_error($connect));
  						}
  					}

  					else if( empty($password) && empty($image) )
  					{
  						$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email',  phone='$phone', address='$address', status='$status', user_role='$user_role' WHERE user_id = '$updateUserId'";

							$updateUserInfo = mysqli_query($connect, $query);

							if($updateUserInfo)
  						{
  							header("Location:user.php?do=manage");
  						}
  						else
  						{
  							die("database connection is failed".mysqli_error($connect));
  						}
  					}
  				}
				}

				else if($do=='delete')
				{
					// delete information part start
  				if(isset($_GET['d_id']))
  				{
  					$deleteUsersId = $_GET['d_id'];
  					// remove the old image on my folder sql part start
						$removeQuery = "SELECT * FROM user WHERE user_id = '$deleteUsersId'";
						$removeImage = mysqli_query($connect, $removeQuery);
						while( $row = mysqli_fetch_assoc($removeImage) )
						{
							$rem_image = $row['image'];
							unlink("assets/images/img/" . $rem_image);
						}
						// remove the old image on my folder sql part end

  					$query = "DELETE FROM user WHERE user_id = '$deleteUsersId'";

  					$delUsers = mysqli_query($connect, $query);
  					if($delUsers)
						{
							header("Location:user.php?do=manage");
						}
						else
						{
							die("database connection is failed".mysqli_error($connect));
						}
  				}
				}

				else
				{
					header("location:404.php");
				}
				?>
				
			</div>
		</div>
		<!-- All user part end -->
	</div>
	<!-- Main content ends -->
</div>
</div>
<?php
include("inc/admin/footer.php");
?>