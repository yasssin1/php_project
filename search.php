<?php
if (($_GET["search_val"] ?? "") === "") {
    header('Location: ./');
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
    <link rel="stylesheet" href="./css/filter.css">
    <title>search</title>
</head>
<body>
    <?php include "./php/header.php"; ?>
        <div class = "filter" >
        <form action = "search.php">
            <label>sort by:</label>
            <select id="sortType" name="sortType">
            <option value="name">name</option>
            <option value="priceAC">price acsending</option>
            <option value="priceDC">price decending</option>
            </select>
            <input type="hidden" name="search_val" value="<?= htmlspecialchars($_GET['search_val'] ?? '') ?>">
            <input type = "submit" value="filter">
        </form>
    </div>
    <div class = "main">
        <?php include "./php/display.php"; ?>
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
        </form>
    </div>
    <?php include "./php/footer.php"; ?>
</body>
</html>