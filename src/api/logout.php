<?php 
    include '../utils/functions.php';
    sec_session_start();
    session_unset();
    session_destroy();
    header('Location: ../index.php');
?>