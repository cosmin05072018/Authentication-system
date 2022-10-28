<?php
require_once('connect.php');
session_start();
if (isset($_POST['email'])) {
    $emailAdress = $_POST['email'];
    $password = $_POST['password'];
    $query = $db->query("SELECT * FROM users WHERE email = '" . $db->real_escape_string($emailAdress) . "'");
    $row = $query->fetch_assoc();
    if (empty($emailAdress) || empty($password)) {
        header("Location: login.php?signin=inputRequired&email=$emailAdress");
        exit();
    } else {
        if (!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
            header("Location: login.php?signin=emailError&email=$emailAdress");
            exit();
        } elseif ( $query->num_rows  == 0) {
            header("Location: login.php?signin=accountNotExist&email=$emailAdress");
            exit();
        } elseif ( $query->num_rows == 1) {
            if (password_verify($_POST['password'], $row['password'])) {
                header("Location: index.php?signin=succes");
                $_SESSION['email'] = $_POST['email'];
                if (isset($_POST['remember_me'])) {
                    $token = uniqid();
                    setcookie('token', $token, time() + 3600, '/');
                    $db = new mysqli('localhost', 'root', '', 'myprojects');
                    $db->query("UPDATE users SET 
                            remember_token = '$token'
                            WHERE email='$_POST[email] '
                            ");
                }
                exit();
            } else {
                header("Location: login.php?signin=incorrectly&email=$emailAdress");
            }
        } else {
            header("Location: login.php?signin=noAccount");
            exit();
        }
    }
}
