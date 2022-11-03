<?php
require_once("connect.php");
session_start();
if(isset($_GET['id']) && $_GET['id']){
    //query -> id products
    $query = $db->query("SELECT * FROM products WHERE id = '".$_GET['id']."'");
    $row=$query->fetch_assoc(); 
    // query -> id users
    $users=$db->query("SELECT * FROM users WHERE id = '".$_SESSION['user']['id']."'");
    $user=$users->fetch_assoc();
    // query -> insert in carts
    $db->query("INSERT INTO carts SET
    user_id='".$user['id']."',
    product_id='".$row['id']."',
    quantity='".$row['quantityProduct']."',
    unit_price='".$row['priceProduct']."'
    ");
    header("Location: index.php");
}

