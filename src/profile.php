<?php
require_once("db-config.php");
$templateParams["title"] = "Profile";
$templateParams["name"] = "show-profile.php";
$templateParams["profile"] = $dbh->getUserById($_GET["id"]);
$templateParams["js"] = array("js/notification-viewed.js", "js/manage-follow.js", "utils/functions.js");
$templateParams["topics-list"] = $dbh->getTopics();
if(empty($_GET["type"])) {
    $_GET["type"] = "posted";
}
require("template/base.php");
?>