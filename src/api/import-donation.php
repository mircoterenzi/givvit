<?php
    require_once("../db-config.php");
    $result["importDone"] = false;
    $result["error"] = "ok";
    if(isset($_POST["donationAmount"],$_POST["postId"],$_POST["reciver"])) {
        if($_POST["reciver"] != $_SESSION["userId"]) {
            if ($dbh->checkDonation($_SESSION["userId"],$_POST["postId"])) {
                $result["error"] = "you already donated to this post";
            } else{
                $dbh->insertDonation($_POST["postId"], $_SESSION["userId"], $_POST["donationAmount"]);
                $result["importDone"] = true;
            }
        }else{
            $result["error"] = "you can't donate to yourself";
        }
    }else{
        $result["error"] = "donation empty";
    }

   header('Content-Type: application/json');
   echo json_encode($result);
?>