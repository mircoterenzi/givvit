<?php
   require_once("../db-config.php");
   require_once("../utils/functions.php");

   $result["loginDone"] = false;

   if(isset($_POST['username'], $_POST['password'])) { 
      $username = $_POST['username'];
      $password = $_POST['password'];
      if(login($username, $password, $dbh) == true) {
         $result["loginDone"] = true;
      } else {
         $result["loginError"] = "Wrong username or password";
      }
   } else { 
      $result["loginError"] = "Invalid Request";
   }

   header('Content-Type: application/json');
   echo json_encode($result);

?>