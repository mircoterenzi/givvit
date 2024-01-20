<?php
require_once("db-config.php");
if(!isset($_SESSION["userId"])) {
  // Show login page if there's not an open session
  $templateParams["title"] = "Login";
  $templateParams["name"] = "show-login.php";

  require("template/access.php");
} else {
  // Show homepage if the user is already logged
  $templateParams["title"] = "Home";
  $templateParams["name"] = "show-post.php";
  $templateParams["posts"] = $dbh->getHomeForUser($_SESSION["userId"]);

  require("template/base.php");
}
?>