<?php
require_once("db-config.php");

$templateParams["title"] = "Explore";
$templateParams["name"] = "show-explore.php";
$templateParams["topics"] = $dbh->getTopics();

require("template/base.php");
?>
