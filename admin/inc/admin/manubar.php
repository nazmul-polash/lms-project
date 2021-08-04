<!-- Side-Nav-->
<aside class="main-sidebar hidden-print">
    <section class="sidebar" id="sidebar-scroll">
      <!-- Sidebar Menu-->
        <ul class="sidebar-menu">
            <li class="nav-level"><h5>Admin Panal</h5></li>
            <li class="active treeview">
                <a href="dashboard.php" class="waves-effect waves-dark"><i class="icon-speedometer"></i>
                <span> Dashboard</span></a>
            </li>
            <li class="nav-level"><h5>Manage All Components</h5></li>

            <?php
            if( $_SESSION['user_role'] == 1 )
            { ?>
                <li class="treeview">
                    <a href="#" class="waves-effect waves-dark"><i class="icon-briefcase"></i><span> Category</span><i class="icon-arrow-down"></i></a>

                    <ul class="treeview-menu">
                        <li><a href="category.php" class="waves-effect waves-dark"><i class="icon-arrow-right"></i>Manage All Categorys</a></li>
                    </ul>
                </li>
                <li class="treeview"><a class="waves-effect waves-dark" href=""><i class="icon-book-open"></i><span> Users</span><i class="icon-arrow-down"></i></a>

                    <ul class="treeview-menu">

                        <li><a href="user.php?do=manage" class="waves-effect waves-dark"><i class="icon-arrow-right"></i> Manage all Users</a></li>

                        <li><a href="user.php?do=add" class="waves-effect waves-dark"><i class="icon-arrow-right"></i>Add New Users</a></li>
                    </ul>
                </li>
            <?php }
            ?>

            <li class="treeview"><a class="waves-effect waves-dark" href=""><i class="icon-book-open"></i><span> Books</span><i class="icon-arrow-down"></i></a>

                <ul class="treeview-menu">

                    <li><a href="book.php?do=manage" class="waves-effect waves-dark"><i class="icon-arrow-right"></i> Manage all Books</a></li>

                    <li><a href="book.php?do=add" class="waves-effect waves-dark"><i class="icon-arrow-right"></i>Add New Books</a></li>

                </ul>
            </li>

            <?php
            if( $_SESSION['user_role'] == 1 )
            { ?>
            <li class="treeview"><a class="waves-effect waves-dark" href=""><i class="icon-book-open"></i><span> Booking Books</span><i class="icon-arrow-down"></i></a>

                <ul class="treeview-menu">

                    <li><a href="booking_books.php?bb=manage" class="waves-effect waves-dark"><i class="icon-arrow-right"></i> Manage all Booking List</a></li>

                    <!-- <li><a href="book.php?do=add" class="waves-effect waves-dark"><i class="icon-arrow-right"></i>Add New Books</a></li> -->
                    
                </ul>
            </li>
            <?php }
            ?>
        </ul>
    </section>
</aside>
<!-- Sidebar chat start -->