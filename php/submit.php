<?php
    include "./php/connection.php";

    $link = connect_connect();

    function submit_account($name, $pass, $email) {
        global $link;
        $sql = $link->prepare("INSERT INTO `accounts` (`ID`, `name`, `password`, `email`, `type`) VALUES (NULL, ?, ?, ?, 'standard')");
        $sql->bind_param("sss", $name, $pass, $email);
        
        return $sql->execute() ? true : false ;
    }
?>