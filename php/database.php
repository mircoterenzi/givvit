<?php
class DatabaseHelper{
    public $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    /**
    * User CRUD
    */

    public function getUserById($userId) {
        $query = "SELECT u.username, u.description, u.profile_img
        FROM user,
        WHERE user_id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchUser($input) {
        $query = "
            SELECT u.username, u.description, u.profile_img
            FROM user,
            WHERE username LIKE CONCAT(?, '%')
            OR nome LIKE CONCAT(?, '%')
            OR cognome LIKE CONCAT(?, '%')
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss',$input,$input,$input);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsersByUsername($slug) {
        $query = "SELECT u.username, u.description, u.profile_img
        FROM user , 
        WHERE username = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$slug);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserFollowing($userId) {
        $query = "
            SELECT u.user_id, u.username
            FROM folow s INNER JOIN user u ON s.followed = u.user_id
            WHERE s.follower = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserFollowed($userId) {
        $query = "
            SELECT u.user_id, u.username
            FROM folow s INNER JOIN user u ON s.follower = u.user_id
            WHERE s.followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //TODO
    public function getNotificationsById($userId) {
        $query = "
            SELECT n.id as notificationId, n.tipo, n.testo, p.id as postId, ui.username, ui.id as userId, n.idUtenteRiceve
            FROM notifica n LEFT JOIN post p ON p.id = n.idPost INNER JOIN utente ui ON ui.id = n.idUtenteInvio
            WHERE n.idUtenteRiceve = ? AND n.abilitato = 1
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function checkFollow($userId, $followedId) {
        $query = "
            SELECT *
            FROM follow
            WHERE follower = ? AND followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$userId,$followedId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function followUser($userId, $followedId) {
        $query = "
            INSERT INTO follow (follower, followed)
            VALUES (?, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$userId,$followedId);
        $stmt->execute();
    }

    public function unfollowUser($userId, $followedId) {
        $query = "
            DELETE FROM follow
            WHERE follower = ? AND followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$userId,$followedId);
        $stmt->execute();
    }

    public function updateUserWithImg($userId, $username, $email, $nome, $cognome, $imgProfilo) {
        $query = "
            UPDATE utente
            SET username = ?, nome = ?, cognome = ?, email = ?, imgProfilo = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssi',$username,$nome,$cognome,$email,$imgProfilo,$userId);
        $stmt->execute();
    }

    public function updateUserWithoutImg($userId, $username, $email, $nome, $cognome) {
        $query = "
            UPDATE utente
            SET username = ?, nome = ?, cognome = ?, email = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssi',$username,$nome,$cognome,$email,$userId);
        $stmt->execute();
    }

    /**
     * Post CRUD
     */

    public function getPostById($postId) {
        $query = "SELECT user, long_descr, short_descr, files, topic, date, amount_requested, 
                FROM post 
                WHERE post_id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsbyUser($userId, $n=-1){
        $query = "SELECT user, long_descr, short_descr, files, topic, date, amount_requested, 
        FROM post 
        WHERE user = ?";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
 
    public function getPostsbyTheme($theme, $n=-1){
        $query = "SELECT user, long_descr, short_descr, files, topic, date, amount_requested, 
                FROM post 
                WHERE topic = ?";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->bind_param('s',$theme);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //TODO 
    public function insertPost($testo, $immagine = null, $tema, $utente){
        $query = "INSERT INTO post (testo, immagine, idTema, idUtente) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssii',$testo, $immagine, $tema, $utente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function deletePostById($idPost){
        $query = "UPDATE post SET abilitato = 0 WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }

    public function getAmountRaisedByPost($postId) {
        $query = "SELECT SUM(amount) AS ammount_raised FROM donation WHERE post = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Comments CRUD
     */

    public function insertComment($testo, $post, $utente){
        $query = "INSERT INTO comment (text, user, post) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii',$testo, $utente, $post);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function insertCommentResponse($postId, $responseId){
        $query = "UPDATE comment SET responded_by = ? WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$responseId, $postId);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function getCommentOnPost($postId) {
        $query = "SELECT * FROM like WHERE post = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Likes CRUD
     */

    public function getLikesByPostIdAndUserId($idPost, $idUtente){
        $query = "
            SELECT *
            FROM like
            WHERE post = ? AND user = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getPostLikes($postId) {
        $count_likes = "SELECT COUNT(*) AS count_likes FROM comment WHERE post = ?";

        $stmt = $db->prepare($count_likes);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc()['count_likes'];
    }

    public function insertLike($idPost, $idUtente){
        $query = "INSERT INTO like (post, user) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $idUtente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function removeLike($idPost, $idUtente){
        $query = "DELETE FROM like WHERE idPost = ? AND idUtente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $idUtente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    /**
     * Donations CRUD
     */

    public function checkDonation($idUser, $idPost){
        $query = "SELECT * FROM donation 
                WHERE post = ? AND user = ?";

        $stmt->bind_param('ii',$idPost, $idUser);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertDonation($idPost, $idUtente, $amount){
        $query = "INSERT INTO donation (post, user, amount) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii',$idPost, $idUtente, $amount);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function supportedPostByUser($idUser, $n=-1){
        $query = "SELECT * FROM post 
                WHERE post_id IN ( SELECT post from donation WHERE user = ?)";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Topic CRUD
     */

    public function getTopics($n=-1){
        $query = "
            SELECT  nome
            FROM topic
        ";
        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Notification CRUD
     */

    public function insertNotification($type, $text, $sender, $receiver) {
        $query = "INSERT INTO notifica (notification_type, text, user_from, user_for) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssiii', $type, $text, $post, $sender, $receiver);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertNotification($type, $text, $sender, $receiver, $postId) {
        $query = "INSERT INTO notifica (notification_type, text, user_from, user_for, post_id ) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssiii', $type, $text, $post, $sender, $receiver, $postId);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function deleteNotificationById($idNotification){
        $query = "UPDATE notifica SET abilitato = 0 WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idNotification);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }
    
    /**
     * Login //TODO salt password (all below)
     */

    
    public function checkLogin($username){
        $query = "SELECT id, username, password, sale FROM utente WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }   
    
    public function insertLoginAttempt($userId, $time){
        $query = "INSERT INTO login_attempts (user_id, time) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $userId, $time);
        $stmt->execute();

        return $stmt->insert_id;
    }   

    public function getLoginAttempts($userId, $timeThd){
        $query = "SELECT time FROM login_attempts WHERE user_id = ? AND time > ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userId, $timeThd);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Register
     */

    public function insertUser($name, $surname, $username, $email, $password, $salt, $image, $descr) {
        $query = "INSERT INTO user (first_name, last_name, username, email, password, sale, profile_img, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssssss', $name, $surname, $username, $email, $password, $salt, $image, $descr);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertUser($name, $surname, $username, $email, $password, $salt, $image) {
        $query = "INSERT INTO user (first_name, last_name, username, email, password, sale, profile_img) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $name, $surname, $username, $email, $password, $salt, $image);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertUser($name, $surname, $username, $email, $password, $salt$descr) {
        $query = "INSERT INTO user (first_name, last_name, username, email, password, sale, description) VALUES (?, ?, ?, ?, ?,  ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $name, $surname, $username, $email, $password, $salt, $descr);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertUser($name, $surname, $username, $email, $password, $salt) {
        $query = "INSERT INTO user (first_name, last_name, username, email, password, sale) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $name, $surname, $username, $email, $password, $salt);
        $stmt->execute();

        return $stmt->insert_id;
    }

}
?>