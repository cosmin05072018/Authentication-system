<?php
require_once("connect.php");
session_start();
$message=[];
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $query=$db->query("SELECT * FROM users WHERE email = '" . $db->real_escape_string($email) . "'");
    $row=$query->fetch_assoc();
    if(!$email){
        $message['email'] = 'Input required';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['email'] = 'Invalid email';
    }elseif(!$row){
        $message['email']='The account does not exist.';
    }else{
        $message['email'] = 'succes';
        $code=rand(1111, 9999);
        $db->query("UPDATE users SET reset_password_token = '$code' WHERE email = '$email'"); 
        $_SESSION['email'] = $_POST['email'];
        header("Location: checkCode.php");
    }
}




