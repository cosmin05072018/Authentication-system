<?php
require_once('connect.php');
//set cookie and session
session_start();
if(isset($_POST)){
    if(isset($_POST['remember_me'])){
        $token=uniqid();
        setcookie('token', $token, time() +3600, '/');
        $db = new mysqli('localhost', 'root', '', 'myprojects');
                $db->query("UPDATE users SET 
                remember_token = '$token'
                WHERE email='$_POST[email] '
                ");
    }
    $_SESSION['email'] = $_POST['email'];
}
require_once("connect.php");
$emailAdress = $_POST['email'];
$password = $_POST['password'];
$lName = $_POST['lastName'];
//verificam dupa mail
if(isset($_POST['email'])){
    $query= $db->query("SELECT * FROM users WHERE email = '$emailAdress'");
    $row = $query->fetch_array();
    
    if(empty($emailAdress) || empty($password) ){
        header("Location: login.php?signin=inputRequired&email=$emailAdress");
        exit();
    }else{
        if (!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
            header("Location: login.php?signin=emailError&email=$emailAdress");
            exit();
        }elseif(mysqli_num_rows($query) == 0){
            header("Location: login.php?signin=accountNotExist&email=$emailAdress");
            exit();
        } elseif(mysqli_num_rows($query) == 1){
            if(password_verify( $_POST['password'], $row['password'])){
                header("Location: home.php?signin=succes");
            exit();
            }
            else{
                header("Location: login.php?signin=incorrectly&email=$emailAdress");
            }
        }else{
            header("Location: login.php?signin=noAccount");
            exit();
        }
    }
}




        