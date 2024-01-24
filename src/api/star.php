<?php
if($_POST["type"] == "liked") {
    require_once("../db-config.php");
    $dbh->insertLike($_POST["postid"], $_SESSION["userId"]);
} else {
    require_once("../db-config.php");
    $dbh->removeLike($_POST["postid"], $_SESSION["userId"]);
}
?>