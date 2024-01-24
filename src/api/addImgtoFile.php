<?php
    require_once("../db-config.php");

    $result["uploadDone"] = false;
    $result["errorInUpload"] = "ok";

    if (isset($_POST["postId"]) && isset($_POST["fileName"])) {

        if (!$dbh->insertFile($_POST["postId"], $_POST["fileName"])) {
            $result["errorInUpload"] = "Error while linking image to post";
                exit;
            }
        if($result["errorInUpload"] == "ok"){
          $result["uploadDone"] = true;
        }
    } else {
        $result["errorInUpload"] = "Invalid data received";
    }
    echo json_encode($result);
?>
