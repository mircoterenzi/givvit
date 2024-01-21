<?php 
require_once("../db-config.php");
if(isset($_FILES['id'])) {
    require_once('db-config.php');
    $dbh->viewedNotification($_FILES['id']);
}
?>