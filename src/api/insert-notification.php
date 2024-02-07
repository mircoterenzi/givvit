<?php
    require_once("../db-config.php");
    if(isset($_POST["not_type"], $_POST["receiver"]) && $_POST["receiver"] != $_SESSION["userId"]) {
        $post = isset($_POST["post_id"]) ? $_POST["post_id"] : null;
        $dbh->insertNotification($_POST["not_type"], $_SESSION["userId"], $_POST["receiver"], $post);
    }
?>