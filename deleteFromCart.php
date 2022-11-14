<?php
require_once('connect.php');
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $output = [
        'success' => true,
        'message' => ''
    ];

    $product_id = $_POST['product_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if($product_id && $user_id) {
        $db->query("DELETE FROM carts WHERE product_id = '".$db->real_escape_string($product_id)."' AND user_id = '".$db->real_escape_string($user_id)."'");
    } else {
        $output['success'] = false;
        $output['message'] = 'invalid data';
    }

    echo json_encode($output);
}


