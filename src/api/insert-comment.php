<?php
    require_once("../db-config.php");
    $result["insertDone"] = false;
    $result["error"] = "ok";
    /**inserisco commento nel database */
    if(isset($_POST["inputComment"])) {
        if(isset($_POST["postId"])) {
            $dbh->insertComment($_POST["inputComment"], $_POST["postId"], $_SESSION["userId"]);
            $result["insertDone"] = true;
        }else{
            $result["error"] = "postId empty";
        }
    }else{
        $result["error"] = "comment empty";
    }

   header('Content-Type: application/json');
   echo json_encode($result);
?>