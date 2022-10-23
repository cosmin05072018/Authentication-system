<?php
    require_once("connect.php");
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
                <div class="input-field">
                    <input type="text" name="firstName" placeholder="First Name">
                    <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="lastName" placeholder="Last Name">
                    <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                    <input type="email" name="email" placeholder="Enter your email adress">
                    <i class="uil uil-envelope"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="password" name="password" placeholder="Enter your password">
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePW"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="passwordConfirm" name="password" placeholder="Confirm your password">
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
                </span>
            </div>
        </div>
    </div>
    </div>
    
    <!-- ---------------- -->

    <script src="passShowHide.js"></script>

</body>

</html>