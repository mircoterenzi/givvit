<?php 
require_once("../db-config.php");
if(isset($_POST['id'])) {
   $_SESSION["post-type"] = $_POST['id'];
}
?>