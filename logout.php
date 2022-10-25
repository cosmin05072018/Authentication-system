<?php

session_start();
session_unset();
session_destroy();

if (isset($_COOKIE['token']) ) {
    setcookie('token', null, -1, '/');
    $db = new mysqli('localhost', 'root', '', 'myprojects');
    $db->query("UPDATE users SET 
    remember_token = NULL
    ");
}



header("Location: home.php");
