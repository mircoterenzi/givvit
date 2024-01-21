<?php
require_once("db-config.php");

$templateParams["title"] = "Explore";
$templateParams["name"] = "show-explore.php";
$templateParams["topics"] = $dbh->getTopics();
$templateParams["js"] = array("js/choose-topic.js");

require("template/base.php");
?>
