<?php
$errors = [];
if (isset($_POST['submit'])) {
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['passwordConfirm'];

    if (!$fName) {
        $errors['first_name'] = 'Required Input';

    }
    if (!$lName) {
        $errors['last_name'] = 'Required Input';

    }
    if (!$email) {
        $errors['email'] = 'Required Input';

    }
    if (!$password) {
        $errors['password'] = 'Required Input';

    }
    if (!$confirmPassword) {
        $errors['confirm_password'] = 'Required Input';

    }
    if (!preg_match("/^[a-zA-Z]*$/", $fName)) {
        $errors['first_name'] = 'Invalid characters';
    }
    if (!preg_match("/^[a-zA-Z]*$/", $lName)) {
        $errors['last_name'] = 'Invalid characters';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email';
    }
    if ($_POST['password'] !== $_POST['passwordConfirm']) {
        $errors['confirm_password'] = 'Confirm password must match with Password';
    }

    if (!$errors) {
        $query = $db->query("SELECT email FROM users WHERE email = '" . $db->real_escape_string($email) . "'");
        $row = $query->fetch_assoc();
        if ($query->num_rows) {
            $errors['email'] = 'Email already exists';
        }

        if (!$errors) {
            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $db->query("INSERT INTO users SET 
                first_name = '" . $db->real_escape_string($fName) . "',
                last_name = '" . $db->real_escape_string($lName) . "',
                email = '" . $db->real_escape_string($email) . "',
                password = '" . $db->real_escape_string($passHash) . "'
                ");
            header("Location: login.php");
        }
    }
}



