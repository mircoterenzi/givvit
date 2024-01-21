<?php 
require_once("../db-config.php");
if(isset($_POST['id'])) {
   $_SESSION['post_type'] = $_POST['id'];
}
?>