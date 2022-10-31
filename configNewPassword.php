<?php
require_once("connect.php");

// Verificam sa existe token in URL
// Verificam sa nu fie gol token-ul
$error = false;
if(!isset($_GET['token']) || !$_GET['token']) {
    $error = true;
    $error_message = 'Invalid token';
} else {
    // Preluam user-ul dupa token
    $user = $db->query("SELECT * FROM users WHERE reset_password_token = '".$db->real_escape_string($_GET['token'])."'");
    $row = $user->fetch_assoc();

    // Daca nu exista user returnam eroare
    if(!$row) {
        $error = true;
        $error_message = 'Invalid token';
    }
}





$message =[];
if(isset($_POST['newPassword'])) {
    $token = $_POST['token'] ?? null; // daca nu e setat returneaza null
    $newPassword =$_POST['newPassword'];
    $newPasswordConfirm = $_POST['newPasswordConfirm'];
    if(!$newPassword || !$newPasswordConfirm){
        $message['error'] = 'Input required';
    }
    elseif($newPassword != $newPasswordConfirm){
        $message['error'] = 'Password not match';
    } elseif (!$token) {
        $message['error'] = 'Invalid token';
    } else{

        // Verificam din nou userul ca poate da inspect si schimba token-ul.
        $query = $db->query("SELECT * FROM users WHERE reset_password_token = '".$db->real_escape_string($token)."'");

        if(!$query->num_rows) {
            $message['error'] = 'Invalid token';
        } else {
            $passHash = password_hash($newPassword, PASSWORD_DEFAULT);

            // daca nu faci nimic cu $query dupa, nu e nevoie sa il declari.. se numeste variabila redundanta.
            $db->query("UPDATE users SET 
            password = '" . $db->real_escape_string($passHash) . "',
            reset_password_token = NULL
            WHERE reset_password_token = '".$db->real_escape_string($token)."'");

            header("Location: login.php");
        }


       
    }
}