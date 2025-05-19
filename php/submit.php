<?php
    include "./php/connection.php";

    $link = connect_connect();

    function submit_account($name, $pass, $email) {
        global $link;
        $sql = $link->prepare("INSERT INTO `accounts` (`ID`, `name`, `password`, `email`, `type`) VALUES (NULL, ?, ?, ?, 'standard')");
        $sql->bind_param("sss", $name, $pass, $email);
        
        return $sql->execute() ? true : false ;
    }
    function submit_product($prodName, $description, $prodImage, $prodPrice, $prodCat, $prodBrand) {
        global $link;

        $sql = $link->prepare("INSERT INTO `products` (`ID`, `name`, `description`, `img`, `price`, `category`, `brand`)
                                            VALUES (NULL, ?, ?, ?, ?, ?, ?)");
         $sql->bind_param("sssiss", $prodName, $description, $prodImage, $prodPrice, $prodCat, $prodBrand);
        
        return $sql->execute() ? true : false ;
    }
    function edit_product($prodID, $column, $new_val) {
        global $link;

        if ($column == 'price') {
        $sql = $link->prepare("UPDATE `products` SET `price` = ? WHERE `products`.`ID` = ?");
        $sql->bind_param("ii", $new_val, $prodID);
    } else {
        $sql = $link->prepare("UPDATE `products` SET `$column` = ? WHERE `products`.`ID` = ?");
        $sql->bind_param("si", $new_val, $prodID);
    }
        return $sql->execute() ? true : false ;
    }
    function delete_product($prodID) {
        global $link;
        $sql = $link->prepare("DELETE FROM products WHERE `products`.`ID` = ?");
        $sql->bind_param("i", $prodID);
        return $sql->execute() ? true : false ;
    }
    
    function existsDB($keyword, $column, $table) {
        global $link;
        $sql = $link->prepare("SELECT * FROM $table WHERE $column = ?");
        $sql->bind_param("s", $keyword);
        $sql->execute();
        $res = $sql->get_result();

        $row = $res->fetch_assoc();

        return $row ? true : false;
    }
?>