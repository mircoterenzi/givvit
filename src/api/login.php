<?php 
   include '../db/database.php';
   include '../utils/functions.php';

   $result["logineseguito"] = false;

   //effettua il login
   if(isset($_POST['username'], $_POST['password'])) { 
      $username = $_POST['username'];
      $password = $_POST['password'];
      if(login($username, $password, $dbh) == true) {
         // Login eseguito
         $result["loginDone"] = true;
      } else {
         // Login fallito
         $result["errorlogin"] = "Wrong username or password";
      }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["errorelogin"] = "Invalid Request";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>