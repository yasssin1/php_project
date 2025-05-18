<?php
if (($_GET["search_val"] ?? "") === "") {
    header('Location: index.php');
    die();
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
    <title>search</title>
</head>
<body>
    <?php include "./php/header.php"; ?>
    <div class = "main">
        <?php include "./php/display.php"; ?>
        <a href="item.html" class = "product">
            <img src = "img/logo.png">
            <span>text</span>
        </a>
    </div>
    <?php include "./php/footer.php"; ?>
</body>
</html>