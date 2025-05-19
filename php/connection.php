<?php

function connect_connect() {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "php-store-project_db";
    $con = "";

    $con = mysqli_connect ($server, $user, $pass, $dbname);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}
?>