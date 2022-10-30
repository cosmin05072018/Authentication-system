<?php
if (isset($_POST['email'])) {
    $emailAdress = $_POST['email'];
    $password = $_POST['password'];
    if (empty($emailAdress) || empty($password)) {
        header("Location: login.php?signin=inputRequired&email=$emailAdress");
        exit();
    }
    if (!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?signin=emailError&email=$emailAdress");
        exit();
    }

    $query = $db->query("SELECT * FROM users WHERE email = '" . $db->real_escape_string($emailAdress) . "'");
    $row = $query->fetch_assoc();

    if (!$row) {
        header("Location: login.php?signin=accountNotExist&email=$emailAdress");
        exit();
    }

    if (!password_verify($_POST['password'], $row['password'])) {
        header("Location: login.php?signin=incorrectly&email=$emailAdress");
        exit();
    }

    unset($row['password']);
    unset($row['remember_token']);
    $_SESSION['user'] = $row;
    if (isset($_POST['remember_me'])) {
        $token = uniqid();
        setcookie('token', $token, time() + 3600000, '/');
        $db->query("UPDATE users SET 
                            remember_token = '" . $db->real_escape_string($token) . "'
                            WHERE email='" . $db->real_escape_string($_POST['email']) . "'
                            ");
    }
    header("Location: index.php");
    exit();

}
