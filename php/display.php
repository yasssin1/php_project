<?php

include "./php/search.php";
$link = connect_connect();

function display_products($search_query) {
    global $link;
    $query_result = mysqli_query($link, $search_query);
    
    while ($prod = mysqli_fetch_assoc($query_result)) {
        $id = $prod["ID"];
        $name = htmlspecialchars($prod["name"]);
        $imgdata = $prod["img"];
        $price = $prod["price"];

        if ($imgdata != null) {
            $base64_img = base64_encode($imgdata);
            $img_tag = '<img src="data:image/jpeg;base64,' . $base64_img . '" alt="' . $name . '" />';
        } else {
            $img_tag = '<img src="img/logo.png" alt="Default Image">';
        }

        echo '
            <div class="product">
                <form action="./product.php" method="GET">
                    <input type="hidden" name="prodID" value="' . $id . '">
                    ' . $img_tag . '
                    <input class="link" type="submit" value="' . $name . '">
                </form>
                <p>'.$price.' dh</p>
                <form action="" method="POST">
                    <input type="hidden" name="prodID" value="' . $id . '">
                    <input class="add" type="submit" value="+">
                </form>
            </div>
        ';
    }
}
?>


    <!-- <div class = "main">
        <div class = "product">
        <form action = "./product.php" method="GET">
            <input type = "hidden" id="prodID" name="prodID" value = "12">
            <img src = "img/logo.png">
            <input class = "link" type = "submit" value = "Product name">
        </form>
        <p>1300 dh</p>
            <form action = "" method="Post">
                <input type = "hidden" id="prodID" name="prodID" value = "12">
            <input class = "add" type = "submit" value = "+">
        </div>
    </div> -->