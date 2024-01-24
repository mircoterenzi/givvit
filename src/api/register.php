<?php 
   require_once("../db-config.php");
   require_once("../utils/functions.php");

   $result["signinDone"] = false;
   $id = 0;

   //inserisco l'utente nel db se non esiste già (username univoco)
   if(isset($_POST['email'],$_POST['username'], $_POST['password'], $_POST["name"], $_POST["surname"])) { 
      //eseguo l'hash della password e genero il sale
      $username = $_POST['username'];
      $name = $_POST['name'];
      $password = $_POST['password'];
      $surname = $_POST['surname'];
      $email = $_POST["email"];

      $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      // Crea una password usando la chiave appena creata.
      $password = hash('sha512', $password . $salt);
      //controllo se esiste un utente con lo stesso user, altrimenti esegui l'inserimento
      if($dbh->getUsersByUsername($username)) {
        $result["errorSignin"] = "Username already taken";
      } else if(isset($_POST["desc"]) && isset($_POST["image"])) {
         if($id = $dbh->insertUser($name, $surname, $username, $email, $password, $salt, $_POST["desc"],$_POST["image"])){
            $result["signinDone"] = true;
         }
      }else if(isset($_POST["desc"])) {
         if($id = $dbh->insertUser($name, $surname, $username, $email, $password, $salt, $_POST["desc"], null)){
            $result["signinDone"] = true;
         }
      }else if(isset($_POST["image"])) {
         if($id = $dbh->insertUser($name, $surname, $username, $email, $password, $salt, null, $_POST["image"])){
            $result["signinDone"] = true;
         }
      }else{
         if($id = $dbh->insertUser($name, $surname, $username, $email, $password, $salt)){
            $result["signinDone"] = true;
         }
      }
      if($result["signinDone"]){
         $_SESSION['userId'] = $id; 
         $_SESSION['username'] = $username;
         $_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);
      }
   } else { 
      // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
      $result["errorSignin"] = "Request not valid";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>