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
        $session_name = 'sec_session_id'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
    }

    function login($username, $password, $dbh) {
        $checkLoginResult = $dbh->checkLogin($username);
        
                
        if($checkLoginResult) { // se l'utente esiste

            $userId = $checkLoginResult[0]["user_id"];
            $username = $checkLoginResult[0]["username"];
            $dbPassword = $checkLoginResult[0]["password"];
            $salt = $checkLoginResult[0]["salt"];
    
            $password = hash('sha512', $password . $salt); // codifica la password usando una chiave univoca.

            if($dbPassword == $password) {       
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
    
                $_SESSION['userId'] = $userId; 
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                // Login eseguito con successo.
                return true;    
            } else {
                // Password incorretta.
                return false;
            }
        } else {
            // L'utente inserito non esiste.
            return false;
        }
    }

    function login_check($mysqli) {
        // Verifica che tutte le variabili di sessione siano impostate correttamente
        if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $userId = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];     
            $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
            if ($stmt = $mysqli->prepare("SELECT password FROM user_profile WHERE user_id = ? LIMIT 1")) { 
                $stmt->bind_param('i', $userId); // esegue il bind del parametro '$userId'.
                $stmt->execute(); // Esegue la query creata.
                $stmt->store_result();
        
                $password = 0; // used to ignore error
                if($stmt->num_rows == 1) { // se l'utente esiste
                    $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
                    $stmt->fetch();
                    $login_check = hash('sha512', $password.$user_browser);
                if($login_check == $login_string) {
                    // Login eseguito!!!!
                    return true;
                } else {
                    //  Login non eseguito
                    return false;
                }
                } else {
                    // Login non eseguito
                    return false;
                }
            } else {
                // Login non eseguito
                return false;
            }
        } else {
            // Login non eseguito
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
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File uploaded is not an image! ";
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File too big, max dimention $maxKB KB. ";
        }

        //Controllo estensione del file
        $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "file extension not valid, use one of: ".implode(",", $acceptedExtensions);
        }

        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
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
            echo("0");
        }
    }

?>