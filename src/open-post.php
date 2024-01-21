<?php
require_once("db-config.php");
$templateParams["title"] = "Open-post";
$templateParams["name"] = "show-open-post.php";
$templateParams["post_open"] = $dbh->getPostById(1);

require("template/base.php");
?>