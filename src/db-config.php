<?php
define("UPLOAD_DIR", "img/");

require_once("db/database.php");
require_once("utils/functions.php");
$dbh = new DatabaseHelper("localhost", "root", "", "givvit", 3307);
sec_session_start();

?>