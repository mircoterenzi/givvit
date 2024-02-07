<?php 

    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF']) == $pagename){
            if($pagename == "profilo.php"){
                return true;
            }
            echo "active";
        }
    }

    function sec_session_start() {
        $session_name = 'sec_session_id';
        $secure = false; // not use https but only http
        $httponly = true; // hide session id from js
        ini_set('session.use_only_cookies', 1); //use only cookies
        $cookieParams = session_get_cookie_params(); // read cookies
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); 
        session_start();
        session_regenerate_id();
    }

    function login($username, $password, $dbh) {
        $checkLoginResult = $dbh->checkLogin($username);
        
                
        if($checkLoginResult) {

            $userId = $checkLoginResult[0]["user_id"];
            $username = $checkLoginResult[0]["username"];
            $dbPassword = $checkLoginResult[0]["password"];
            $salt = $checkLoginResult[0]["salt"];
    
            $password = hash('sha512', $password . $salt);

            if($dbPassword == $password) {       
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
    
                $_SESSION['userId'] = $userId; 
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                return true;    
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function login_check($mysqli) {
        if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $userId = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];     
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            if ($stmt = $mysqli->prepare("SELECT password FROM user_profile WHERE user_id = ? LIMIT 1")) { 
                $stmt->bind_param('i', $userId);
                $stmt->execute(); 
                $stmt->store_result();
        
                $password = 0; // used to ignore error
                if($stmt->num_rows == 1) { 
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $login_check = hash('sha512', $password.$user_browser);
                if($login_check == $login_string) {
                    return true;
                } else {
                    return false;
                }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function isOwner($userId, $postId, $dbh) {
        $post = $dbh->getPostById($postId);
        return $post[0]["userId"] == $userId;
    }

    function uploadImage($path, $image){
        $imageName = basename($image["name"]);
        $fullPath = $path.$imageName;
        
        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        //Check that the file is an image and the correct size
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File uploaded is not an image! ";
        }
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File too big, max dimention $maxKB KB. ";
        }

        $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "file extension not valid, use one of: ".implode(",", $acceptedExtensions);
        }

        //rename file if needed
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

        //move file
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $fullPath)){
                $msg.= "Errore nel caricamento dell'immagine.";
            }
            else{
                $result = 1;
                $msg = $imageName;
            }
        }
        return array($result, $msg);
    }

    function printVarIfPresent($var) {
        if(!empty($var)){
            return $var;
        } else {
            return 0;
        }
    }

?>