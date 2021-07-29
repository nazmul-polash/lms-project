<?php
include "inc/header.php";
?>
    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">


                <!-- Blog Posts Start -->
                <div class="col-md-8">
                    <h4>Books Details</h4>
                    <div class="title-border"></div>
                    <div class="row">

                        <?php
                        if(isset($_GET['name']))
                        {
                            $bookName = $_GET['name'];


                            $query = "SELECT * FROM books WHERE bookname='$bookName' ORDER BY book_id DESC";
                            $selectBooks = mysqli_query($connect, $query);
                            while( $row = mysqli_fetch_assoc($selectBooks) )
                            {
                                $book_id        = $row['book_id'];
                                $bookname       = $row['bookname'];
                                $bookdesc       = $row['bookdesc'];
                                $bookcat        = $row['bookcat'];
                                $quantity       = $row['quantity'];
                                $author         = $row['author'];
                                $status         = $row['status'];
                                $image          = $row['image'];
                                $publish_date   = $row['publish_date'];
                                ?>
                                <div class="col-md-4">
                                    <div>
                                        <?php
                                            if(!empty($image))
                                            { ?>
                                                <img src="admin/assets/images/books/<?php echo $image; ?>" >
                                            <?php }
                                            else
                                            { ?>
                                                <img src="admin/assets/images/books/default.png">
                                            <?php }
                                        ?>
                                    </div>
                                    <div class="mt-3">
                                        <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-block">Order Now...</a>
                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <h3><?php echo $bookname; ?></h3>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="m-3"><strong>Category Name</strong></div>
                                            <div class="m-3"><strong>Author Name</strong></div>
                                            <div class="m-3"><strong>Publish Date</strong></div>
                                        </div>
                                        
                                        <div class="col-md-7">
                                            <div class="m-3"><p>Category Name</p></div>
                                            <div class="m-3"><p>
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
                                            </p></div>
                                            <div class="m-3"><p><?php echo $publish_date; ?></p></div>
                                        </div>
                                    </div>

                                    <div class="border-bottom border border-dark"></div>

                                    <div class="col-md-12 mt-3 text-justify"><?php echo $bookdesc; ?></div>
                                </div>

                            <?php }
                        }

                        ?>
                       
                        <!-- ternary condition end -->
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


