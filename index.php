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
    <?php include "./php/header.php"; ?>

    <!-- <div class = "main">
        <div class = "product">
        <form action = "./product.php" method="GET">
            <input type = "hidden" id="prodID" name="prodID" value = "12">
            <img src = "img/logo.png">
            <input class = "link" type = "submit" value = "Product name">
        </form>
            <form action = "" method="Post">
                <input type = "hidden" id="prodID" name="prodID" value = "12">
            <input class = "add" type = "submit" value = "+">
        </div>
    </div> -->

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