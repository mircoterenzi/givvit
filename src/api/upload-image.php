<?php 
   require_once("../db-config.php");
   require_once("../utils/functions.php");
   
   $result["uploadDone"] = false;

   //img upload
   if(isset($_FILES['image'])) { 
    $uploadResult = uploadImage("../img/", $_FILES["image"]);
    if($uploadResult[0]) {
        $result["uploadDone"] = true;
        $result["fileName"] = $uploadResult[1];
    } else {
        $result["errorInUpload"] =  $uploadResult[1];
    }
   } else { 
      $result["errorInUpload"] = "Richiesta non valida";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>