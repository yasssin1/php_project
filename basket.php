<?php session_start(); ?>
<?php
    if (!isset($_SESSION["userID"])) {
        echo "<script>alert('login first'); window.location.href = './login.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/basket.css">
    <title>php project</title>
</head>
<body>

    <?php include "./php/header.php"; ?>
    <div class = "main">
    <?php
    ob_start();
    include "./php/connection.php";
    include "./php/display.php";
    display_basket($_SESSION["userID"]);
    ?>
    </div>
    <?php include "./php/footer.php"; ?>
</body>
</html>