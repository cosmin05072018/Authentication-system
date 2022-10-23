<?php

require_once("connect.php");

// The values ​​from the inputs

$fName = $_POST['firstName'];
$lName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];




$db->query("INSERT INTO users SET 
first_name = '$fName',
last_name = '$lName',
email = '$email',
password = '$password'
");