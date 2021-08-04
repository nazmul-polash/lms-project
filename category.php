<?php
include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">
                    <h4>Populer Books</h4>
                    <div class="title-border"></div>

                    <div class="row">
                        <!-- read the hole users in the database sql part start -->
                        <?php
                        if( isset($_GET['category']) )
                        {
                        	$categoryName = $_GET['category'];

                        	$catNameData = "SELECT * FROM category WHERE cat_name='$categoryName'";
                        	$cat_query = mysqli_query($connect, $catNameData);

                            if(mysqli_num_rows($cat_query)>0){

                            	while( $row = mysqli_fetch_assoc($cat_query) )
	                        	{
	                        		$cat_id 	= $row['cat_id'];
									$cat_name 	= $row['cat_name'];
									$cat_desc 	= $row['cat_desc'];
									$parent_id	= $row['parent_id'];
									$status 	= $row['status'];
	                        	}
	                        
	                            $query = "SELECT * FROM books WHERE bookcat='$cat_id' ORDER BY book_id DESC";
	                            $allBooks = mysqli_query($connect, $query);
	                            $count = mysqli_num_rows($allBooks);
	                            if($count<=0)
	                            {
	                            	echo '<div class="alert alert-info">Opps... There is no Book...</div>';
	                            }

	                            else
	                            {
		                            while( $row = mysqli_fetch_assoc($allBooks) )
		                            {
		                                $book_id      = $row['book_id'];
		                                $bookname     = $row['bookname'];
		                                $bookdesc     = $row['bookdesc'];
		                                $bookcat      = $row['bookcat'];
		                                $quantity     = $row['quantity'];
		                                $author       = $row['author'];
		                                $status       = $row['status'];
		                                $image        = $row['image'];
		                                $publish_date = $row['publish_date'];
		                                ?>
		                                <!-- Single Item Blog Post Start -->
		                                
		                                    <div class="col-md-4 text-center pt-3">
		                                        <div class="populer-book">
		                                        	<a href="bookdetails.php?name=<?php echo $bookname; ?>">
		                                            <?php
		                                                if(!empty($image))
		                                                { ?>
		                                                    <img src="admin/assets/images/books/<?php echo $image; ?>" width="50">
		                                                <?php }
		                                                else
		                                                { ?>
		                                                    <img src="admin/assets/images/books/default.png" width="50">
		                                                <?php }
		                                            ?>
		                                        	</a>

		                                            <!-- <img src="assets/images/book_image/phices.jpg" alt=""> -->
		                                            <a href="bookdetails.php?name=<?php echo $bookname; ?>">
		                                                <h4><?php echo $bookname ?></h4>
		                                            </a>
		                                            <p class="mb-2">
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
		                                            </p>
		                                            <div class="vd">
		                                                <a href="bookdetails.php?name=<?php echo $bookname; ?>">view details</a>
		                                            </div>
		                                        </div>
		                                    </div>
		                                
		                                <!-- Single Item Blog Post End -->
		                            <?php }
	                            }

                            }else{
                            	echo '<div class="btn btn-danger btn-block">This Content Is Not Available</div>';
                            }
                        }
                        ?>  
                    </div>
                </div>

                      

                <!-- Blog Right Sidebar -->
                <?php
                include "inc/sidebar.php";
                ?>
                <!-- Right Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    
<?php
include "inc/footer.php";
?>


