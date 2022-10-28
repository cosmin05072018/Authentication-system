<?php
if (isset($_POST['submit'])) {
    require_once('connect.php');
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['passwordConfirm'];
    $query = $db->query("SELECT email FROM users WHERE email = '" . $db->real_escape_string($email) . "'");
    $row = $query->fetch_assoc();
    if (mysqli_num_rows($query) >= 1) {
        header("Location: registration.php?signup=alreadyExists&firstName=$fName&lastName=$lName");
        exit();
    } elseif (empty($fName) || empty($lName) || empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: registration.php?signup=empty&firstName=$fName&lastName=$lName");
        exit();
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $fName) || !preg_match("/^[a-zA-Z]*$/", $lName)) {
            header("Location: registration.php?signup=char");
            exit();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: registration.php?signup=email&firstName=$fName&lastName=$lName");
                exit();
            } elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
                header("Location: registration.php?signup=passwordNoMatches&firstName=$fName&lastName=$lName");
                exit();
            } else {
                $passHash = password_hash($password, PASSWORD_DEFAULT);
                $db = new mysqli('localhost', 'root', '', 'myprojects');
                $db->query("INSERT INTO users SET 
                first_name = '$fName',
                last_name = '$lName',
                email = '$email',
                password = '$passHash'
                ");
                header("Location: login.php?signup=succes");
            }
        }
    }
}



