<?php
include "inc/header.php";
?>
    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">


                <!-- Blog Posts Start -->
                <div class="col-md-8">
                    <h4>Order Now</h4>
                    <div class="title-border"></div>
                    <h4>Booking the Book:
                        <?php 
                        if(isset($_GET['orderbook']))
                        {
                            $orderBook = $_GET['orderbook'];

                            $query = "SELECT * FROM books WHERE bookname='$orderBook' ORDER BY book_id DESC";
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

                                echo $bookname;
                            }
                        }

                        ?> 
                    </h4>

                    <div class="col-md-8 offset-1">
                        <div class="mt-3">

                            <form action="" method="POST">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Booking Date Start</label>
                                    <input type="date" name="start" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Booking Date end</label>
                                    <input type="date" name="end" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="booking" class="form-control" value="Booking now">
                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- sql part start -->
                    <?php
                    if(isset($_POST['booking']))
                    {
                        $start  = mysqli_real_escape_string($connect, $_POST['start']);
                        $end    = mysqli_real_escape_string($connect, $_POST['end']);

                        $query = "INSERT INTO booking(userid, bookid, date_start, date_end) VALUES('$author','$book_id','$start','$end')";
                        $allData = mysqli_query($connect, $query);

                        if($allData)
                        {
                            echo '<div class="btn btn-success mt-2">You Have Successfully Booking...</div> ';
                        }
                        else
                        {
                            die("Database Connection is Failed". mysqli_error($connect));
                        }
                    }
                    ?>
                    <!-- sql part end -->
                    
                    
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


