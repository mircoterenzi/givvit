<?php
    require_once("../db-config.php");
    $result["insertDone"] = false;
    $result["error"] = "ok";
    /**inserisco commento nel database */
    if(isset($_POST["inputComment"], $_POST["postId"]) && !empty($_POST["inputComment"])) {
        $dbh->insertComment($_POST["inputComment"], $_POST["postId"], $_SESSION["userId"]);
        $result["insertDone"] = true;
    }else{
        $result["error"] = "comment can't be empty";
    }

   header('Content-Type: application/json');
   echo json_encode($result);
?>