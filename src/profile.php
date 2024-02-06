<?php
require_once("db-config.php");
$templateParams["title"] = "Profile";
$templateParams["name"] = "show-profile.php";
$templateParams["js"] = array("js/notification-viewed.js", "utils/functions.js", "js/star.js", "js/insert-post.js", "js/open-post.js");
$templateParams["topics-list"] = $dbh->getTopics();
if(empty($_GET["type"])) {
    $_GET["type"] = "posted";
}
if(empty($_GET["id"])) {
    $_GET["id"] = $_SESSION["userId"];
    array_push($templateParams["js"], "js/modify-profile.js");
}else{
    array_push($templateParams["js"], "js/manage-follow.js");
}
$templateParams["profile"] = $dbh->getUserById($_GET["id"]);
require("template/base.php");
?>