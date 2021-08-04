<?php
ob_start();
session_start();
include "admin/inc/db.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Description -->
    <meta name="description" content="Blue Chip: Corporate Multi Purpose Business Template" />
    <meta name="author" content="Blue Chip" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/favicon.png" />

    <title>Blue Chip | Blog Right Sidebar</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

    <!-- Flat Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- Fency Box CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.min.css">

    <!-- Theme Main Style CSS -->
     <link rel="stylesheet" type="text/css" href="assets/css/style.css">
 

    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>

  <body>
    <!-- :::::::::: Header Section Start :::::::: -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                      <a class="navbar-brand" href="index.php">Library</a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                        	<?php
                        	$query = "SELECT cat_id AS 'pcat_id', cat_name AS 'pcat_name' FROM category WHERE parent_id=0 AND status=1 ORDER BY cat_name ASC";
                        	$allDataCat = mysqli_query($connect, $query);
                    		while( $row = mysqli_fetch_assoc($allDataCat))
                        	{
                        		extract($row);
                        		?>
                        		<li class="nav-item">
		                            <a class="nav-link manu_color" href="category.php?category=<?php echo $pcat_name; ?>"><?php echo $pcat_name; ?></a>
		                         </li>
                        	<?php }
                        	?>

                            <?php
                            if( !empty($_SESSION['email']) )
                            {?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>
                                        <?php

                                        $userID = $_SESSION['user_id'];
                                        
                                        $query = "SELECT * FROM user WHERE user_id='$userID'";
                                        $img = mysqli_query($connect, $query);
                                        while( $row = mysqli_fetch_assoc($img) )
                                        {
                                            $image  = $row['image'];

                                            if(!empty($image))
                                            { ?>
                                               <img src="admin/assets/images/img/<?php echo $image; ?>" width="40">
                                            <?php }
                                            else
                                            { ?>
                                               <img src="admin/assets/images/img/default.png" width="40">
                                            <?php }
                                        }
                                        ?>
                                    </span>
                                    <?php echo $_SESSION['fullname']; ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php?do=profile">Profile</a>
                                    <a class="dropdown-item" href="logout.php">Log Out</a>
                                </div>
                            </li>

                            <?php }
                            else
                            { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal">Log In</a>
                                </li>
                            <?php }
                            ?>
                            
                        </ul>
                        <!--  login Modal start -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">LogIn Your Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <form action="" method="POST">
                                  <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fa fa-envelope"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                          Remember Me
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                      <input type="submit" name="login" value="Sign In" class="btn btn-primary btn-block">
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <div class="col-12 text-center">
                                    <span class="text-muted">Don't have an account?</span>
                                    <a href="registration.php">Registration Now</a>
                                </div>  
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--login modal end -->
                            <!-- user login sql part start -->
                            <?php
                                if( isset($_POST['login']) )
                                {
                                    $email      = mysqli_real_escape_string($connect, $_POST['email']);
                                    $password   = mysqli_real_escape_string($connect, $_POST['password']);
                                    $hassedPass = sha1($password);

                                    $query = "SELECT * FROM user WHERE email='$email' AND status= 1 ";
                                    $data = mysqli_query($connect, $query);
                                    $count = mysqli_num_rows($data);
                                    if( $count==1 )
                                    {
                                        while( $row = mysqli_fetch_array($data) )
                                        {
                                            $_SESSION['user_id']    = $row['user_id'];
                                            $_SESSION['fullname']   = $row['fullname'];
                                            $_SESSION['username']   = $row['username'];
                                            $_SESSION['email']      = $row['email'];
                                            $password               = $row['password'];
                                            $phone                  = $row['phone'];
                                            $address                = $row['address'];
                                            $_SESSION['status']     = $row['status'];
                                            $_SESSION['user_role']  = $row['user_role'];
                                            $join_date              = $row['join_date'];
                                            $image                  = $row['image'];

                                            if( $_SESSION['email'] == $email && $password == $hassedPass )
                                            {
                                                header("Location:index.php");
                                            }
                                            else if( $_SESSION['email'] == $email && $password != $hassedPass )
                                            {
                                                // header("Location:index.php");
                                                echo '<div class="btn btn-danger">wrong password....</div>"';
                                            }
                                            else if( $_SESSION['email'] != $email || $password != $hassedPass )
                                            {
                                                // header("Location:index.php");
                                                echo '<div class="btn btn-danger">Your email and password wrong....</div>"';
                                            }
                                            
                                        }
                                    }
                                    else if( $count==0 )
                                    {
                                        echo '<div class="btn btn-danger">Your Information is wrong....</div>"';
                                    }
                                }
                            ?>
                            <!-- user login sql part end -->
                        
                      </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <!-- ::::::::::: Header Section End ::::::::: -->