<?php
    require_once("../db-config.php");
    $result["insertDone"] = false;
    $result["error"] = "ok";
    $responseId = 0;
    /**inserisco commento nel database */
    if(isset($_POST["inputComment"], $_POST["postId"], $_POST["comment_id"]) && !empty($_POST["inputComment"])) {
        $responseId = $dbh->insertComment($_POST["inputComment"], $_POST["postId"], $_SESSION["userId"]);
        if ($responseId != 0) {
            if ($dbh->insertCommentResponse($_POST["postId"], $_POST["comment_id"], $responseId)) {
                $result["insertDone"] = true;
            } else {
                $result["error"] = "Failed to update response.";
            }
        } else {
            $result["error"] = "Failed to insert comment.";
        }
        $result["insertDone"] = true;
    }else{
        $result["error"] = "comment can't be empty";
    }

   header('Content-Type: application/json');
   echo json_encode($result);
?>