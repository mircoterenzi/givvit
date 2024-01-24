<?php
require_once("db-config.php");
require_once("utils/functions.php");
$profile = $templateParams["profile"][0];
?>
<!-- Profile info -->
<section class="card p-4 shadow-sm rounded-5" id="<?php echo $profile["user_id"]; ?>">
    <div class="row mb-3 align-items-center">
        <div class="col-6">
            <div class="ratio ratio-1x1 rounded-circle overflow-hidden">
                <img src="img/<?php 
                if(!empty($profile["profile_img"])) {
                echo($profile["profile_img"]); 
                } else {
                echo("default-propic.jpg");
                } ?>" alt="profile picture"/>
            </div>
        </div>
        <div class="col-6">
            <p class="mb-0"><?php echo($profile["first_name"]); ?> <?php echo($profile["last_name"]); ?></p>
            <p class="fw-bold">@<?php echo($profile["username"]); ?></p>
            <?php if($_GET["id"] == $_SESSION["userId"]): ?>
            <a href="api/logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
            </a>
            <?php else: 
                if(empty($dbh->checkFollow($_SESSION["userId"], $_GET["id"]))):
            ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" class="add-follow bi bi-person-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
            </svg>
            <?php else: ?>
            <svg data-bs-toggle="modal" data-bs-target="#rm-follow-modal" xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
            </svg>
            <?php endif; endif; ?>
        </div>
    </div>
    <p><?php  echo($profile["description"]);?></p>
</section>

<!-- List selection -->
<section class="d-flex my-4 justify-content-center">
    <div class="btn-group">
        <a href="profile.php?id=<?php echo $profile["user_id"] ?>&type=posted" class="btn btn-sm <?php if($_GET["type"] == "posted") { echo "active"; } ?>" id="posted">
            Posted: <?php echo(printVarIfPresent($profile["num_posted"])); ?>
        </a>
        <a href="profile.php?id=<?php echo $profile["user_id"] ?>&type=supported" class="btn btn-sm <?php if($_GET["type"] == "supported") { echo "active"; } ?>" id="supported">
            Supported: <?php echo(printVarIfPresent($profile["num_donations"])); ?>
        </a>
        <a href="profile.php?id=<?php echo $profile["user_id"] ?>&type=follower" class="btn btn-sm <?php if($_GET["type"] == "follower") { echo "active"; } ?>" id="posted">
            Follower: <?php echo(printVarIfPresent($profile["n_followers"])); ?>
        </a>
        <a href="profile.php?id=<?php echo $profile["user_id"] ?>&type=following" class="btn btn-sm <?php if($_GET["type"] == "following") { echo "active"; } ?>" id="supported">
            Following: <?php echo(printVarIfPresent($profile["n_followed"])); ?>
        </a>
    </div>
</section>

<!-- List -->
</section>  
    <?php
    if($_GET["type"] == "posted") {
        $templateParams["posts"] = $dbh->getPostsbyUser($_GET["id"]);
        require("show-post.php");
    } elseif($_GET["type"] == "supported") {
        $templateParams["posts"] = $dbh->getSupportedPostByUser($_GET["id"]);
        require("show-post.php");
    } elseif($_GET["type"] == "follower") {
        $templateParams["user-list"] = $dbh->getUserFollowers($_GET["id"]);
        require("show-user-list.php");
    } elseif($_GET["type"] == "following") {
        $templateParams["user-list"] = $dbh->getFollowedByUser($_GET["id"]);
        require("show-user-list.php");
    } else {
        echo("Error");
    }
    ?>
</section>
<?php
require_once("./components/remove-follow-modal.php");
require_once("./components/user-list-modal.php");
?>