<?php
require_once("db-config.php");

if(!isset($_SESSION["userId"])) {
  // @todo: show registration page if there's not an open session
} else {
  // @todo show homepage
}

//for the moment i will redirect automatically on homepage
$templateParams["title"] = "Home";
$templateParams["name"] = "show-post.php";

require("template/base.php");
?>