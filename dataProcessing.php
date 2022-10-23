<?php


function validate()
{
    $db = new mysqli('localhost', 'root', '', 'myprojects');
    // if(empty($_POST['firstName']) && empty($_POST['lastName']) && empty($_POST['email']) && empty($_POST['password'])){
    //     echo "<p>Required Fields!</p>";   
    // }elseif($_POST['passwordConfirm'] !== $_POST['password']){
    //     echo "<p>The password is not the same!</p>";
    // }else{
    // $fName = $_POST['firstName'];
    // $lName = $_POST['lastName'];
    // $email = $_POST['email'];
    // $password = $_POST['password'];
    // $passHash= password_hash($password, PASSWORD_DEFAULT);



    // $db->query("INSERT INTO users SET 
    // first_name = '$fName',
    // last_name = '$lName',
    // email = '$email',
    // password = '$passHash'
    // ");

    // header("Location: login.php");
    // }

    if (isset($_POST['submit'])) {
        //check first_name
        if(empty($_POST['firstName']) || $_POST['firstName'] < 3){
            $errorLname='The field is required and must contain at least 3 characters!';
        }
        //check last_name

        //check email

        //check password & confirm password
    }
};




























// function validate()
// {
//     $db = new mysqli('localhost', 'root', '', 'myprojects');
//     if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password'])) {
//         $fName = $_POST['firstName'];
//         $lName = $_POST['lastName'];
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         $passHash = password_hash($password, PASSWORD_DEFAULT);
//         $db->query("INSERT INTO users SET 
//     first_name = '$fName',
//     last_name = '$lName',
//     email = '$email',
//     password = '$passHash'
//     ");

//         header("Location: login.php");
//     } elseif (empty($_POST['firstName']) && empty($_POST['lastName']) && empty($_POST['email']) && empty($_POST['password'])) {
//         echo "<p>Required Fields!</p>";
//         //header("Location: registration.php");
//     }
// }
