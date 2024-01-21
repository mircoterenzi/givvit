<?php 
require_once("../db-config.php");
if(isset($_POST['id'])) {
    $dbh->viewedNotification($_SESSION["userId"],$_POST['id']);
}
?>