<?php
require_once 'checkSession.php';
require_once('dataProducts.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="addProduct.css">
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
                <p class="nav-item nav-link">Hello, <?= $user['last_name']; ?></p>
                <a href="cart.php"><i class="uil uil-shopping-cart-alt"></i></a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        <?php } ?>
        </div>
    </nav>
    <div class="form">
        <form method="POST">
            <div class="mb-3">
                <label for="nameProduct" class="form-label">Name Product</label>
                <input type="text" class="form-control" name="nameProduct" value="<?= getPostData('nameProduct')?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="Text" class="form-control" name="quantity" value="<?= getPostData('quantity')?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" value="<?= getPostData('description')?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="Text" class="form-control" name="price" value="<?= getPostData('price')?>">
            </div>
            <input name="submit" type="submit" class="btn btn-primary" value="Submit">
            <p class="errors"><?= isset($error['message'])? $error['message']:'' ?></p>
        </form>
    </div>
</body>

</html>


