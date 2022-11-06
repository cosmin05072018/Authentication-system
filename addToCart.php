<?php
require_once("connect.php");
require_once("dataProducts.php");
session_start();
$errors = [];
// if (isset($_POST['submit']) && $_POST['submit']) {
//     $idProduct = $_POST; //tine ID-ul produsului de pe index.php
//     //query -> prroducts
//     $query = $db->query("SELECT * FROM products WHERE id = '$idProduct[id]'");
//     $row = $query->fetch_assoc(); //tine toate datele ID-ului de pe tabela products
//     // query -> carts
//     $carts = $db->query("SELECT * FROM carts WHERE product_id = '$idProduct[id]'");
//     $cart = $carts->fetch_assoc(); //tine toate datele de pe tabela carts
//     if (!$carts->num_rows) {
//         $db->query("INSERT INTO carts SET
//         user_id='" . $_SESSION['user']['id'] . "',
//         product_id='" . $row['id'] . "',
//         quantity= 1,
//         unit_price='" . $row['priceProduct'] . "'
//         ");
//     }
//     elseif ($carts->num_rows) {
//         if(!$cart['user_id'] && $idProduct['id']){
//             $db->query("INSERT INTO carts SET
//         user_id='" . $_SESSION['user']['id'] . "',
//         product_id='" . $row['id'] . "',
//         quantity= 1,    
//         unit_price='" . $row['priceProduct'] . "'
//         ");
//         }
//         if ($cart['user_id'] || $cart['product_id']){
//             $db->query("UPDATE carts SET
//         quantity= quantity + 1,
//         unit_price = unit_price + $row[priceProduct]
//         WHERE
//         product_id='$idProduct[id]' 
//         AND 
//         user_id='" . $_SESSION['user']['id'] . "'
//         ");   
//         }
        
//          else {
//             $db->query("INSERT INTO carts SET
//         user_id='" . $_SESSION['user']['id'] . "',
//         product_id='" . $row['id'] . "',
//         quantity= 1,    
//         unit_price='" . $row['priceProduct'] . "'
//         ");
//         }
//     }
//     header("Location: index.php");
// }



if(isset($_POST['submit']) && $_POST['submit']){
    $product_id=$_POST;  //tine id-ul produselor din tabela products  
    $products=$db->query("SELECT * FROM products WHERE id = '$product_id[id]'"); //tine detaliile produselor din tabela products  dupa id-ul din POST
    $product=$products->fetch_assoc();
    $cartTable=$db->query("SELECT * FROM carts WHERE product_id='$product_id[id]'  AND user_id='".$db->real_escape_string($_SESSION['user']['id'])."'");
    if($cartTable->num_rows){
        $db->query("UPDATE carts SET
        quantity= quantity + 1
        WHERE product_id='$product_id[id]'  AND user_id='".$db->real_escape_string($_SESSION['user']['id'])."' 
        ");
    }
    else{
        $query=$db->query("INSERT INTO carts SET
    user_id='".$db->real_escape_string($_SESSION['user']['id'])."',
    product_id='$product_id[id]',
    quantity=1,
    unit_price='$product[priceProduct]'
    ");
    }
}

header("Location: index.php");