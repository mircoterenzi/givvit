<?php
require_once("db-config.php");
$templateParams["title"] = "Open-post";
$templateParams["name"] = "show-open-post.php";
$templateParams["js"] = array("js/notification-viewed.js", "js/star.js", "js/insert-comment.js", "js/import-donation.js");
$templateParams["post_open"] = $dbh->getPostById($_GET["postId"]);
$templateParams["topics-list"] = $dbh->getTopics();

if ($templateParams["post_open"]["user_id"] == $_SESSION["userId"] && intval($templateParams["post_open"]["numCom"]) > 0) {
    array_push($templateParams["js"], "js/insert-response.js");
}

require("template/base.php");
?>