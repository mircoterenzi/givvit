<?php
require_once("../db-config.php");
require_once("../utils/functions.php");

$result["updateDone"] = false;

if (isset($_POST['username'], $_POST["name"], $_POST["surname"])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    $check = $dbh->getUsersByUsername($username);

    if ($check != $_SESSION["userId"] && $check != 0) {
        $result["errorupdate"] = "Username already taken";
    } else {
        $desc = isset($_POST["desc"]) ? $_POST["desc"] : null;
        $image = isset($_POST["image"]) ? $_POST["image"] : null;

        if ($dbh->editUser($_SESSION["userId"], $name, $surname, $username, $desc, $image)) {
            $result["updateDone"] = true;
        } else {
            $result["errorupdate"] = "Failed to update user profile";
        }

        $_SESSION['username'] = $username;
    }
} else {
    $result["errorupdate"] = "Request not valid";
}

echo json_encode($result);
?>
