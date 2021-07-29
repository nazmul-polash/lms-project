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
				$do = isset($_GET['do']) ? $_GET['do']:'manage';
				
				if($do=='manage')
				{ ?>
					<div class="card">
						<div class="card-primary title_color">
							<div class="card-header">
								<h5 class="card-header-text">Manage all Books</h5>
							</div>
						</div>
						<div class="card-block">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">Serial</th>
										<th scope="col">Image</th>
										<th scope="col">Book Title Name</th>
										<th scope="col">category Name</th>
										<th scope="col">Quantity</th>
										<th scope="col">Author</th>
										<th scope="col">Status</th>
										<th scope="col">Publish Date</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<!-- read the hole users in the database sql part start -->
									<?php
									$query = "SELECT * FROM books ORDER BY book_id DESC";
									$allBooks = mysqli_query($connect, $query);
									$i=0;
									while( $row = mysqli_fetch_assoc($allBooks) )
									{
										$book_id  			= $row['book_id'];
            				$bookname 			= $row['bookname'];
            				$bookdesc 			= $row['bookdesc'];
            				$bookcat 				= $row['bookcat'];
            				$quantity 			= $row['quantity'];
            				$author 				= $row['author'];
            				$status 				= $row['status'];
            				$image 					= $row['image'];
            				$publish_date 	= $row['publish_date'];
            				$i++;
            				?>
            				<tr>
											<th scope="row"><?php echo $i; ?></th>
											<td>
												<?php
                    		if(!empty($image))
                    		{ ?>
                    			<img src="assets/images/books/<?php echo $image; ?>" width="50">
                    		<?php }
                    		else
                    		{ ?>
                    			<img src="assets/images/books/default.png" width="50">
                    		<?php }

                    	?>
											</td>
											<td><?php echo $bookname; ?></td>
											<td>
												<?php
            							$query = "SELECT * FROM category WHERE cat_id='$bookcat'";
            							$category_name = mysqli_query($connect, $query);
            							while( $row = mysqli_fetch_array($category_name) )
            							{
            								$cat_id     = $row['cat_id'];
						                $cat_name   = $row['cat_name'];
						                echo $cat_name;
						              }
            						?>	
											</td>
											<td><?php echo $quantity; ?></td>
											<td>
												<?php
            							$query = "SELECT * FROM user WHERE user_id = '$author'";
            							$author_name = mysqli_query($connect, $query);
            							while( $row = mysqli_fetch_array($author_name) )
            							{
            								$user_id     = $row['user_id'];
						                $user_name   = $row['fullname'];
						                echo $user_name;
						              }
            						?>
											</td>
											<td>
												<?php
												if($status==1)
												{?>
                    			<span class="badge badge-success">Active</span>
                    		<?php }
												else if($status==2)
												{?>
                    			<span class="badge badge-danger">Inactive</span>
                    		<?php }
												?>
											</td>
											<td><?php echo $publish_date; ?></td>

											<td>
												<div class="action_bar">
													<ul>
														<li>
															<a href="book.php?do=edit&b_id=<?php echo $book_id;?>" class="badge badge-warning"><i class="icon-note"></i></a>
															<a href="" data-toggle="modal" data-target="#delete<?php echo $book_id;?>" class="badge badge-danger"><i class="icon-trash"></i></a>
														</li>
													</ul>
												</div>
											</td>
						<!-- Modal -->
            <div class="modal" id="delete<?php echo $book_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <a href="book.php?do=delete&d_id=<?php echo $book_id; ?>" type="submit" name="delete" class="btn btn-danger">Delete</a>
                    <a href="" type="button" class="btn btn-success">Cancel</a>
                  </div>
                </div>
              </div>
            </div>
          <!-- delete modal end -->
										</tr>
									<?php }
									?>
									<!-- read the hole users in the database sql part end -->
								</tbody>
							</table>
						</div>
					</div>
				<?php }

				else if($do=='add')
				{ ?>
					<div class="card ">
            <div class="card-primary title_color">
							<div class="card-header">
								<h5 class="card-header-text">Add New Books</h5>
							</div>
						</div>
            <div class="card-block">
            	<!-- add users form start -->
            	<form action="book.php?do=insert" method="POST" enctype="multipart/form-data">
            		<div class="row">
            			<div class="col-lg-6">
            				<div class="form-group">
            					<label>Book Title Name</label>
            					<input type="text" name="bookname" class="form-control" required="required" autocomplete="off">
            				</div>
            				<div class="form-group">
            					<label>Quantity</label>
            					<input type="text" name="quantity" class="form-control">
            				</div>
            				<div class="form-group">
            					<label>Description</label>
            					<textarea name="description" id="inputDescription" class="form-control" rows="4"></textarea>
            				</div>
            			</div>
            			<div class="col-lg-6">
            				
            				<div class="form-group">
            					<label>Select Category / Sub-Category</label>
            					<select name="bookcat" class="form-control">
            						<option value="0">Plese select the category / sub category</option>
            						<?php
		                        $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
		                        $readParent = mysqli_query($connect, $query);
		                        while($row = mysqli_fetch_assoc($readParent))
		                        {
														$parent_cat_id    = $row['cat_id'];
														$parent_cat_name  = $row['cat_name'];

														?>
														<option value="<?php echo $parent_cat_id; ?>" ><?php echo $parent_cat_name; ?></option>

													<?php }
							                    ?>
            					</select>
            				</div>
            				<div class="form-group">
            					<label>Status</label>
            					<select name="status" class="form-control">
            						<option value="2">Pleace select the status</option>
            						<option value="1">Active</option>
            						<option value="2">Inactive</option>
            					</select>
            				</div>
            				<div class="form-group">
            					<label>Profile Picture</label>
            					<input type="file" name="image" class="form-control-file"> 
            				</div>
            			</div>
            			<div class=" offset-md-5">
            				<div class="form-group">
            					<input type="submit" name="addbooks" class="btn btn-primary" value="Add new Books">
            				</div>
            			</div>
            		</div>
            	</form>
            	<!-- add users form end -->
        		</div>
        	</div>
				<?php }

				else if($do=='insert')
				{
					if( isset($_POST['addbooks']) )
					{
						$bookname 		= mysqli_real_escape_string($connect, $_POST['bookname']);
						$description  = mysqli_real_escape_string($connect, $_POST['description']);
						$quantity 		= mysqli_real_escape_string($connect, $_POST['quantity']);
						$bookcat 			= $_POST['bookcat'];
						$author 			= $_SESSION['user_id'];
						$status 			= $_POST['status'];

						// this is tha image file and image_name
  					$image 		= $_FILES['image']['name'];
  					// this is the tmp image file and tmp image folder name
  					$tmp_image 	= $_FILES['image']['tmp_name'];


							// change the image name with rand function
  						$randomNumber = rand(0,9999999);
  						$imageFile = $randomNumber . $image;

  						// move the image it's distination
  						move_uploaded_file( $tmp_image, "assets/images/books/" . $imageFile);

  						$query = "INSERT INTO books (bookname, bookdesc, bookcat, quantity, author, status, image, publish_date) VALUES ('$bookname', '$description', '$bookcat', '$quantity', '$author', '$status', '$imageFile', now() )";
  						$addBook = mysqli_query($connect, $query);

  						if($addBook)
  						{
  							header("Location:book.php");
  						}
  						else
  						{
  							die("database connection is failed".mysqli_error($connect));
  						}
						

					}
				}

				else if($do=='edit')
				{
					if(isset($_GET['b_id']))
					{
						$editID = $_GET['b_id'];

						$query = "SELECT * FROM books WHERE book_id='$editID'";
						$editQuery = mysqli_query($connect, $query);
						while( $row = mysqli_fetch_assoc($editQuery) )
						{
							$book_id  			= $row['book_id'];
      				$bookname 			= $row['bookname'];
      				$bookdesc 			= $row['bookdesc'];
      				$bookcat 				= $row['bookcat'];
      				$quantity 			= $row['quantity'];
      				$author 				= $row['author'];
      				$status 				= $row['status'];
      				$image 					= $row['image'];
      				$publish_date 	= $row['publish_date'];
      				?>
      				<div class="card ">
		            <div class="card-primary title_color">
									<div class="card-header">
										<h5 class="card-header-text">Edit the Books</h5>
									</div>
								</div>
		            <div class="card-block">
		            	<!-- add users form start -->
		            	<form action="book.php?do=update" method="POST" enctype="multipart/form-data">
				            <div class="row">
		            			<div class="col-lg-6">
		            				<div class="form-group">
		            					<label>Book Title Name</label>
		            					<input type="text" name="bookname" class="form-control" value="<?php echo $bookname; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Quantity</label>
		            					<input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
		            				</div>
		            				<div class="form-group">
		            					<label>Description</label>
		            					<textarea name="description" id="inputDescription" class="form-control" rows="4" value=""><?php echo $bookdesc; ?></textarea>
		            				</div>
		            			</div>
		            			<div class="col-lg-6">
		            				
		            				<div class="form-group">
		            					<label>Select Category / Sub-Category</label>
		            					<select name="bookcat" class="form-control">
		            						<option value="0">Plese select the category / sub category</option>
		            						<?php
				                        $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
				                        $readParent = mysqli_query($connect, $query);
				                        while($row = mysqli_fetch_assoc($readParent))
				                        {
																$parent_cat_id    = $row['cat_id'];
																$parent_cat_name  = $row['cat_name'];

																?>
																<option value="<?php echo $parent_cat_id; ?>"<?php if($parent_cat_id==$bookcat){echo 'selected';} ?> ><?php echo $parent_cat_name; ?></option>

															<?php }
									                    ?>
		            					</select>
		            				</div>
		            				<div class="form-group">
		            					<label>Status</label>
		            					<select name="status" class="form-control">
		            						<option value="2">Pleace select the status</option>
		            						<option value="1" <?php if($status==1){echo 'selected'; }  ?> >Active</option>
		            						<option value="2" <?php if($status==2){echo 'selected'; }  ?> >Inactive</option>
		            					</select>
		            				</div>
		            				<div class="form-group">
		            					<label>Profile Picture</label><br>
		            					<?php
                        		if(!empty($image))
                        		{ ?>
                        			<img src="assets/images/books/<?php echo $image; ?>" width="150" class="mb-3">
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
		            					<input type="hidden" name="updatbeookid" value="<?php echo $book_id; ?>">
		            					<input type="submit" name="updatebook" class="btn btn-primary" value="Update the Books">
		            				</div>
		            			</div>
		            		</div>
		            	</form>
		            	<!-- add users form end -->
		        		</div>
		        	</div>
						<?php }
					}
				}

				else if($do=='update')
				{
					if(isset($_POST['updatebook']))
  				{
  					$updatbeookid 	= $_POST['updatbeookid'];
  					$bookname 			= mysqli_real_escape_string($connect, $_POST['bookname']);
						$description  	= mysqli_real_escape_string($connect, $_POST['description']);
						$quantity 			= mysqli_real_escape_string($connect, $_POST['quantity']);
						$bookcat 				= $_POST['bookcat'];
						$author 				= $_SESSION['user_id'];
						$status 				= $_POST['status'];

						// this is tha image file and image_name
  					$image 		= $_FILES['image']['name'];
  					// this is the tmp image file and tmp image folder name
  					$tmp_image 	= $_FILES['image']['tmp_name'];

  					// old image delete query 
  					if(!empty($image))
  					{
    					// change the image name with rand function
  						$randomNumber = rand(0,9999999);
  						$imageFile = $randomNumber . $image;

  						// move the image it's distination
  						move_uploaded_file( $tmp_image, "assets/images/books/" . $imageFile);

  						$delPostThumbnail = "SELECT * FROM books WHERE book_id = $updatbeookid";
  						$removeImage = mysqli_query($connect, $delPostThumbnail);
  						while( $row = mysqli_fetch_assoc($removeImage) )
  						{
  							$rmvImage = $row['image'];
  							unlink("assets/images/books/". $rmvImage);
  						}
  						$query = "UPDATE books SET bookname='$bookname', bookdesc='$description', bookcat='$bookcat', quantity='$quantity', author='$author', status='$status', image='$imageFile' WHERE book_id='$updatbeookid'";

  						$updatePostInfo = mysqli_query($connect, $query);

  							if($updatePostInfo)
    						{
    							header("Location:book.php?do=manage");
    						}
    						else
    						{
    							die("database connection is failed".mysqli_error($connect));
    						}
  					}
  					else
  					{
  						$query = "UPDATE books SET bookname='$bookname', bookdesc='$description', bookcat='$bookcat', quantity='$quantity', author='$author', status='$status', image='$imageFile' WHERE book_id='$updatbeookid'";

  						$updatePostInfo = mysqli_query($connect, $query);

  							if($updatePostInfo)
    						{
    							header("Location:book.php?do=manage");
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
						$removeQuery = "SELECT * FROM books WHERE book_id = '$deleteUsersId'";
						$removeImage = mysqli_query($connect, $removeQuery);
						while( $row = mysqli_fetch_assoc($removeImage) )
						{
							$rem_image = $row['image'];
							unlink("assets/images/books/" . $rem_image);
						}
						// remove the old image on my folder sql part end

  					$query = "DELETE FROM books WHERE book_id = '$deleteUsersId'";

  					$delUsers = mysqli_query($connect, $query);
  					if($delUsers)
						{
							header("Location:book.php?do=manage");
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