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
        FROM user_profile,
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
            FROM user_profile,
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
        FROM user_profile , 
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
            FROM folow s INNER JOIN user_profile u ON s.followed = u.user_id
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
            FROM folow s INNER JOIN user_profile u ON s.follower = u.user_id
            WHERE s.followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificationsById($userId) {
        $query = "
            SELECT n.notification_id, n.notification_type, n.text, n.post_id, u.username,
            ui.user_id as user_for_id, ur.user_id as user_from_id, ur.username ad username_from, ui.username as username_for
            FROM notification n INNER JOIN user_profile ui ON ui.id = n.user_for INNER JOIN utente ur ON ur.id = n.user_from
            WHERE n.user_for = ? AND n.visualized = false
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

    //TODO files
    public function insertPost( $short_descr = null, $long_descr, $user, $amount_requested, $topic){
        $query = "INSERT INTO post (long_description, short_description, amount_requested, date, user, topic) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssisiis', $long_descr, $short_descr, $amount_requested, date("Y-m-d"), $user, $topic);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function closePost($post_id){
        $query = "UPDATE post SET closed = 0 WHERE id = ?";
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
        $query = "INSERT INTO comments (text, user, post) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii',$testo, $utente, $post);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function insertCommentResponse($postId, $responseId){
        $query = "UPDATE comments SET responded_by = ? WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$responseId, $postId);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function getCommentOnPost($postId) {
        $query = "SELECT * FROM comments WHERE post = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * likess CRUD
     */

    public function getLikesByPostIdAndUserId($idPost, $userID){
        $query = "
            SELECT *
            FROM likes
            WHERE post = ? AND user = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getPostLikes($postId) {
        $count_likes = "SELECT COUNT(*) AS count_likes FROM likes WHERE post = ?";

        $stmt = $db->prepare($count_likes);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc()['count_likes'];
    }

    public function insertLike($idPost, $userID){
        $query = "INSERT INTO likes (post, user) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $userID);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function removeLike($idPost, $userID){
        $query = "DELETE FROM likes WHERE idPost = ? AND userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $userID);
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

    public function insertDonation($idPost, $userID, $amount){
        $query = "INSERT INTO donation (post, user, amount) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii',$idPost, $userID, $amount);
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

    public function insertNotification($type, $text, $sender, $receiver, $postId = null) {
        $query = "INSERT INTO nofication (notification_type, text, user_from, user_for, post_id , date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssiiis', $type, $text, $sender, $receiver, $postId, date("Y-m-d"));
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function viewedNotification($idNotification){
        $query = "UPDATE nofication SET visualized = 0 WHERE id = ?";
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
        $query = "INSERT INTO user_profile (first_name, last_name, username, email, password, sale, profile_img, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssssss', $name, $surname, $username, $email, $password, $salt, $image, $descr);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertUser($name, $surname, $username, $email, $password, $salt, $image) {
        $query = "INSERT INTO user_profile (first_name, last_name, username, email, password, sale, profile_img) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $name, $surname, $username, $email, $password, $salt, $image);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertUser($name, $surname, $username, $email, $password, $salt, $descr) {
        $query = "INSERT INTO user_profile (first_name, last_name, username, email, password, sale, description) VALUES (?, ?, ?, ?, ?,  ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $name, $surname, $username, $email, $password, $salt, $descr);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function insertUser($name, $surname, $username, $email, $password, $salt) {
        $query = "INSERT INTO user_profile (first_name, last_name, username, email, password, sale) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $name, $surname, $username, $email, $password, $salt);
        $stmt->execute();

        return $stmt->insert_id;
    }

}
?>