<?php
require_once('connect.php');
require_once('dataProcessing.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- REGISTRATION FORM -->
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registration</span>
                <form action="dataProcessing.php" method="POST">
                    <?php
                    if (isset($_GET['firstName'])) {
                        echo    '<div class="input-field">
                                <input type="text" name="firstName" placeholder="First Name" value=' . $_GET['firstName'] . '>
                                <i class="uil uil-user"></i>
                            </div>';
                    } else {
                        echo    '<div class="input-field">
                                <input type="text" name="firstName" placeholder="First Name">
                                <i class="uil uil-user"></i>
                            </div>';
                    }

                    if (isset($_GET['lastName'])) {
                        echo    '<div class="input-field">
                                <input type="text" name="lastName" placeholder="Last Name" value=' . $_GET['lastName'] . '>
                                <i class="uil uil-user"></i>
                            </div>';
                    } else {
                        echo    '<div class="input-field">
                                <input type="text" name="lastName" placeholder="Last Name" > 
                                <i class="uil uil-user"></i>
                            </div>';
                    }
                    ?>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email adress">
                        <i class="uil uil-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="password" placeholder="Enter your password">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePW"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="passwordConfirm" placeholder="Confirm your password">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePW"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Register">
                    </div>

                </form>

                <div class="login-signup">
                    <span class="text">Do you have an account?
                        <a href="login.php" class="text login-link"> LogIn Now</a>
                    </span><br>
                    <span class="text"><a href="home.php" class="text">Go to Home</a></span>
                </div>
                <script src="passShowHide.js"></script>
                <?php
                if (!isset($_GET['signup'])) {
                    exit();
                } else {
                    $signupCheck = $_GET['signup'];
                    if ($signupCheck === "empty") {
                        echo '
                        <div class=message>
                        <p class="error">The inputs is required <i class="uil uil-times-circle"></i></p>  
                        </div>
                        ';
                        exit();
                    } elseif ($signupCheck === "char") {
                        echo '
                        <div class=message>
                        <p class="error">The first or last name is invalid.  <i class="uil uil-times-circle"></i></p> 
                        </div>
                        ';
                        exit();
                    } elseif ($signupCheck === "email") {
                        echo '
                        <div class=message>
                        <p class="error">The email is invalid. <i class="uil uil-times-circle"></i></p>  
                        </div>
                        ';
                        exit();
                    } elseif ($signupCheck === "passwordNoMatches") {
                        echo '
                        <div class=message>
                        <p class="error">Passwords do not match.<i class="uil uil-times-circle"></i></p> 
                        </div>
                        ';
                        exit();
                    }elseif($signupCheck === "alreadyExists"){
                        echo '
                        <div class=message>
                        <p class="error">This account already exists! <i class="uil uil-check-circle"></i></p>  
                        </div>
                        ';
                        exit();
                    }
                     elseif ($signupCheck === "succes") {
                        echo '
                        <div class=message>
                        <p class="succes">You have successfully created your account! <i class="uil uil-check-circle"></i></p>  
                        </div>
                        ';
                        exit();
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- ---------------- -->



</body>

</html>