<?php
require_once("db-config.php");

$templateParams["title"] = "Explore";
$templateParams["name"] = "show-explore.php"; 
$templateParams["topics-list"] = $dbh->getTopics();
$templateParams["js"] = array("js/choose-topic.js", "utils/functions.js");

if ($_SESSION['topic'] == "All"):
    $templateParams["posts"] = $dbh->getAllPosts();
else:
    $templateParams["posts"] = $dbh->getPostsbyTopic($_SESSION['topic']);
endif;

require("template/base.php");
?>
