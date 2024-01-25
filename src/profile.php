<?php
require_once("db-config.php");
$templateParams["title"] = "Profile";
$templateParams["name"] = "show-profile.php";
$templateParams["js"] = array("js/notification-viewed.js", "js/manage-follow.js", "utils/functions.js", "js/modify-profile.js");
$templateParams["topics-list"] = $dbh->getTopics();
if(empty($_GET["type"])) {
    $_GET["type"] = "posted";
}
if(empty($_GET["id"])) {
    $_GET["id"] = $_SESSION["userId"];
}
$templateParams["profile"] = $dbh->getUserById($_GET["id"]);
require("template/base.php");
?>