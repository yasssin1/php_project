<?php

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

function display_basket($userID) {
    global $link;

    // Modification de panier!!
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'] ?? '';
        $productID = intval($_POST['productID'] ?? 0);

        if ($action === 'add') {
            $link->query("UPDATE basket SET quantity = quantity + 1 WHERE userID = $userID AND prodID = $productID");
        } elseif ($action === 'subtract') {
            $result = $link->query("SELECT quantity FROM basket WHERE userID = $userID AND prodID = $productID");
            $row = $result->fetch_assoc();
            if ($row['quantity'] > 1) {
                $link->query("UPDATE basket SET quantity = quantity - 1 WHERE userID = $userID AND prodID = $productID");
            } else {
                $link->query("DELETE FROM basket WHERE userID = $userID AND prodID = $productID");
            }
        } elseif ($action === 'delete') {
            $link->query("DELETE FROM basket WHERE userID = $userID AND prodID = $productID");
        }
        header ("location: ./basket.php");
    }
    //
    //
    //
    $sql = "SELECT p.ID AS productID, p.name AS product_name, p.price, p.img, b.quantity
            FROM basket b
            INNER JOIN products p ON b.prodID = p.ID
            WHERE b.userID = ?";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='basket-container'>";
        while ($row = $result->fetch_assoc()) {
            $totalPrice = $row['price'] * $row['quantity'];

            echo "<form class='basket-item' method='POST'>";
            echo "<input type='hidden' name='productID' value='".$row['productID']."'>";
            if ($row['img']) {
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['img']) . "' alt='" . htmlspecialchars($row['product_name']) . "' class='product-image'>";
            } else {
                echo "<img src='img/logo.png' alt='Default Image'>";
            }

            echo "<div class='product-details'>";
            echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
            echo "<p>Price: " . number_format($row['price'], 2) . " dh</p>";
            echo "<p>Quantity: " . $row['quantity'] . "</p>";
            echo "</div>";
            
            echo "<div class='basket-buttons'>";
            echo "<button class='subtract' name='action' value='subtract'>–</button>";
            echo "<button class='add' name='action' value='add'>+</button>";
            echo "<button class='delete' name='action' value='delete'>×</button>";
            echo "</div>";

            
            echo "</form>";
        }
        echo "<p class = 'total' >Total: " . number_format($totalPrice, 2) . " dh</p>";
        echo '<form action = "./payment.php" method = "POST" class = "pay-container">
                <p>type de payement:</p>
                <select id="payMethod" name="payMethod">
                    <option value="card">carte bancaire</option>
                    <option value="delivery"> à la livraison</option>
                </select>
                <input type="hidden" name="productID" value="'.$totalPrice.'">
                <input type = "submit" value = "Payer" class = "pay-button">
                </form>';
        echo "</div>";
    } else {
        echo "<p>aucun produit trouver</p>";
    }
}

?>
