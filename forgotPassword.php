<?php
require_once("connect.php");
require_once("verifyEmail.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotPassword.css">
</head>

<body>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Forgot Your Password</span>
                <form action="" method="POST">
                    <?php if (isset($message['email'])) : ?>
                        <div class="errors">
                            <p><?= $message['email'] ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email adress">
                        <i class="uil uil-envelope"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="forgot_password" value="Submit">
                    </div>
                </form>
                <div class="login-signup">
                    <span class="text"><a href="index.php" class="text">Go to Home</a></span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>