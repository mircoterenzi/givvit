<?php
require_once("db-config.php");
$templateParams["title"] = "Explore";
$templateParams["name"] = "show-explore.php"; 
$templateParams["topics-list"] = $dbh->getTopics();
$templateParams["js"] = array("js/notification-viewed.js", "utils/functions.js", "js/star.js", "js/insert-post.js", "js/open-post.js");
if(empty($_GET["topic"])) {
    $templateParams["posts"] = $dbh->getAllPosts($_GET['n']);
} else {
    $templateParams["posts"] = $dbh->getPostsbyTopic($_GET["topic"],$_GET['n']);
}
require("template/base.php");
?>
