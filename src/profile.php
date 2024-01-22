<?php
require_once("db-config.php");
$templateParams["title"] = "Profile";
$templateParams["name"] = "show-profile.php";
$templateParams["profile"] = $dbh->getUserById($_SESSION["userId"]);
$templateParams["js"] = array("js/notification-viewed.js", "js/post-selection.js", "utils/functions.js");

if (!isset($_SESSION["post-type"])):
    $_SESSION["post-type"] = "Posted";
endif;
require("template/base.php");

?>