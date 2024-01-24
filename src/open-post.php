<?php
require_once("db-config.php");
$templateParams["title"] = "Open-post";
$templateParams["name"] = "show-open-post.php";
$templateParams["js"] = array("js/star.js");
$templateParams["post_open"] = $dbh->getPostById($_GET["postId"]);

require("template/base.php");
?>