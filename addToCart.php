<?php
require_once("connect.php");
require_once("dataProducts.php");
session_start();
$errorStock = [];
// if (isset($_SESSION['user'])) {
    if (isset($_POST['submit']) && $_POST['submit']) {
        if (isset($_POST['id']) && $_POST['id']) {
            $product_id = $_POST ?? null;  //tine id-ul produselor din tabela products
        }
        if ($_POST['id'] === $product_id['id']) {
            $products = $db->query("SELECT * FROM products WHERE id = '".$db->real_escape_string($product_id['id'])."'"); //tine detaliile produselor din tabela products  dupa id-ul din POST
            $product = $products->fetch_assoc();
            $cartTable = $db->query("SELECT * FROM carts WHERE product_id='".$db->real_escape_string($product_id['id'])."'  AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'");
            $cart = $cartTable->fetch_assoc();
            if ($cartTable->num_rows) {
                if ($cart['quantity'] >= $product['quantityProduct']) {
                    $errorStock['status'] = 'Stock has been sold out.';
                } else {
                    $db->query("UPDATE carts SET
                quantity= quantity + 1,
                unit_price = unit_price + '".$db->real_escape_string($product['priceProduct'])."'
                WHERE product_id='$product_id[id]'  AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "' 
                ");
                }
            } else {
                $query = $db->query("INSERT INTO carts SET
    user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "',
    product_id='" . $db->real_escape_string($product_id['id']) . "',
    quantity=1,
    unit_price='" . $db->real_escape_string($product['priceProduct']) . "'
    ");
            }
        } else {
            $error['message'] = 'ID wrong';
        }
    }
//}