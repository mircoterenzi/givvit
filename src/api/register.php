<?php
require_once("../db-config.php");
require_once("../utils/functions.php");

$result["signinDone"] = false;

// Check if required variables are set
if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST["name"]) || empty($_POST["surname"])) {
    $result["errorSignin"] = "Request not valid";
} else {
    // Generate salt
    $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

    // Create hashed password using the generated salt
    $password = hash('sha512', $_POST['password'] . $salt);

    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST["email"];

    // Check if the username already exists
    if ($dbh->getUsersByUsername($username)) {
        $result["errorSignin"] = "Username already taken";
    } else {
        // Define optional parameters
        $desc = isset($_POST["desc"]) ? $_POST["desc"] : null;
        $image = isset($_POST["image"]) ? $_POST["image"] : null;

        // Insert user into the database
        $id = $dbh->insertUser($name, $surname, $username, $email, $password, $salt, $desc, $image);

        if ($id) {
            $result["signinDone"] = true;
            $_SESSION['userId'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);
        }else{
         $result["errorSignin"] = "query problem";
        }
    }
}

// Set response header
header('Content-Type: application/json');
// Return JSON response
echo json_encode($result);
?>
