<?php if(!empty($templateParams["posts"])): ?>
    <?php foreach($templateParams["posts"] as $post): ?>
    <article class="card mb-4 p-4 shadow-sm rounded-5">
        <div class="row">
            <div class="col text-start">
                <p class="badge"><?php echo $post["topic"]; ?></p>
            </div>
            <div class="col text-end">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
            </div>
        </div>
        <h2 class="h3 my-3"><?php echo $post["title"]; ?></h2>

        <?php if(!empty($post["path"])): ?>
            <img src="img/<?php echo($post["path"]);?>" class="img-fluid mb-1" alt="post image"/>
        <?php endif; ?>

        <p><?php echo $post["short_description"]; ?></p>
        <div class="progress" role="progressbar" aria-label="progress with donations" aria-valuenow= "<?php echo $post["ammount_raised"]?>" aria-valuemin="0" aria-valuemax="<?php echo $post["amount_requested"]; ?>">
            <div class="progress-bar" style="width: <?php echo round($post["ammount_raised"]/$post["amount_requested"] * 100,0)?>%">
            <?php echo round($post["ammount_raised"]/$post["amount_requested"] * 100,2)?> %
        </div>
        </div>
        <div class="row mt-2">
            <div class="col inline text-start">
                <a href="profile.php?id=<?php echo $post["user_id"]; ?>" class="username" id="<?php echo $post["user_id"]; ?>">@<?php echo $post["username"]; ?></a>
            </div>
            <div class="col text-end">
                <a href="open-post.php?id=<?php echo $post["post_id"]; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-arrow-up-right-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z"/>
                    </svg>
                </a>
            </div>
        </div>
    </article>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">There are no post :(</p>
<?php endif; ?>


