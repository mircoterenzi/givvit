<?php
require_once("db-config.php");
$templateParams["title"] = "Explore";
$templateParams["name"] = "show-explore.php"; 
$templateParams["topics-list"] = $dbh->getTopics();
$templateParams["js"] = array("js/notification-viewed.js", "js/choose-topic.js", "utils/functions.js");
if(empty($_GET["topic"])) {
    $templateParams["posts"] = $dbh->getAllPosts();
} else {
    $templateParams["posts"] = $dbh->getPostsbyTopic($_GET["topic"]);
}
require("template/base.php");
?>
