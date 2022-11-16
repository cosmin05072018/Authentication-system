<?php
require_once('connect.php');

if (isset($_POST['placeOrder']) && $_POST['placeOrder'] && isset($_SESSION['user']['id']) && $_SESSION['user']['id']) {
    $id = $_POST['products'];
    $totalPrice = $db->query("SELECT SUM(unit_price * quantity) 
    FROM carts
    WHERE carts.user_id ='" . $db->real_escape_string($_SESSION['user']['id']) . "'
    ");
        $row = $totalPrice->fetch_assoc();
        foreach ($row as $rows);
    $ordersTable = $db->query("SELECT * FROM orders WHERE user_id= '".$db->real_escape_string($_SESSION['user']['id'])."' ");
    $orders = $ordersTable->fetch_assoc();
    if ($ordersTable->num_rows) {
        $db->query("UPDATE orders SET
        total_value = '" . $rows . "'
        WHERE user_id = '" . $db->real_escape_string($_SESSION['user']['id'])."'
        ");
    } else {
        $db->query("INSERT INTO orders SET    
        user_id ='" . $_SESSION['user']['id'] . "',
        total_value = '" . $rows . "'
        ");
    }
}
