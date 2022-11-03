<?php
require_once("connect.php");
$error = [];

function getPostData($key){
    return isset($_POST[$key])? $_POST[$key]:'';
}

if (isset($_POST['submit']) && $_POST['submit']){
    $nameProduct = $_POST['nameProduct'] ?? null;
    $quantity = $_POST['quantity']?? null;
    $description = $_POST['description']?? null;
    $price = $_POST['price']?? null;

    if (!$nameProduct || !$quantity || !$description || !$price) {
        $error['message'] = 'All input is required';
    }elseif(!is_numeric($quantity) || !is_numeric($price)){
        $error['message'] = 'Please enter a numeric value';
    }elseif(!$error){
        $query=$db->query("SELECT nameProduct FROM products WHERE nameProduct= '".$db->real_escape_string($nameProduct)."'");
        if($query->num_rows){
            $error['message'] = 'The product already exists';
        }else {
            $db->query("INSERT INTO products SET
        nameProduct='".$db->real_escape_string($nameProduct)."',
        quantityProduct='".$db->real_escape_string($quantity)."',
        descriptionProduct='".$db->real_escape_string($description)."',
        priceProduct='".$db->real_escape_string($price)."'
        ");
        header("Location: index.php?response=success");
        }
    }
}
