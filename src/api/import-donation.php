<?php
    require_once("../db-config.php");
    $result["importDone"] = false;
    $result["error"] = "ok";
    if(isset($_POST["donationAmount"])) {
        if(isset($_POST["postId"])) {
            $dbh->insertDonation($_POST["postId"], $_SESSION["userId"], $_POST["donationAmount"]);
            $result["importDone"] = true;
        }else{
            $result["error"] = "postId empty";
        }
    }else{
        $result["error"] = "donation empty";
    }

   header('Content-Type: application/json');
   echo json_encode($result);
?>