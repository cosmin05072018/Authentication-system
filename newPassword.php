<?php
require_once("connect.php");
require_once("configNewPassword.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="forgotPassword.css">
</head>

<body>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Reset Your Password</span>
                <form action="" method="POST">
                        <div class="messageDb">
                        <?php if (isset($message['error'])) : ?>
                            <p><?= $message['error'] ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="input-field">
                        <input type="password" name="newPassword" placeholder="Enter your new password">
                        <i class="uil uil-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="newPasswordConfirm" placeholder="Confirm new password">
                        <i class="uil uil-envelope"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="changePassword" value="Save">
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