<!-- Profile info -->
<?php
require_once("db-config.php");
require_once("utils/functions.php");
$profile = $dbh->getUserById($_GET["id"])[0] 
?>
<section class="card p-4 shadow-sm rounded-5">
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
        <p class="col-3">Followers: <?php echo(printVarIfPresent($profile["n_followed"])); ?></p>
        <p class="col-3">Following: <?php echo(printVarIfPresent($profile["n_followed"])); ?></p>
    </div>
    <div class="row align-items-center">
        <div class="col text-start">
            <p class="mb-0"><?php echo($profile["first_name"]); ?> <?php echo($profile["last_name"]); ?></p>
            <p class="fw-bold">@<?php echo($profile["username"]); ?></p>
        </div>
        <div class="col text-end">
            <a href="api/logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
            </a>
        </div>
    </div>
    <p><?php  echo($profile["description"]);?></p>
</section>

<!-- Post selection -->
<section class="container my-4">
    <div class="btn-group">
        <a href="profile.php?id=<?php echo $profile["user_id"] ?>&type=posted" class="btn <?php if($_GET["type"] == "posted") { echo "active"; } ?>" id="posted">
            Posted: <?php echo(printVarIfPresent($profile["num_posted"])); ?>
        </a>
        <a href="profile.php?id=<?php echo $profile["user_id"] ?>&type=supported" class="btn <?php if($_GET["type"] == "supported") { echo "active"; } ?>" id="supported">
            Supported: <?php echo(printVarIfPresent($profile["num_donations"])); ?>
        </a>
    </div>
</section>

<!-- Posts -->
</section>
    <?php
    if($_GET["type"] == "posted") {
        $templateParams["posts"] = $dbh->getPostsbyUser($_GET["id"]);
        require("show-post.php");
    } elseif($_GET["type"] == "supported") {
        $templateParams["posts"] = $dbh->getSupportedPostByUser($_GET["id"]);
        require("show-post.php");
    } else {
        echo("Error");
    }
    ?>
</section>