<?php
require_once("db-config.php");
$templateParams["posts"] = $dbh->getAllPosts();
require("explore-with-topic.php");
?>
