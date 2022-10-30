<?php
require_once("connect.php");
session_start();
$message=[];

if(isset($_POST['verifyCode'])){
    $code = $_POST['verifyCode'];
    $query = $db->query("SELECT reset_password_token FROM users WHERE email = '$_SESSION[email]'");
    $row= $query->fetch_assoc();
    if(!$code){
        $message['code'] = 'Input required';
    }
    elseif($code == $row['reset_password_token']){
        header("Location: newPassword.php"); 
    }
    else{
        $message['code'] = 'The code is wrong';
    }
}