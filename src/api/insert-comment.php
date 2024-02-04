<?php
    require_once("../db-config.php");
    /**inserisco commento nel database */
    $dbh->insertComment($_POST["inputComment"], $_POST["postId"], $_SESSION["userId"]);
?>