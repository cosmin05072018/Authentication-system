<?php
require_once('connect.php');

if (isset($_POST) && $_POST) {
    if (isset($_POST['id']) && $_POST['id']) {
        $cartId = $_POST['id'];
    }
    $products = $db->query("SELECT * FROM products WHERE id = '" . $db->real_escape_string($cartId) . "'"); //tine detaliile produselor din tabela products  dupa id-ul din POST
    $product = $products->fetch_assoc();
    $cartTable = $db->query("SELECT * FROM carts WHERE product_id='" . $db->real_escape_string($cartId) . "'  AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'");
    $cart = $cartTable->fetch_assoc();
    if (isset($_POST['increment']) && $_POST['increment']) {
        $increment = $_POST['increment'];
        $db->query("UPDATE carts 
        SET quantity = quantity + 1,
        unit_price = unit_price + '" . $db->real_escape_string($product['priceProduct']) . "'
        WHERE product_id = $cartId
        AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'
        ");
    }

    if (isset($_POST['decrement']) && $_POST['decrement']) {
        $decrement = $_POST['decrement'];
        $db->query("UPDATE carts 
        SET quantity = quantity - 1,
        unit_price = unit_price - '" . $db->real_escape_string($product['priceProduct']) . "'
        WHERE product_id = $cartId
        AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'
        ");
    }
}
