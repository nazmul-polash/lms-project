<?php
include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="bannar">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/images/bannar/bannar-1.jpg" class="d-block w-100" alt="...">
              
            </div>
            <div class="carousel-item">
              <img src="assets/images/bannar/bannar-2.jpg" class="d-block w-100" alt="...">
              
            </div>
            <div class="carousel-item">
              <img src="assets/images/bannar/bannar-3.jpg" class="d-block w-100" alt="...">
              
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">
                    <h4>Search Books</h4>
                    <div class="title-border"></div>

                    <div class="row">
                        <!-- read the hole users in the database sql part start -->
                        <?php
                            if(isset($_POST['contentsearch']))
	                   		{
	                   			$data = mysqli_real_escape_string($connect, $_POST['search']);
	                   		

	                            $query = "SELECT * FROM books WHERE bookname LIKE '%$data%' ORDER BY book_id DESC";
	                            $allBook = mysqli_query($connect, $query);
	                            // ekhane akta count chalate hobe
	                                while( $row = mysqli_fetch_assoc($allBook) )
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

		                                            <!-- <img src="assets/images/book_image/phices.jpg" alt=""> -->
		                                            <a href="">
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
		                                                <a href="bookdetails.php?id=details">view details</a>
		                                            </div>
		                                        </div>
		                                    </div>
		                                
		                                <!-- Single Item Blog Post End -->
		                            <?php }
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


