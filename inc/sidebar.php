<div class="col-md-4">

    <!-- Latest News -->
    <div class="widget">
        <h4>Latest Books</h4>
        <div class="title-border"></div>
        
        <!-- Sidebar Latest News Slider Start -->
        <div class="sidebar-latest-news owl-carousel owl-theme">

            <?php
                $query = "SELECT * FROM books ORDER BY book_id DESC LIMIT 3";
                $allBooks = mysqli_query($connect, $query);
                while( $row = mysqli_fetch_assoc($allBooks) )
                {
                    $book_id       = $row['book_id'];
                    $bookname      = $row['bookname'];
                    $bookdesc      = $row['bookdesc'];
                    $bookcat       = $row['bookcat'];
                    $quantity      = $row['quantity'];
                    $author        = $row['author'];
                    $status        = $row['status'];
                    $image         = $row['image'];
                    $publish_date  = $row['publish_date'];
                    ?>
                    <!-- First Latest News Start -->
                    <div class="item">
                        <div class="latest-news">
                            <!-- Latest News Slider Image -->
                            <div class="latest-news-image">
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
                            </div>
                            <!-- Latest News Slider Heading -->
                            <a href="bookdetails.php?name=<?php echo $bookname; ?>">
                                <h5><?php echo $bookname; ?></h5>
                            </a>
                            <!-- Latest News Slider Paragraph -->
                            <p><?php echo substr($bookdesc,0, 50) ; ?>....</p>
                        </div>
                    </div>
                    <!-- First Latest News End -->

                <?php }

            ?>

        </div>
        <!-- Sidebar Latest News Slider End -->
    </div>


    <!-- Search Bar Start -->
    <div class="widget"> 
            <!-- Search Bar -->
            <h4>Book Search</h4>
            <div class="title-border"></div>
            <div class="search-bar">
                <!-- Search Form Start -->
                <form action="search.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
                        <i class="fa fa-paper-plane-o"></i>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="contentsearch" class="btn btn-primary btn-block" value="Search Book">
                    </div>
                </form>
                <!-- Search Form End -->
            </div>
    </div>
    <!-- Search Bar End -->

    <!-- Recent Post -->
    <div class="widget">
        <h4>Recent Books</h4>
        <div class="title-border"></div>
        <div class="recent-post">

            <!-- recent books sql part start -->
            <?php
            $query = "SELECT * FROM books ORDER BY book_id DESC LIMIT 4 ";
            $bookData = mysqli_query($connect, $query);
            while( $row = mysqli_fetch_assoc($bookData) )
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
                <!-- Recent Post Item Content Start -->
                <div class="recent-post-item">
                    <div class="row">
                        <!-- Item Image -->
                        <div class="col-md-4">
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
                        </div>
                        <!-- Item Tite -->
                        <div class="col-md-8 no-padding">
                            <a href="bookdetails.php?name=<?php echo $bookname; ?>">
                                <h5><?php echo $bookname; ?></h5>
                            </a>
                            <ul>
                                <li><i class="fa fa-clock-o"></i><?php echo $publish_date; ?></li>
                                <!-- <li><i class="fa fa-comment-o"></i>15</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Recent Post Item Content End -->
            <?php }
            ?>
            <!-- recent books sql part end -->
        </div>
    </div>

    <!-- All Category -->
    <div class="widget">
        <h4>Book Categories</h4>
        <div class="title-border"></div>

        <!-- sidebar book category sql part start -->
        <?php
        $categoryQuery = "SELECT cat_id AS 'pcat_id', cat_name AS 'pcat_name' FROM category WHERE parent_id=0 AND status=1 ORDER BY cat_name ASC";
        $selectData = mysqli_query($connect, $categoryQuery);
        while( $row = mysqli_fetch_assoc($selectData) )
        {
            extract($row);
            ?>
            <!-- Blog Category Start -->
            <div class="blog-categories">
                <ul>
                    <!-- Category Item start -->
                    <li>
                        <i class="fa fa-check"></i><a href="category.php?category=<?php echo $pcat_name; ?>"><?php echo $pcat_name;?></a> 
                        <span>[
                            <?php
                            $query = "SELECT * FROM books WHERE bookcat='$pcat_id' ORDER BY book_id DESC";
                            $allData = mysqli_query($connect, $query);
                            $count = mysqli_num_rows($allData);
                            echo $count;
                            ?>
                        ]</span>
                    </li>
                    <!-- Category Item end-->
                </ul>
            </div>
            <!-- Blog Category End -->
        <?php  }
        ?>
        <!-- sidebar book category sql part end -->


        
    </div>
</div>