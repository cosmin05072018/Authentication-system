<?php
require_once("connect.php");
session_start();


if (isset($_COOKIE['token']) ) {
    setcookie('token', null, -1, '/');
    $db->query("UPDATE users SET 
    remember_token = NULL 
    WHERE id='".$_SESSION['user']['id']."'
    ");
}

session_unset();
session_destroy();
header("Location: index.php");
