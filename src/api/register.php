<?php 
   require_once("../db-config.php");
   require_once("../utils/functions.php");

   $result["signinDone"] = false;

   //inserisco l'utente nel db se non esiste già (username univoco)
   if(isset($_POST['username'], $_POST['password'], $_POST["name"], $_POST["surname"])) { 
      //eseguo l'hash della password e genero il sale
      $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      // Crea una password usando la chiave appena creata.
      $password = hash('sha512', $_POST["password"] . $salt);
      //controllo se esiste un utente con lo stesso user, altrimenti esegui l'inserimento
      if($dbh->getUsersByUsername($_POST["username"])) {
        $result["errorSignin"] = "Username already taken";
      } else if($dbh->insertUser($_POST['name'], $_POST['surname'], $_POST["username"], $_POST["email"], $password, $salt, $_POST["desc"])) {
         $result["signinDone"] = true;
         $_SESSION["userId"] = $dbh->getUsersByUsername($_POST["username"]);
      }else{
         $result["errorSignin"] = "insert failed";
      }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["errorSignin"] = "Request not valid";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>