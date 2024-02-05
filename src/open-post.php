<?php
require_once("db-config.php");
$templateParams["title"] = "Open-post";
$templateParams["name"] = "show-open-post.php";
$templateParams["js"] = array("js/notification-viewed.js", "js/star.js", "js/insert-comment.js", "js/import-donation.js");
$templateParams["post_open"] = $dbh->getPostById($_GET["postId"]);

require("template/base.php");
?>