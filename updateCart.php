<?php
require_once('connect.php');
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user']['id']) && $_SESSION['user']['id']) {
        $products = $_POST['products'] ?? null;
        if($products) {
            foreach ($products as $product) {

                if(!isset($product['id']) || !is_numeric($product['id']) || !isset($product['quantity']) || !is_numeric($product['quantity'])) {
                    $error[$product['id']]['message'] = 'Invalid data!';
                    continue;
                }

                $productsTable = $db->query("SELECT * FROM products WHERE id = '" . $db->real_escape_string($product['id']) . "'");
                $productT = $productsTable->fetch_assoc();
                if ($product['quantity'] > $productT['quantityProduct']) {
                    $message = " Sunt doar $productT[quantityProduct] bucati pentru produsul $productT[nameProduct]";
                    $error[$product['id']]['message'] = $message;
                    continue;
                }

                    if($product['quantity'] > 0) {
                        $db->query("UPDATE carts SET
                        quantity = '" . $db->real_escape_string($product['quantity']) . "'
                        WHERE product_id = '" . $db->real_escape_string($product['id']) . "'
                        AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'");
                    } else if($product['quantity'] < 0) {
                        $db->query("UPDATE carts SET
                        quantity = 1
                        WHERE product_id = '" . $db->real_escape_string($product['id']) . "'
                        AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'");
                    } else {
                        $db->query("DELETE FROM carts
                        WHERE product_id = '" . $db->real_escape_string($product['id']) . "'
                        AND user_id='" . $db->real_escape_string($_SESSION['user']['id']) . "'");
                    }
                    
              
            }
        }
    }
}
