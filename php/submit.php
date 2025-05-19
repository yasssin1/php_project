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
                // $sql = $link->prepare("INSERT INTO `products` (`ID`, `name`, `description`, `img`, `price`, `category`, `brand`) VALUES (NULL, ?, ?, NULL, ?, ?, ?)");

        $sql = $link->prepare("INSERT INTO `products` (`ID`, `name`, `description`, `img`, `price`, `category`, `brand`)
                                            VALUES (NULL, ?, ?, ?, ?, ?, ?)");
         $sql->bind_param("ssbiss", $prodName, $description, $prodImage, $prodPrice, $prodCat, $prodBrand);
        
        return $sql->execute() ? true : false ;
    }
?>