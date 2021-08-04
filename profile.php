<?php
include "inc/header.php";
?>
<section>
	<div class="container">
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
		            	<form action="profile.php?do=update" method="POST" enctype="multipart/form-data">
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
		            					<input type="email" name="email" class="form-control" readonly required="required" value="<?php echo $email; ?>">
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
		            					<label>Profile Picture</label>
		            					<?php
                      		if(!empty($image))
                      		{ ?>
                      			<img src="admin/assets/images/img/<?php echo $image; ?>" width="200">
                      		<?php }
                      		else
                      		{
                      			echo "Upload a profile picture";
                      		}
                      		?><br>
		            					<input type="file" name="admin/image" class="form-control-file"> 
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
    						echo $imageFile;

    						// remove the old image on my folder sql part start
    						$removeQuery = "SELECT * FROM user WHERE user_id = '$updateUserId'";
    						$removeImage = mysqli_query($connect, $removeQuery);
    						while( $row = mysqli_fetch_assoc($removeImage) )
  							{
  								$rem_image = $row['image'];
  								unlink("admin/assets/images/img/" . $rem_image);
  							}
  							// remove the old image on my folder sql part end

    						// move the image it's distination
    						move_uploaded_file( $tmp_image, "admin/assets/images/img/" . $imageFile);

  							$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email', password='$hassedPass', phone='$phone', address='$address', image='$imageFile' WHERE user_id = '$updateUserId'";

  							$updateUserInfo = mysqli_query($connect, $query);

  							if($updateUserInfo)
    						{
    							header("Location:profile.php?do=profile");
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

  							$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email', password='$hassedPass', phone='$phone', address='$address' WHERE user_id = '$updateUserId'";

  							$updateUserInfo = mysqli_query($connect, $query);

  							if($updateUserInfo)
    						{
    							header("Location:profile.php?do=profile");
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
								unlink("admin/assets/images/img/" . $rem_image);
							}
							// remove the old image on my folder sql part end

  						// move the image it's distination
  						move_uploaded_file( $tmp_image, "admin/assets/images/img/" . $imageFile);

							$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email',  phone='$phone', address='$address', image='$imageFile' WHERE user_id = '$updateUserId'";

							$updateUserInfo = mysqli_query($connect, $query);

							if($updateUserInfo)
  						{
  							header("Location:profile.php?do=profile");
  						}
  						else
  						{
  							die("database connection is failed".mysqli_error($connect));
  						}
  					}

  					else if( empty($password) && empty($image) )
  					{
  						$query = "UPDATE user SET fullname='$fullname', username='$username', email='$email',  phone='$phone', address='$address' WHERE user_id = '$updateUserId'";

							$updateUserInfo = mysqli_query($connect, $query);

							if($updateUserInfo)
  						{
  							header("Location:profile.php?do=profile");
  						}
  						else
  						{
  							die("database connection is failed".mysqli_error($connect));
  						}
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
		<div class="row mt-3">
			<div class="col-md-12">
				<div class="card-block">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Serial</th>
								<th scope="col">Image</th>
								<th scope="col">Book Name</th>
								<th scope="col">Booking Date Start</th>
								<th scope="col">Booking Date End</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<!-- booking table sql part start -->
							<?php
							$userID = $_SESSION['user_id'];

							$query = "SELECT * FROM booking WHERE userid='$userID' ORDER BY id DESC";
							$allBook = mysqli_query($connect, $query);
							$i=0;
							while( $row = mysqli_fetch_assoc($allBook) )
							{
								$id 		= $row['id'];
								$userid 	= $row['userid'];
								$bookid 	= $row['bookid'];
								$date_start = $row['date_start'];
								$date_end	= $row['date_end'];
								$status 	= $row['status'];
								$i++;
								?>
								<tr>
									<td scope="row"><?php echo $i; ?></td>

									<td>
										<?php
											$query = "SELECT * FROM books WHERE book_id='$bookid'";
											$allBooks = mysqli_query($connect, $query);
											while( $row = mysqli_fetch_assoc($allBooks) )
											{
												$image = $row['image'];
												if(!empty($image))
					                    		{ ?>
					                    			<img src="admin/assets/images/books/<?php echo $image; ?>" width="50">
					                    		<?php }
					                    		else
					                    		{ ?>
					                    			<img src="admin/assets/images/books/default.png" width="50">
					                    		<?php }
											}
										?>
									</td>

									<td>
										<?php
											$query = "SELECT * FROM books WHERE book_id='$bookid'";
											$allBooks = mysqli_query($connect, $query);
											while( $row = mysqli_fetch_assoc($allBooks) )
											{
												$bookname = $row['bookname'];
												echo $bookname;
											}
										?>
									</td>

									<td><?php echo $date_start; ?></td>
									<td><?php echo $date_end; ?></td>
									<td>
										<?php
											if($status==1)
											{ ?>
				                    			<span class="badge badge-success">Active</span>
				                    		<?php }
											else if($status==2)
											{ ?>
				                    			<span class="badge badge-danger">Pending</span>
				                    		<?php }
											else if($status==3)
											{ ?>
				                    			<span class="badge badge-dark">Inactive</span>
				                    		<?php }
										?>
									</td>
								</tr>
							<?php }
							?>
							<!-- booking table sql part end -->
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- booking part show here -->
		
	</div>
</section>


<?php
include "inc/footer.php";
?>
