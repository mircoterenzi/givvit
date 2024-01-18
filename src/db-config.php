<?php
require_once("db/database.php");
require_once("./utils/functions.php");
$dbh = new DatabaseHelper("localhost", "root", "", "Givvit", 3307);
define("UPLOAD_DIR", "img/")
sec_session_start();

?>