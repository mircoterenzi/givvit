<?php 
if(isset($_POST['id'])) {
    require_once("../db-config.php");
    $dbh->viewedNotification($_SESSION["userId"],$_POST['id']);
}
?>