<?php
require_once("db-config.php");
$templateParams["title"] = "Open-post";
$templateParams["name"] = "show-open-post.php";
$templateParams["post_open"] = $dbh->getPostById($_GET["postId"]);

require("template/base.php");
?>