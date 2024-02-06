<?php
require_once("db-config.php");
$templateParams["title"] = "";
$templateParams["name"] = "show-open-post.php";
$templateParams["js"] = array("js/notification-viewed.js", "js/insert-post.js");
$templateParams["post_open"] = $dbh->getPostById($_GET["postId"]);
$templateParams["topics-list"] = $dbh->getTopics();

if ($templateParams["post_open"]["user_id"] == $_SESSION["userId"]) {
    if(intval($templateParams["post_open"]["numCom"]) > 0) array_push($templateParams["js"], "js/insert-response.js");
    array_push($templateParams["js"], "js/delete-post.js");
}else{
    array_push($templateParams["js"], "js/insert-comment.js");
    array_push($templateParams["js"], "js/import-donation.js");
    array_push($templateParams["js"], "js/star.js");
}
require("template/base.php");
?>