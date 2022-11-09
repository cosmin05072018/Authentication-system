<?php
require_once 'checkSession.php';
require_once('buttonsCart.php');
$cartsTable = $db->query("SELECT products.id, products.nameProduct, products.descriptionProduct, carts.product_id, carts.quantity, carts.unit_price FROM carts LEFT JOIN `products` ON carts.product_id =products.id");
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
    <?php if ($cartsTable->num_rows) : ?>
        <div class="products">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <?php while ($cart = $cartsTable->fetch_assoc()) { ?>
                    <tr>
                        <td scope="row"><?= $cart['id'] ?></td>
                        <td scope="row"><?= $cart['nameProduct'] ?></td>
                        <td scope="row">
                            <form method="POST">
                            <input type="hidden" name="id" value="<?= $cart['id'] ?? null; ?>">
                                <input name='decrement' type="submit" value="-">
                            <?= $cart['quantity'] ?>
                                <input name='increment' type="submit" value="+">
                            </form>
                        </td>
                        <td scope="row"><?= $cart['descriptionProduct'] ?></td>
                        <td scope="row"><?= $cart['unit_price'] ?></td>
                        <td scope="row"><i class="uil uil-atom"></i></td>
                        <td scope="row"><i class="uil uil-trash-alt"></i></td>
                    </tr>
                <?php }; ?>
            </table>
        </div>
    <?php else : ?>
        <div class="messageCart">
            <h1>Your Cart is Empty</h1>
        </div>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>