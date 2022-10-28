<?php
require_once("connect.php");
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE['token']) ) {
    setcookie('token', null, -1, '/');
    $db->query("UPDATE users SET 
    remember_token = NULL 
    WHERE remember_token='$_COOKIE[token] '
    ");
}



header("Location: index.php");
