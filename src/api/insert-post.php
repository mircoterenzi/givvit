<?php 
   require_once("../db-config.php");

   $result["insertDone"] = false;
   $result["PostId"] = 0;

   //TODO topic
    if(isset($_POST['title'], $_POST['amount'], $_POST["fullDesc"])) { 
        if(isset($_POST["shortDesc"])) {
            $id = $dbh->insertPost($_POST["title"], $_POST["fullDesc"], $_SESSION["userId"], $_POST['amount'],"Art",$_POST["shortDesc"]);
            if($id){
                $result["PostId"] = $id;
                $result["insertDone"] = true;
            }else{
                $result["errorInsert"] = "query error";
            }
        }else{
            $id = $dbh->insertPost($_POST["title"], $_POST["fullDesc"], $_SESSION["userId"], $_POST['amount'],"Art");
            if($id){
                $result["PostId"] = $id;
                $result["insertDone"] = true;
            }else{
                $result["errorInsert"] = "query error";
            }
       }
    }else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["errorInsert"] = "Request not valid";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>