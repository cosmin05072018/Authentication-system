<?php
session_start();
$message =[];
if(isset($_POST['newPassword'])){
    $newPassword =$_POST['newPassword'];
    $newPasswordConfirm = $_POST['newPasswordConfirm'];
    if(!$newPassword || !$newPasswordConfirm){
        $message['error'] = 'Input required';
    }
    elseif($newPassword != $newPasswordConfirm){
        $message['error'] = 'Password not match';
    }
    else{
        $passHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = $db->query("UPDATE users SET
        password = '" . $db->real_escape_string($passHash) . "'");
        $query = $db->query("UPDATE users SET 
        reset_password_token = NULL
        WHERE email = '$_SESSION[email]'");
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}