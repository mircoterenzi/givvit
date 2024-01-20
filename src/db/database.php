<?php

    //TODO files (all)
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

    public function getUserById($user_id) {
        $query = "SELECT u.username, u.description, u.profile_img, u.first_name, u.last_name, 
                c_followed.n_followed, c_follower.n_followers, posted.num_posted, donations.num_donations
                FROM user_profile u join 
                (SELECT count(followed) as n_followed , follower FROM follow group by follower) c_followed
                on c_followed.follower = u.user_id join 
                (SELECT count(follower) as n_followers , followed FROM follow group by followed) c_follower
                on c_follower.followed = u.user_id join
                (SELECT count(post_id) as num_posted, user FROM post group by user) posted
                on posted.user = u.user_id join
                (SELECT count(post) as num_donations, user FROM donation group by user) donations
                on donations.user = u.user_id
                WHERE user_id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchUser($input) {
        $query = "SELECT u.username, u.description, u.profile_img, u.first_name, u.last_name, 
                c_followed.n_followed, c_follower.n_followers, posted.num_posted, donations.num_donations
                FROM user_profile u join 
                (SELECT count(followed) as n_followed , follower FROM follow group by follower) c_followed
                on c_followed.follower = u.user_id join 
                (SELECT count(follower) as n_followers , followed FROM follow group by followed) c_follower
                on c_follower.followed = u.user_id join
                (SELECT count(post_id) as num_posted, user FROM post group by user) posted
                on posted.user = u.user_id join
                (SELECT count(post) as num_donations, user FROM donation group by user) donations
                on donations.user = u.user_id
                    WHERE username LIKE CONCAT(?, '%')
                    OR nome LIKE CONCAT(?, '%')
                    OR cognome LIKE CONCAT(?, '%')";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss',$input,$input,$input);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsersByUsername($slug) {
        $query = "SELECT user_id FROM user_profile WHERE username = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$slug);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowedByUser($user_id) {
        $query = "
            SELECT u.user_id, u.username
            FROM follow s INNER JOIN user_profile u ON s.followed = u.user_id
            WHERE s.follower = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserFollowers($user_id) {
        $query = "
            SELECT u.user_id, u.username
            FROM follow s INNER JOIN user_profile u ON s.follower = u.user_id
            WHERE s.followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificationsById($user_id) {
        $query = "
            SELECT n.notification_id, n.notification_type, n.text, n.post_id, ur.username,
            ui.user_id as user_for_id, ur.user_id as user_from_id, ur.username as username_from, ui.username as username_for
            FROM notification n INNER JOIN user_profile ui ON ui.user_id = n.user_for INNER JOIN user_profile ur ON ur.user_id = n.user_from
            WHERE n.user_for = ? AND n.visualized = false
            ORDER BY n.date DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function checkFollow($user_id, $followedId) {
        $query = "
            SELECT *
            FROM follow
            WHERE follower = ? AND followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$user_id,$followedId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function followUser($user_id, $followedId) {
        $query = "
            INSERT INTO follow (follower, followed)
            VALUES (?, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$user_id,$followedId);
        $stmt->execute();
    }

    public function unfollowUser($user_id, $followedId) {
        $query = "
            DELETE FROM follow
            WHERE follower = ? AND followed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$user_id,$followedId);
        $stmt->execute();
    }

    public function updateUserWithImg($user_id, $username, $email, $nome, $cognome, $imgProfilo) {
        $query = "
            UPDATE utente
            SET username = ?, nome = ?, cognome = ?, email = ?, imgProfilo = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssi',$username,$nome,$cognome,$email,$imgProfilo,$user_id);
        $stmt->execute();
    }

    public function updateUserWithoutImg($user_id, $username, $email, $nome, $cognome) {
        $query = "
            UPDATE utente
            SET username = ?, nome = ?, cognome = ?, email = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssi',$username,$nome,$cognome,$email,$user_id);
        $stmt->execute();
    }

    /**
     * Post CRUD
     */

    public function getPostById($postId) {
        $query = "SELECT p.title, u.username, p.long_description, p.short_description, p.topic, p.date, p.amount_requested, r.ammount_raised
                FROM post p JOIN user_profile u ON u.user_id = p.user 
                JOIN (SELECT SUM(amount) AS ammount_raised , post FROM donation group by post) r on r.post = p.post_id 
                WHERE post_id = ?
                ORDER BY p.date DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsbyUser($user_id, $n=-1){
        $query = "SELECT p.title, u.username, p.long_description, p.short_description, p.topic, p.date, p.amount_requested, r.ammount_raised
                FROM post p JOIN user_profile u ON u.user_id = p.user 
                JOIN (SELECT SUM(amount) AS ammount_raised , post FROM donation group by post) r on r.post = p.post_id 
                WHERE user = ?
                ORDER BY p.date DESC";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
 
    public function getAllPosts($n = 10){
        $query = "SELECT p.title, u.username, p.long_description, p.short_description, p.topic, p.date, p.amount_requested, r.ammount_raised
                FROM post p JOIN user_profile u ON u.user_id = p.user 
                JOIN (SELECT SUM(amount) AS ammount_raised , post FROM donation group by post) r on r.post = p.post_id 
                ORDER BY p.date DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsbyTheme($theme, $n=-1){
        $query = "SELECT p.title, u.username, p.long_description, p.short_description, p.topic, p.date, p.amount_requested, r.ammount_raised
                FROM post p JOIN user_profile u ON u.user_id = p.user 
                JOIN (SELECT SUM(amount) AS ammount_raised , post FROM donation group by post) r on r.post = p.post_id  
                WHERE topic = ?
                ORDER BY p.date DESC";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$theme);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getHomeForUser($user_id, $n=-1){
        $query = "SELECT p.title, u.username, p.long_description, p.short_description, p.topic, p.date, p.amount_requested, r.ammount_raised
                FROM post p JOIN user_profile u ON u.user_id = p.user 
                JOIN (SELECT SUM(amount) AS ammount_raised , post FROM donation group by post) r on r.post = p.post_id  
                WHERE user in (
                    SELECT u.user_id
                    FROM follow s INNER JOIN user_profile u ON s.followed = u.user_id
                    WHERE s.follower = ?
                )
                ORDER BY p.date DESC";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertPost($title, $short_description = null, $long_description,$user, $amount_requested, $topic){
        $query = "INSERT INTO post (title, long_description, short_description, amount_requested, date, user, topic) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $date = date("Y-m-d");
        $stmt->bind_param('sssisiis',$title, $long_description, $short_description, $amount_requested, $date, $user, $topic);
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
        $query = "INSERT INTO comments (text, user, post, date) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $date = date("Y-m-d");
        $stmt->bind_param('siis',$testo, $utente, $post, $date);
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
        $query = "SELECT c.* u.username 
                FROM comments JOIN user_profile u ON u.user_id = c.user
                WHERE post = ?
                ORDER BY p.date DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * likess CRUD
     */

    public function getLikesByPostIdAnduser_id($idPost, $user_id){
        $query = "
            SELECT *
            FROM likes
            WHERE post = ? AND user = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getPostLikes($postId) {
        $count_likes = "SELECT COUNT(*) AS count_likes FROM likes WHERE post = ?";

        $stmt = $this->db->prepare($count_likes);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc()['count_likes'];
    }

    public function insertLike($idPost, $user_id){
        $query = "INSERT INTO likes (post, user) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $user_id);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function removeLike($idPost, $user_id){
        $query = "DELETE FROM likes WHERE post = ? AND user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $user_id);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    /**
     * Donations CRUD
     */

    public function checkDonation($idUser, $idPost){
        $query = "SELECT * FROM donation 
                WHERE post = ? AND user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$idPost, $idUser);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertDonation($idPost, $user_id, $amount){
        $query = "INSERT INTO donation (post, user, amount) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii',$idPost, $user_id, $amount);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function supportedPostByUser($idUser, $n=-1){
        $query = "SELECT * FROM post 
                WHERE post_id IN ( SELECT post from donation WHERE user = ?) 
                ORDER BY p.date DESC";

        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Topic CRUD
     */

    public function getTopics($n=-1){
        $query = "
            SELECT name
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
        $date = date("Y-m-d");
        $stmt->bind_param('ssiiis', $type, $text, $sender, $receiver, $postId, $date);
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
     * Login
     */
    
    public function checkLogin($username){
        $query = "SELECT user_id, username, password, salt FROM user_profile WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Register
     */

    public function getNextuser_id(){
        $query = "SELECT MAX(user_id) as max_id FROM user_profile";
        $stmt = $this->db->query($query);
        $row = $stmt->fetch_assoc();
    
        return $row['max_id'] + 1;
    }
    

    public function insertUser($name, $surname, $username, $email, $password, $salt, $descr) {
        $query = "INSERT INTO user_profile (user_id,first_name, last_name, username, email, password, salt, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $id = $this->getNextuser_id();
        $stmt->bind_param('isssssss',$id, $name, $surname, $username, $email, $password, $salt, $descr);
        $stmt->execute();

        return $stmt->insert_id;
    }
}
?>