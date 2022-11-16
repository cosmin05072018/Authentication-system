<?php
require_once ('checkSession.php');
require_once('updateCart.php');
require_once('placeOrders.php');
if (isset($_SESSION['user']['id']) && $_SESSION['user']['id']) {
    $cartsTable = $db->query("SELECT products.id, products.nameProduct, carts.quantity, carts.unit_price, carts.user_id 
    FROM carts 
    LEFT JOIN `products` ON carts.product_id =products.id 
    WHERE carts.user_id ='" . $db->real_escape_string($_SESSION['user']['id']) . "'");
    $totalPrice = $db->query("SELECT SUM(unit_price * quantity) 
    FROM carts
    WHERE carts.user_id ='" . $db->real_escape_string($_SESSION['user']['id']) . "'
    ");
    $row = $totalPrice->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="homePage.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="index.php" class="navbar-brand">Brand<b>Name</b></a>
        <?php
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        if (!$user) { ?>
            <div class="navbar-nav ml-auto action-buttons">
                <p class="nav-item nav-link">You are not connected...</p>
                <div class="nav-item">
                    <a href="registration.php" class="btn btn-primary sign-up-btn">Registration</a>
                </div>
                <div class="nav-item">
                    <a href="login.php" class="btn btn-primary sign-up-btn">Log In</a>
                </div>
            </div>
        <?php } else { ?>
            <div class="navbar-nav ml-auto action-buttons">
                <p class="nav-item nav-link">Shopping Cart</p>
                <p class="nav-item nav-link"><a href="index.php">Back to Home</a></p>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        <?php } ?>
        </div>
    </nav>
    <?= isset($errorStock['status']) ? $errorStock['status'] : '' ?>
    <?php if ($cartsTable->num_rows) : ?>
        <form method="POST">
            <div class="products">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">unit Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <?php
                    $num = 0;
                    while ($cart = $cartsTable->fetch_assoc()) {
                    ?>
                        <tr class="product-row" data-productId="<?= $cart['id'] ?>">
                            <td scope="row"><?= $cart['id'] ?></td>
                            <td scope="row"><?= $cart['nameProduct'] ?></td>
                            <td scope="row">
                                <input type="hidden" name="products[<?= $num; ?>][id]" value="<?= $cart['id'] ?? null; ?>">
                                <input type="number" min="1" name="products[<?= $num; ?>][quantity]" value="<?= $cart['quantity'] ?? 1; ?>">
                                <?php if (isset($error[$cart['id']]['message']) && $error[$cart['id']]['message']) : ?>
                                    <p><?= $error[$cart['id']]['message']; ?></p>
                                <?php endif; ?>
                            </td>
                            <td scope="row"><?= number_format($cart['unit_price'], 2, '.', '') ?> $</td>
                            <td scope="row"><?= number_format($cart['unit_price'] * $cart['quantity'], 2, '.', '') ?> $</td>
                            <td scope="row">
                                <div class="delete-product" data-id="<?= $cart['id']; ?> "><i class="uil uil-trash-alt"></i></div>
                            </td>

                        </tr>
                    <?php $num++;
                    };
                    ?>
                </table>
                <div class="update">
                    <input type="submit" value="Update Cart" name="update" class="inputUpdate">
                </div>
                <div class="totalPrice">
                    <h3>Total price: <?php foreach ($row as $rows) {echo $rows;} ?> $</h3>
                </div>
                <br>
                <div class="placeOrder">
                    <input type="submit" value="Place Order" name="placeOrder" class="inputPlaceOrder">
                </div>

            </div>
        </form>

    <?php else : ?>
        <div class="messageCart">
            <h1>Your Cart is Empty</h1>
        </div>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $('body').on('click', '.delete-product', function() {
            const id = $(this).attr('data-id');

            if (id) {
                $.ajax({
                    url: "deleteFromCart.php",
                    type: "POST",
                    data: {
                        product_id: id,
                        user_id: <?= $_SESSION['user']['id']; ?>
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            $(`tr.product-row[data-productId=${id}]`).remove();
                            window.location.reload();
                        }
                    }
                })
            }
        })
    </script>
</body>

</html>