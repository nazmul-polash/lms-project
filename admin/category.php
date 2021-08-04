<?php
include("inc/admin/header.php");
?>


<?php
include("inc/admin/manubar.php");
?>
<div class="content-wrapper">
     <!-- Container-fluid starts -->
     <!-- Main content starts -->
    <div class="container-fluid">
        <div class="row">
			<div class="main-header">
			  <h4>Dashboard</h4>
			</div>
        </div>
		<!-- Row start -->
		<div class="row">
			<!-- Form Control starts -->
			<div class="col-lg-5">

				<!-- update_id sql part start -->
				<?php
					if( isset($_GET['update_id']) )
					{
						$update_id = $_GET['update_id'];

						$query = "SELECT * FROM category WHERE cat_id='$update_id'";
						$data = mysqli_query($connect, $query);
						while( $row = mysqli_fetch_assoc($data) )
						{
							$cat_id 	= $row['cat_id'];
							$cat_name 	= $row['cat_name'];
							$cat_desc 	= $row['cat_desc'];
							$parent_id	= $row['parent_id'];
							$status 	= $row['status'];
							?>
							<div class="card">
							 	<div class="card-primary title_color">
								    <div class="card-header">
								        <h5 class="card-header-text">Update The Category</h5>
								    </div>
							    </div>

							    <div class="card-block">
									<form action="" method="POST">
										<div class="form-group">
											<label>Category / Sub-Category Name</label>
											<input type="text" name="name" class="form-control" placeholder="Enter category name" value="<?php echo $cat_name;?>">
										</div>
										<div class="form-group">
											<label>Category Description</label>
											<textarea name="description" class="form-control" rows="4"><?php echo $cat_desc;?></textarea>
										</div>

										<div class="form-group">
											<label>Select Category / Sub-Category</label>
											<select class="form-control " name="parent_id">
												<option value="0">Please Select the Category</option>

												<?php
							                        $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
							                        $readParent = mysqli_query($connect, $query);
							                        while($row = mysqli_fetch_assoc($readParent))
							                        {
														$parent_cat_id    = $row['cat_id'];
														$parent_cat_name  = $row['cat_name'];

														?>
														<option value="<?php echo $parent_cat_id; ?>" <?php if($parent_cat_id == $parent_id){ echo 'selected'; } ?> ><?php echo $parent_cat_name; ?></option>

													<?php }
							                    ?>

											</select>
										</div>

										<div class="form-group">
											<label>Select Status</label>
											<select class="form-control " name="status">
											 	<option value="0">Please Select the Category</option>
											 	<option value="1" <?php if($status==1){ echo 'selected'; } ?> >Active</option>
											 	<option value="2" <?php if($status==0){ echo 'selected'; } ?> >Inactive</option>
											</select>
										</div>
										<div class="form-group">
											<input type="submit" name="update" value="Update the Category" class="btn btn-success waves-effect waves-light m-r-30">
										</div>
									</form>
							    </div>
							</div>
						<?php }
					}
				?><!-- update_id sql part end -->

				<!-- Update the category sql part start -->
				<?php
					if( isset($_POST['update']) )
					{
						$name 			= mysqli_real_escape_string($connect, $_POST['name']);
						$description 	= mysqli_real_escape_string($connect, $_POST['description']);
						$parent_id 		= $_POST['parent_id'];
						$status 		= $_POST['status'];

						$update_query = "UPDATE category SET cat_name='$name', cat_desc='$description', parent_id='$parent_id', status='$status' WHERE cat_id='$update_id' ";

						$quer_update = mysqli_query($connect, $update_query);
						
						if($quer_update)
			            {
			              header("Location:category.php");
			            }
			            else
			            {
			              die("Database connection is failed" . mysqli_error($connect));
			            }
					}
				?>
				<!-- Update the category sql part end -->

				<!-- add new category part start -->
				<div class="card">
				 	<div class="card-primary title_color">
					    <div class="card-header">
					        <h5 class="card-header-text">Add New Category</h5>
					    </div>
				    </div>

				    <div class="card-block">
						<form action="" method="POST">
							<div class="form-group">
								<label for="InputName">Category / Sub-Category Name</label>
								<input type="text" name="name" class="form-control" placeholder="Enter category name">
							</div>
							<div class="form-group">
								<label for="Textarea">Category Description</label>
								<textarea name="description" class="form-control" rows="4"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleSelect1" class="form-control-label">Select Category / Sub-Category</label>
								<select class="form-control " id="exampleSelect1" name="parent_id">
								<option value="0">Please Select the Category</option>
								<?php
			                        $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
			                        $readParent = mysqli_query($connect, $query);
			                        while($row = mysqli_fetch_assoc($readParent))
			                        {
			                          $parent_cat_id    = $row['cat_id'];
			                          $parent_cat_name  = $row['cat_name'];
			                          ?>
			                            <option value="<?php echo $parent_cat_id; ?>"><?php echo $parent_cat_name; ?></option>
			                          <?php
			                        }
			                    ?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleSelect1" class="form-control-label">Select Status</label>
								<select class="form-control " id="exampleSelect1" name="status">
								 	<option value="0">Please Select the Category</option>
								 	<option value="1">Active</option>
								 	<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" name="save" value="Add Category" class="btn btn-success waves-effect waves-light m-r-30">
							</div>
						</form>
				    </div>
				</div>
				<!-- add new category part end -->
			</div>
			<!-- add category sql part start -->
			<?php
			if( isset($_POST['save']) )
			{
				$name 			= mysqli_real_escape_string($connect, $_POST['name']);
				$description 	= mysqli_real_escape_string($connect, $_POST['description']);
				$parent_id 		= $_POST['parent_id'];
				$status 		= $_POST['status'];

				$query = "INSERT INTO category (cat_name, cat_desc, parent_id, status) VALUES ('$name','$description','$parent_id','$status')";
				$addCategory = mysqli_query($connect, $query);
				if($addCategory)
	            {
	              header("Location:category.php");
	            }
	            else
	            {
	              die("Database connection is failed" . mysqli_error($connect));
	            }
			}
			?>

			<!-- add category sql part end -->
			<!-- Form Control ends -->

			<!-- Textual inputs starts -->
			<div class="col-lg-7">
				<div class="card">
				 	<div class="card-primary title_color">
					    <div class="card-header">
					        <h5 class="card-header-text">Manage All Category</h5>
					    </div>
				    </div>
				    
				    <div class="card-block">
				    	<table class="table table-striped display" id="table_id">
							<thead>
								<tr>
									<th scope="col">Serial</th>
									<th scope="col">Category Name</th>
									<th scope="col">Categorys</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<!-- select category sql part start -->
								<?php
								$query = "SELECT * FROM category WHERE parent_id=0 ORDER BY cat_name ASC";
								$selectCat = mysqli_query($connect, $query);
								$i=0;
								while( $row = mysqli_fetch_assoc($selectCat) )
								{
									$cat_id 	= $row['cat_id'];
									$cat_name 	= $row['cat_name'];
									$cat_desc 	= $row['cat_desc'];
									$parent_id	= $row['parent_id'];
									$status 	= $row['status'];
									$i++;
									?>
									<tr>
										<th scope="row"><?php echo $i; ?></th>
										<td><?php echo $cat_name;?></td>
										<td>
											<?php
												echo '<div class="badge badge-info">Primary</div>';
											?>
										</td>
										<td>
											<?php
											if($status==1)
											{
												echo '<span class="badge badge-success">Active</span>';
											}
											else if($status==0)
											{
												echo '<div class="badge badge-danger">Inactive</div>';
											}
											?>
										</td>
										<td>
											<div class="action_bar">
												<ul>
													<li>
														<a href="category.php?update_id=<?php echo $cat_id;?>" class="badge badge-warning" ><i class="icon-note"></i></a>
														<a href="" class="badge badge-danger" ><i class="icon-trash"></i></a>
													</li>
												</ul>
											</div>
										</td>
									</tr>
								<?php
								// nasted loop start
								$childCatQuery = "SELECT * FROM category WHERE parent_id = '$cat_id' ORDER BY cat_name ASC";

								$child = mysqli_query($connect, $childCatQuery);

								while($row = mysqli_fetch_assoc($child))
								{
									$child_cat_id     = $row['cat_id'];
									$cat_name         = $row['cat_name'];
									$cat_desc         = $row['cat_desc'];
									$parent_id        = $row['parent_id'];
									$status           = $row['status'];
									$i++;
									?>
									<tr>
										<th scope="row"><?php echo $i; ?></th>
										<td>-- <?php echo $cat_name;?></td>
										<td>
											<?php
												echo '<div class="badge badge-dark">Child</div>';
											?>
										</td>
										<td>
											<?php
											if($status==1)
											{
												echo '<span class="badge badge-success">Active</span>';
											}
											else if($status==0)
											{
												echo '<div class="badge badge-danger">Inactive</div>';
											}
											?>
										</td>
										<td>
											<div class="action_bar">
												<ul>
													<li>
														<a href="category.php?update_id=<?php echo $child_cat_id;?>" class="badge badge-warning"><i class="icon-note"></i></a>
														<a href="" class="badge badge-danger"><i class="icon-trash"></i></a>
													</li>
												</ul>
											</div>
										</td>
									</tr>
								<?php }
								// nasted loop end
								}
								?>
								<!-- select category sql part end -->
								
							</tbody>
						</table>
				    </div>
				</div>
			</div>
			<!-- Textual inputs ends -->
		</div>
		<!-- Row end -->
        </div>
    </div>
    <!-- main content end -->
</div>






<?php
include("inc/admin/footer.php");
?>