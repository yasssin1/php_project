<?php
    include "./php/connection.php";

    $link = connect_connect();

    function search_one($keyword, $column, $table) {
        global $link;
        $sql = $link->prepare("SELECT * FROM $table WHERE $column = ?");
        $sql->bind_param("s", $keyword);
        $sql->execute();
        $res = $sql->get_result();

        $row = $res->fetch_assoc();

        return $row ? $row : false;
    }

    function search_two($keyword1, $keyword2, $column1, $column2, $table) {
        global $link;
        $sql = $link->prepare("SELECT * FROM $table WHERE $column1 = ? AND $column2 = ?");
        $sql->bind_param("ss", $keyword1, $keyword2);
        $sql->execute();
        $res = $sql->get_result();
        
        $row = $res->fetch_assoc();

        return $row ? $row : false;
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