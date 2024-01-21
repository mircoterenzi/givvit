<!-- Profile info -->
<?php $profile = $templateParams["profile"][0] ?>
<section class="card p-4 shadow-sm rounded-5">
    <div class="row mb-3 align-items-center">
        <div class="col-6">
            <div class="ratio ratio-1x1 rounded-circle overflow-hidden">
                <img src="img/<?php 
                if(!empty($profile["profile_img"])): 
                echo($profile["profile_img"]); 
                else: 
                echo("default-propic.jpg");
                endif; ?>" alt="profile picture"/>
            </div>
        </div>
        <p class="col-3">Followers: <?php echo($profile["n_followers"]); ?></p>
        <p class="col-3">Following: <?php echo($profile["n_followed"]); ?></p>
    </div>
    <div class="row align-items-center">
        <div class="col text-start">
            <p class="mb-0"><?php echo($profile["first_name"]); ?> <?php echo($profile["last_name"]); ?></p>
            <p class="fw-bold">@<?php echo($profile["username"]); ?></p>
        </div>
        <div class="col text-end">
            <!-- TODO add on click function -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
            </svg>
        </div>
    </div>
    <p><?php  echo($profile["description"]);?></p>
</section>

<!-- Post selection -->
<section class="container my-4">
    <div class="btn-group">
        <a class="btn <?php if($_SESSION["post_type"] == "Posted"): echo "active"; endif; ?>" id="Posted">Posted: <?php echo($profile["num_posted"]); ?></a>
        <a class="btn  <?php if($_SESSION["post_type"] == "Supported"): echo "active"; endif; ?>" id="Supported">Supported: <?php echo($profile["num_donations"]); ?></a>
    </div>
</section>

<!-- Posts -->
</section>
    <?php
    require_once("db-config.php");
    if($_SESSION["post_type"] == "Posted"):
        $templateParams["posts"] = $dbh->getPostById($_SESSION["userId"]);
        require("show-post.php");
    elseif($_SESSION["post_type"] == "Supported"):
        $templateParams["posts"] = $dbh->getPostById($_SESSION["userId"]);  //TODO: manca query per avere post supportati
        require("show-post.php");
    else:
        echo("Error");
    endif;
    ?>
</section>