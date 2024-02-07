<?php if(!empty($templateParams["posts"])): ?>
    <?php
        $i = 0;
        foreach($templateParams["posts"] as $post):
        $i++;
    ?>
    <article class="card clickable post mb-4 p-4 shadow-sm rounded-5" id="<?php echo $i ?>" data-link="open-post.php?postId=<?php echo $post["post_id"]; ?>">
        <div class="row">
            <div class="col text-start">
            <a class="badge" href="explore.php?topic=<?php echo $post["topic"]; ?>"><?php echo $post["topic"]; ?></a>
            </div>
            <div class="col text-end">
                <?php if($_SESSION["userId"] != $post["user_id"]):?>
                    <?php
                        if(empty($dbh->checkLikeByUser($post["post_id"], $_SESSION["userId"]))):
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="empty-star bi bi-star" viewBox="0 0 16 16" data-owner-id ="<?php echo $post["user_id"]; ?>" data-post-id ="<?php echo $post["post_id"]; ?>" >
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                    </svg>
                    <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="full-star bi bi-star-fill" viewBox="0 0 16 16" data-post-id ="<?php echo $post["post_id"]; ?>">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <?php endif;?>
                <?php endif;?>
            </div>
        </div>
        <div>
            <h2 class="h3 my-3"><?php echo $post["title"]; ?></h2>
            <?php if(!empty($post["path"])): ?>
            <img alt="" src="img/<?php echo($post["path"]);?>" class="w-100 mb-1" />
            <?php endif; ?>
            <p><?php echo $post["short_description"]; ?></p>
            <div class="progress" role="progressbar" aria-label="progress with donations" aria-valuenow= "<?php echo printVarIfPresent($post["ammount_raised"]); ?>" aria-valuemin="0" aria-valuemax="<?php echo $post["amount_requested"]; ?>">
                <div class="progress-bar" style="width: <?php echo round($post["ammount_raised"]/$post["amount_requested"] * 100,0)?>%"><?php echo round($post["ammount_raised"]/$post["amount_requested"] * 100,0)?>%</div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col inline text-start">
                <a href="profile.php?id=<?php echo $post["user_id"]; ?>" class="username">@<?php echo $post["username"]; ?></a>
            </div>
        </div>
    </article>
    <?php endforeach; ?>
<?php else: ?>
    <div class="text-center">
        <p>There are no posts :(</p>
        <p>Find someone new on the <a href="explore.php">explore page</a></p>
    </div>
<?php endif; ?>


