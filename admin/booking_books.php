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
		<?php 

			$do = isset($_GET['do']) ? $_GET['do']: 'manage'; 

			if( $do=='manage' )
			{ ?>
				<!-- All booking books part start -->
				<div class="card">
					<div class="card-primary title_color">
						<div class="card-header">
							<h5 class="card-header-text">Manage all Booking Books</h5>
						</div>
					</div>
					<div class="card-block">
						<table class="table table-striped">
							<thead class="thead-dark">
							<tr>
								<th scope="col">Serial</th>
								<th scope="col">User Name</th>
								<th scope="col">Book Name</th>
								<th scope="col">Starting Date</th>
								<th scope="col">Ending Date</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
							</thead>
							<tbody>
								<?php
									$query = "SELECT * FROM booking ORDER BY id DESC";
									$bookingData = mysqli_query($connect, $query);
									$s=0;
									while( $row = mysqli_fetch_assoc($bookingData) )
									{
										$id 		= $row['id'];
										$userid 	= $row['userid'];
										$bookid 	= $row['bookid'];
										$date_start = $row['date_start'];
										$date_end 	= $row['date_end'];
										$status 	= $row['status'];
										$s++;
										?>
										<tr>
											<th scope="row"><?php echo $s;?></th>
											<td>
												<?php
			            							$query = "SELECT * FROM user WHERE user_id = '$userid'";
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
													$query = "SELECT * FROM books WHERE book_id='$bookid'";
													$allBooks = mysqli_query($connect, $query);
													$i=0;
													while( $row = mysqli_fetch_assoc($allBooks) )
													{
														$book_id  	= $row['book_id'];
				            							$bookname 	= $row['bookname'];
				            							echo $bookname;
				            						}
				            					?>
											</td>
											<td><?php echo $date_start; ?></td>
											<td><?php echo $date_end; ?></td>
											<td>
												<?php
													if($status==1)
													{?>
			            								<span class="badge badge-success">Active</span>
			            							<?php }
													else if($status==2)
													{?>
			            								<span class="badge badge-danger">Pending</span>
			            							<?php }
													else if($status==3)
													{?>
			            								<span class="badge badge-dark">Inactive</span>
			            							<?php }
												?>
											</td>
											<td>
												<div class="action_bar">
													<ul>
														<li>
															<a href="booking_books.php?do=edit&bb_id=<?php echo $id; ?>" class="badge badge-warning"><i class="icon-note"></i></a>
															<a href="" class="badge badge-danger" data-toggle="modal" data-target="#delete<?php echo $id;?>"><i class="icon-trash"></i></a>
														</li>
													</ul>
												</div>
											</td>
									<!-- Modal start -->
									<div class="modal" id="delete<?php echo $id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Are You Sure... </h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-footer">
									        <a href="booking_books.php?do=delete&d_id=<?php echo $id; ?>" type="submit" name="delete" class="btn btn-danger">Delete</a>
									        <a href="" type="button" class="btn btn-success">Cancel</a>
									      </div>
									    </div>
									  </div>
									</div>
									<!-- Modal end -->
										</tr>
									<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- All booking books part end -->
			<?php }

			else if( $do == 'edit' )
			{
				if( isset($_GET['bb_id']) )
				{
					$bb_id = $_GET['bb_id'];
					
					$query = "SELECT * FROM booking WHERE id='$bb_id'";
					$bookingBookData = mysqli_query($connect, $query);
					while( $row = mysqli_fetch_assoc($bookingBookData) )
					{
						$id 		= $row['id'];
						$userid 	= $row['userid'];
						$bookid 	= $row['bookid'];
						$date_start = $row['date_start'];
						$date_end 	= $row['date_end'];
						$status 	= $row['status'];
						?>
							<div class="card">
								<div class="card-primary title_color">
									<div class="card-header">
										<h5 class="card-header-text">Booking all Books List</h5>
									</div>
								</div>
								<div class="card-block">
									<div class="col-md-6 offset-3">

										<form action="booking_books.php?do=update" method="POST">

											<div class="form-group">
												<label for="">Booking Date End</label>
												<input type="text" name="end" class="form-control" value="<?php echo $date_end; ?>">
											</div>
										
											<div class="form-group">
		          					<label>Status</label>
		          					<select name="status" class="form-control">
		          						<option value="2">Pleace select the status</option>
		          						<option value="1" <?php if($status==1){echo 'selected'; }  ?> >Active</option>
		          						<option value="2" <?php if($status==2){echo 'selected'; }  ?> >Panding</option>
		          						<option value="3" <?php if($status==3){echo 'selected'; }  ?> >Inactive</option>
		          					</select>
		          				</div>

		          				<div class="form-group">
		          					<input type="hidden" name="editbookingid" value="<?php echo $id; ?>">
		          					<input type="submit" name="editbooking" class="btn btn-primary btn-block" value="Edit Booking Books">
		          				</div>
	          				</form>

          				</div>	
	            	</div>	
	            </div>	
												
					<?php }
				}
			}

			else if( $do == 'update' )
			{
				if(isset($_POST['editbooking']))
				{
					$editBookingID 	= $_POST['editbookingid'];
					$end 						= $_POST['end'];
					$status 				= $_POST['status'];

					$query = "UPDATE booking SET status='$status' WHERE id='$editBookingID' ";
					
					$updateBooking = mysqli_query($connect, $query);

					if($updateBooking)
					{
						header("Location:booking_books.php?do=manage");
					}
					else
					{
						die("database connection is failed".mysqli_error($connect));
					}

				}
			}
			else if( $do == 'delete' )
			{
				if( isset($_GET['d_id']) )
				{
					$booking_delete = $_GET['d_id'];

					$query = "DELETE FROM booking WHERE id='$booking_delete'";

					$deleteBooking = mysqli_query($connect, $query);

					if($deleteBooking)
					{
						header("Location:booking_books.php?do=manage");
					}
					else
					{
						die("database connection is failed".mysqli_error($connect));
					}
				}

			}
		?>
		
	</div>
	<!-- Main content ends -->
</div>
</div>
<?php
include("inc/admin/footer.php");
?>