<?php
    $link = connect_connect();

    function add_basket($prodid, $userid, $amount) {
        global $link;
        $check_sql = $link->prepare("SELECT * FROM `basket` WHERE `userID` = ? AND `prodID` = ?");
        $check_sql->bind_param("ii", $userid, $prodid);
        $check_sql->execute();
        $result = $check_sql->get_result();

        if ($result->num_rows > 0) {
            // cas de produit existe
            $update_sql = $link->prepare("UPDATE `basket` SET `quantity` = `quantity` + ? WHERE `userID` = ? AND `prodID` = ?");
            $update_sql->bind_param("iii", $amount, $userid, $prodid);
            return $update_sql->execute() ? true : false;
        } else {
            // cas ou il n'existe pas
            $insert_sql = $link->prepare("INSERT INTO `basket` (`userID`, `prodID`, `quantity`) VALUES (?, ?, ?)");
            $insert_sql->bind_param("iii", $userid, $prodid, $amount);
            return $insert_sql->execute() ? true : false;
        }
    }
?>