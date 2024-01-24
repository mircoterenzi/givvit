<?php
    require_once("../db-config.php");

    $result["uploadDone"] = false;
    $result["errorInUpload"] = "ok";

    if (isset($_POST["postId"]) && isset($_POST["fileNames"])) {
      
        $postId = $_POST["postId"];
        $fileNames = $_POST["fileNames"];

        // Ensure $fileNames is an array
        if (!is_array($fileNames)) {
            $fileNames = [$fileNames];
        }

        // Handle each file name
        foreach ($fileNames as $fileName) {
            if (!$dbh->insertFile($postId, $fileName)) {
                $result["errorInUpload"] = "Error while linking image to post";
                echo json_encode($result);
                exit;
            }
        }
        if($result["errorInUpload"] == "ok"){
          $result["uploadDone"] = true;
        }
        echo json_encode($result);
    } else {
        $result["errorInUpload"] = "Invalid data received";
        echo json_encode($result);
    }
?>
