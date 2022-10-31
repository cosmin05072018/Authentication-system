<?php
require_once("connect.php");
session_start();
//work around...dar nu e ok

if(!isset($_SESSION['email'])) {
    header("Location: index.php"); 
}

$message=[];

if(isset($_POST['verifyCode'])){
    $code = $_POST['verifyCode'];
    if(!$code){
        $message['code'] = 'Input required';
    } else {
        $query = $db->query("SELECT reset_password_token FROM users WHERE email = '$_SESSION[email]'");
        $row= $query->fetch_assoc();

        if((int)$code === $row['reset_password_token']){ 
            header("Location: newPassword.php");  
        } else{
            $message['code'] = 'The code is wrong';
        }
    }
    
}