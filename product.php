<?php
session_start();
if (!isset($_GET["prodID"])){
    header("location: ./");
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
    <title>product</title>
</head>
<body>
    <?php
    include "./php/search.php";
    include "./php/basket.php";
    if (isset($_POST["amount"])){
        if (!isset($_SESSION["userID"])) {
            echo "<script>alert('login first'); window.location.href = './login.php';</script>";
            exit();
        } else {
            $id = $_GET["prodID"];
            $amount = $_POST["amount"];
            if (add_basket($id, $_SESSION["userID"], $amount)) {
                echo "<script>alert('added!'); window.location.href = './product.php?prodID=".$id."';</script>";
            }
        }
    }

    ?>
    <?php include "./php/header.php"; ?>
    <div class = "product-showcase">
        
    <?php
    $prod = search_one($_GET["prodID"], "ID", "products");
        $id = $prod["ID"];
        $name = htmlspecialchars($prod["name"]);
        $description = $prod["description"];
        $imgdata = $prod["img"];
        $price = $prod["price"];
        if ($imgdata != null) {
            $base64_img = base64_encode($imgdata);
            $img_tag = '<img src="data:image/jpeg;base64,' . $base64_img . '" alt="' . $name . '" />';
        } else {
            $img_tag = '<img src="img/logo.png" alt="Default Image">';
        }

        echo '
            <div class = "content">
                '.$img_tag.'
                <div class = "info">
                    <legend>'.$name.'</legend>
                    <p>
                        '.$description.'
                    </p>
                
                <form class = "basket" action="" method = "POST">
                    <input type="hidden" name="prodID" value="' . $id . '">
                    <input class="amount" type="number" name = "amount" value="1" min="1">
                    <input class="add" type="submit" value="+">
                </form>
                </div>
            </div>
        ';
    ?>
        <!-- <div class = "content">
            <img src = "img/logo.png" alt = "logo">
            <div class = "info">
                <legend>Title</legend>
                <p>
                    desc
                </p>
            </div>
        </div> -->
    </div>
    <?php include "./php/footer.php"; ?>

</body>
</html>