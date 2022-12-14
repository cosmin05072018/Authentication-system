<?php
require_once 'checkSession.php';
require_once 'checkLoggedIn.php';
require_once "dataValidate.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Login</span>
            <form action="" method="POST">
                <div class="input-field">
                    <input type="text" name="email" placeholder="Enter your email adress"
                           value="<?= (isset($_POST['email']) && $_POST['email']) ? $_POST['email'] : ''; ?>">
                    <i class="uil uil-envelope"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="password" name="password" placeholder="Enter your password">
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePW"></i>
                </div>

                <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" name="remember_me" id="logCheck">
                        <label for="logCheck" class="text">Remember me</label>
                    </div>
                    <a href="forgotPassword.php" class="text"> Forgot password?</a>
                </div>
                <div class="input-field button">
                    <input type="submit" name="submit" value="Login">
                </div>
            </form>
            <div class="login-signup">
                    <span class="text">Don' t have an account? <a href="registration.php" class="text signup-link">SignUp Now</a>
                    </span> <br>
                <span class="text"><a href="index.php" class="text">Go to Home</a></span>
            </div>

            <?php
            if (isset($_GET['signin'])) {
                $siginCheck = $_GET['signin'];
                if ($siginCheck === "inputRequired") {
                    echo '<p class="error">The inputs is required</p>  <i class="uil uil-times-circle"></i>';
                } elseif ($siginCheck === "emailError") {
                    echo '<p class="error">The email is invalid.</p>  <i class="uil uil-times-circle"></i>';
                } elseif ($siginCheck === "accountNotExist") {
                    echo '<p class="error">The account does not exist.</p>  <i class="uil uil-times-circle"></i>';
                } elseif ($siginCheck === "incorrectly") {
                    echo '<p class="error">The account or password was entered incorrectly!</p>  <i class="uil uil-times-circle"></i>';
                } elseif ($siginCheck === "succes") {
                    echo '<p class="succes">Login succes!</p>  <i class="uil uil-times-circle"></i>';
                }
            }
            ?>
        </div>
    </div>
</div>
        <script src="passShowHide.js"></script>
</body>
</html>
