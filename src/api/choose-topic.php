<?php 
require_once("../db-config.php");
if(isset($_POST['id'])) {
   $_SESSION['topic'] = $_POST['id'];
}
?>