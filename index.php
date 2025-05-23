<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/product.css">
    <title>php project</title>
</head>
<body>
    <?php
    include "./php/search.php";
    include "./php/basket.php";
    if (isset($_POST["prodID"])){
        if (!isset($_SESSION["userID"])) {
            echo "<script>alert('login first'); window.location.href = './login.php';</script>";
            exit();
        } else {
            $id = $_POST["prodID"];
            $amount = 1;
            if (add_basket($id, $_SESSION["userID"], $amount)) {
                echo "<script>alert('added!'); window.location.href = './';</script>";
            }
        }
    }
    ?>
    <?php include "./php/header.php"; ?>

    <div class = "main">
    <?php
    ob_start();
    include "./php/display.php";
    $query = "SELECT * FROM products ORDER BY RAND() LIMIT 10";
    display_products($query);
    ?>
    </div>
    <?php include "./php/footer.php"; ?>
</body>
</html>