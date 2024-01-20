<?php 
   include '../db/database.php';

   if(isset($_POST['topic'])) { 
      require_once("db-config.php");
      $templateParams["posts"] = $dbh->getPostsbyTopic($_POST['topic']);
      require("explore-with-topic.php");
   }
   header('Content-Type: application/json');
   echo json_encode($result);
?>