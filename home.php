<?php
require_once("connect.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HomePage</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="homePage.css">


    <!-- <script>
// Prevent dropdown menu from closing when click inside the form
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});
</script> -->
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="#" class="navbar-brand">Brand<b>Name</b></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <!-- <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
            <div class="navbar-nav">
                <a href="#" class="nav-item nav-link">Home</a>
                <a href="#" class="nav-item nav-link">About</a>
                <div class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Services</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Web Design</a>
                        <a href="#" class="dropdown-item">Web Development</a>
                        <a href="#" class="dropdown-item">Graphic Design</a>
                        <a href="#" class="dropdown-item">Digital Marketing</a>
                    </div>
                </div>
                <a href="#" class="nav-item nav-link active">Pricing</a>
                <a href="#" class="nav-item nav-link">Blog</a>
                <a href="#" class="nav-item nav-link">Contact</a>
            </div>
            <form class="navbar-form form-inline">
                <div class="input-group search-box">
                    <input type="text" id="search" class="form-control" placeholder="Search here...">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="material-icons">&#xE8B6;</i>
                        </span>
                    </div>
                </div>
            </form> -->

            <?php 

            if(!isset($_SESSION['email']) && isset($_COOKIE['email'])){
                $_SESSION['email'] = $_COOKIE['email'];
            }

            $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            if(!$email){
                echo '
              
                <div class="navbar-nav ml-auto action-buttons">
                <p class="nav-item nav-link">You are not connected...</p>
                <div class="nav-item">
                <a href="registration.php"  class="nav-link mr-4">Registration</a>
            </div>
            <div class="nav-item">
                <a href="login.php" class="btn btn-primary sign-up-btn">Log In</a>
            </div>
            </div>';
            }else{
                echo'
                <div class="navbar-nav ml-auto action-buttons">
                <p class="nav-item nav-link">Hello, '.$_SESSION['email'].'</p>
                <a href="logout.php" class="logout-btn">Logout</a>
                </div>
                ';
            }
            ?>
            <!-- <div class="navbar-nav ml-auto action-buttons">
                <div class="nav-item">
                    <a href="registration.php"  class="nav-link mr-4">Registration</a>
                </div>
                <div class="nav-item">
                    <a href="login.php" class="btn btn-primary sign-up-btn">Log In</a>
                </div>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div> -->
        </div>
       
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>