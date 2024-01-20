<?php
   require_once("../db-config.php");
   require_once("../utils/functions.php");

   $result["loginDone"] = false;

   //effettua il login
   if(isset($_POST['username'], $_POST['password'])) { 
      $username = $_POST['username'];
      $password = $_POST['password'];
      if(login($username, $password, $dbh) == true) {
         // Login eseguito
         $result["loginDone"] = true;
         $_SESSION["userId"] = $dbh->getUsersByUsername($_POST["username"]);
      } else {
         // Login fallito
         $result["loginError"] = "Wrong username or password";
      }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["loginError"] = "Invalid Request";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>