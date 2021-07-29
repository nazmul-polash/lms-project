<?php
ob_start();
session_start();
include "inc/db.php";
if( empty($_SESSION['email']) && empty($_SESSION['user_id']) )
{
   header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Library Management System</title>
   

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
   <!-- Favicon icon -->
   <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
   <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

   <!-- themify -->
   <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">

   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">

   <!-- fontawesome -->
   <script src="https://use.fontawesome.com/6e2b1726ab.js"></script>

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="assets/icon/simple-line-icons/css/simple-line-icons.css">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

   <!-- Chartlist chart css -->
   <link rel="stylesheet" href="assets/plugins/chartist/dist/chartist.css" type="text/css" media="all">

   <!-- Weather css -->
   <link href="assets/css/svg-weather.css" rel="stylesheet">


   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="assets/css/main.css">
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">

   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

</head>

<body class="sidebar-mini fixed">
   <div class="loader-bg">
      <div class="loader-bar">
      </div>
   </div>
   <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header-top hidden-print">
         <a href="dashboard.php" class="logo"><img class="img-fluid able-logo" src="assets/images/logo.png" alt="Theme-logo"></a>
         <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="" data-toggle="offcanvas" class="sidebar-toggle"></a>
            
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu ml-auto">

               <ul class="top-nav">
                  <!-- User Menu-->
                  <li class="dropdown">
                     <a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
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
                                 <img src="assets/images/img/<?php echo $image; ?>" width="40">
                              <?php }
                              else
                              { ?>
                                 <img src="assets/images/img/default.png" width="40">
                              <?php }
                           }
                           ?>
                        </span>
                        <span><?php echo $_SESSION['fullname']; ?><i class=" icofont icofont-simple-down"></i></span>

                     </a>
                     <ul class="dropdown-menu settings-menu">
                        <li><a href="profile.php?do=profile"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="index.php"><i class="icon-logout"></i> Logout</a></li>

                     </ul>
                  </li>
               </ul>           
            </div>
         </nav>
      </header>