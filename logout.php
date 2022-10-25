<?php

session_start();
session_unset();
session_destroy();

if(isset($_COOKIE['email'])){
    setcookie('email', null, -1);
}

header("Location: home.php");