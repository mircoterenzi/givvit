<?php
    require_once("../db-config.php");
    /**inserisco commento nel database */
    if(isset($_POST["not_type"], $_POST["receiver"])) {
        $post = isset($_POST["post_id"]) ? $_POST["post_id"] : null;
        $dbh->insertNotification($_POST["not_type"], $_SESSION["userId"], $_POST["receiver"], $post);
    }
?>