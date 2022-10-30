<?php
session_start();
require_once 'connect.php';
if(!isset($_SESSION['user']) && isset($_COOKIE['token']) && $_COOKIE['token']) {
    $checkUser = $db->query("SELECT * FROM users WHERE remember_token = '".$db->real_escape_string($_COOKIE['token'])."'");

    if($checkUser->num_rows) {
        $row = $checkUser->fetch_assoc();
        unset($row['password']);
        unset($row['remember_token']);
        $_SESSION['user'] = $row;
    }
}
