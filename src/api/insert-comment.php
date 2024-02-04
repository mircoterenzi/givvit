<?php

    require_once("../db-config.php");
    $dbh->insertComment($_POST["inputComment"], $_POST["postId"], $_SESSION["userId"]);

?>