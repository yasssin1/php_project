<?php

function display_products($querey_result) {
    while ($prod = mysqli_fetch_assoc($querey_result)){
        $name = htmlspecialchars($prod["nom"]);
        $desc = htmlspecialchars($prod["desc"]);

        echo "<a href='product.php' class = 'product'>
            <img src = 'img/logo.png'>
            <span>{$name}</span>
        </a>";
    }
}
?>