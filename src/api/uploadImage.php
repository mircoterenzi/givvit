<?php 
   require_once("../db-config.php");
   require_once("../utils/functions.php");
   
   $result["uploadDone"] = false;

   //carico img nel filesystem
   if(isset($_FILES['image'])) { 
    $uploadResult = uploadImage("../img/", $_FILES["image"]);
    if($uploadResult[0]) {
        $result["uploadDone"] = true;
        $result["fileName"] = $uploadResult[1];
    } else {
        $result["errorInUpload"] = "Upload immagine non riuscito";
    }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["errorInUpload"] = "Richiesta non valida";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>