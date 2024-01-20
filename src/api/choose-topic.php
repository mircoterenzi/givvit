<?php 
   require_once("../db-config.php"); 
   require_once("../db/database.php");

   $templateParams["posts"] = $dbh->getPostsbyTopic($_POST['topic']);
?>