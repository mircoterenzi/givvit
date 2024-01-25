<?php 
   require_once("../db-config.php");
   require_once("../utils/functions.php");

   //inserisco l'utente nel db se non esiste già (username univoco)
   if(isset($_POST['username'], $_POST["name"], $_POST["surname"])) { 
      $username = $_POST['username'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      if(isset($_POST["desc"]) && isset($_POST["image"])) {
        $dbh->editUser( $_SESSION["userId"], $name, $surname, $username, $_POST["desc"],$_POST["image"]);
      }else if(isset($_POST["desc"])) {
        $dbh->editUser( $_SESSION["userId"], $name, $surname, $username, $_POST["desc"],null);
      }else if(isset($_POST["image"])) {
        $dbh->editUser( $_SESSION["userId"], $name, $surname, $username, null,$_POST["image"]);
      }else{
        $dbh->editUser( $_SESSION["userId"], $name, $surname, $username);
      }
      $_SESSION['username'] = $username;
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["errorSignin"] = "Request not valid";
   }
?>