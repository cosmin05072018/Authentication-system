<?php
require_once 'checkSession.php';
require_once 'checkLoggedIn.php';
require_once "dataProcessing.php";

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
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registration</span>
            <form action="" method="POST">
                <div class="input-field">
                    <input type="text" name="firstName" placeholder="First Name"
                           value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : ''; ?>"/>
                    <i class="uil uil-user"></i>
                </div>
                <?php if(isset($errors['first_name'])): ?>
                    <div class="message">
                        <p class="error"><?= $errors['first_name']; ?></p>
                    </div>
                <?php endif; ?>
                <div class="input-field">
                    <input type="text" name="lastName" placeholder="Last Name"
                           value="<?= isset($_POST['lastName']) ? $_POST['lastName'] : ''; ?>">
                    <i class="uil uil-user"></i>
                </div>
                <?php if(isset($errors['last_name'])): ?>
                    <div class="message">
                        <p class="error"><?= $errors['last_name']; ?></p>
                    </div>
                <?php endif; ?>
                <div class="input-field">
                    <input type="text" name="email" placeholder="Enter your email address">
                    <i class="uil uil-envelope"></i>
                </div>
                <?php if(isset($errors['email'])): ?>
                    <div class="message">
                        <p class="error"><?= $errors['email']; ?></p>
                    </div>
                <?php endif; ?>
                <div class="input-field">
                    <input type="password" class="password" name="password" placeholder="Enter your password">
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePW"></i>
                </div>
                <?php if(isset($errors['password'])): ?>
                    <div class="message">
                        <p class="error"><?= $errors['password']; ?></p>
                    </div>
                <?php endif; ?>
                <div class="input-field">
                    <input type="password" class="password" name="passwordConfirm" placeholder="Confirm your password">
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePW"></i>
                </div>
                <?php if(isset($errors['confirm_password'])): ?>
                    <div class="message">
                        <p class="error"><?= $errors['confirm_password']; ?></p>
                    </div>
                <?php endif; ?>

                <div class="input-field button">
                    <input type="submit" name="submit" value="Register">
                </div>
            </form>
            <div class="login-signup">
                    <span class="text">Do you have an account?
                        <a href="login.php" class="text login-link"> LogIn Now</a>
                    </span><br>
                <span class="text"><a href="index.php" class="text">Go to Home</a></span>
            </div>
        </div>
    </div>
</div>
<script src="passShowHide.js"></script>
</body>
</html>

