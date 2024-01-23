<?php
if($_POST["type"] == "follow") {
    require_once("../db-config.php");
    $dbh->followUser($_SESSION["userId"], $_POST["id"]);
} else {
    require_once("../db-config.php");
    $dbh->unfollowUser($_SESSION["userId"], $_POST["id"]);
}
?>