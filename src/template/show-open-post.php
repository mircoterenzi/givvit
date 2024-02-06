<!DOCTYPE html>
<html lang="it">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <?php
        $post_full= $templateParams["post_open"];
        $images = $dbh -> getFilesById($post_full["post_id"]);
        $comments = $dbh -> getCommentOnPost($post_full["post_id"]);
    ?>
</body>


<!-- Post -->
<section>
    <article class="mainpost mb-4 p-4 shadow-sm rounded-5 bg-white" id="<?php echo $post_full["post_id"]; ?>">
        <div class="row">
            <!--badge topic $post_full["topic"]-->
            <div class="col text-start">
                <a class="badge" href="explore.php?topic=<?php echo $post_full["topic"]; ?>"><?php echo $post_full["topic"]; ?></a>
            </div>
            <?php if($_SESSION["userId"] != $post_full["user_id"]):?>
                <!--stella SVG-->
                <div class="col d-flex text-end justify-content-end">
                    <p class="mb-0 me-2"><?php echo $post_full["numLikes"] ?></p>
                    <?php
                        if(empty($dbh->checkLikeByUser($post_full["post_id"], $_SESSION["userId"]))):
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" class="clickable empty-star bi bi-star" viewBox="0 0 16 16" owner-id ="<?php echo $post_full["user_id"]; ?>" post-id ="<?php echo $post_full["post_id"]; ?>" >
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                    </svg>
                    <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" class="clickable full-star bi bi-star-fill" viewBox="0 0 16 16" value ="<?php echo $post_full["post_id"]; ?>">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <?php endif;?>
                </div>
            <?php else:?>
                <div class="col d-flex text-end justify-content-end">
                <svg xmlns="http://www.w3.org/2000/svg" id="delete" post-id ="<?php echo $post_full["post_id"]; ?>" width="20" class="clickable bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                </svg>
                </div>
            <?php endif;?>
            
        </div>
        <!--titolo del post-->
        <h2 class="h3 my-3"><?php echo $post_full["title"]; ?></h2>

        <div class="row mb-3">
            <div class="col-2">
                <div class="ratio ratio-1x1 overflow-hidden">
                    <?php $user = $dbh->getUserById($post_full["user_id"])[0]; ?>
                    <img  alt="profile picture" src="img/<?php 
                    if(!empty($user["profile_img"])) {
                    echo($user["profile_img"]); 
                    } else {
                    echo("default-propic.jpg");
                    } ?>" class="propic rounded-circle" />
                </div>
            </div>
            <!--tag username-->
            <div class="col text-start">
                <a href="profile.php?id=<?php echo $post_full["user_id"]; ?>" class="username" id="<?php echo $post_full["user_id"]; ?>">@<?php echo $post_full["username"]; ?></a>
            </div>
        </div>
    
        <?php if(!empty($images)): ?>  
        <!--carousel-->
        <div id="demo" class="carousel slide mb-3" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <?php foreach ($images as $image): ?>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php echo $image["file_id"] - 1; ?>" <?php echo ($image["file_id"] == 1) ? 'class="active"' : ''; ?>></button>
                <?php endforeach; ?>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <?php foreach ($images as $image): ?>
                    <div class="carousel-item <?php echo ($image["file_id"] == 1) ? 'active' : ''; ?>">
                        <img alt="decorative img" class="d-block w-100" src="img/<?php echo $image["name"]; ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Left and right controls/icons -->
            <?php if (sizeof($images) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!--descrizione lunga-->
        <p><?php echo $post_full["long_description"]; ?></p>

        <!--barra progressi-->
        <div class="progress progress-custom" role="progressbar" aria-label="progress with donations" aria-valuenow= "<?php echo $post_full["ammount_raised"]?>" aria-valuemin="0" aria-valuemax="<?php echo $post_full["amount_requested"]; ?>">
            <div class="progress-bar" style="width: <?php echo round($post_full["ammount_raised"]/$post_full["amount_requested"] * 100,0)?>%"><?php echo round($post_full["ammount_raised"]/$post_full["amount_requested"] * 100,0)?>%</div>
        </div>

        <?php if($_SESSION["userId"] != $post_full["user_id"]): ?> <!-- can't donate or comment to yourself-->
            <!-- Donation -->
            <div class="row mt-3">
                <div class="col">
                    <label for="donation-amount" hidden>Import (€)</label>
                    <input class="form-control" id="donation-amount" placeholder="Import (€)" />
                </div>
                <div class="col-auto">
                    <button type="button" class="btn ms-2" id="send-donation" post-id ="<?php echo $post_full["post_id"]; ?>"  owner-id ="<?php echo $post_full["user_id"]; ?>">Donate</button>
                </div>
            </div>

            <!-- Elemento per mostrare messaggi di errore -->
            <p id="errorMessage" style="color: red;"></p>


            <!--inserimento commento-->
            <div class="row comment-send align-items-center">
                <div class="col-11">
                    <label for="input-comment" hidden>Insert your comment:</label>
                    <textarea class="form-control" id="input-comment" name="inputText" placeholder="Insert your comment"></textarea>
                </div>
                <div class="col-1 ps-1">
                    <svg xmlns="http://www.w3.org/2000/svg" id ="send-comment" width="20" class="send clickable bi bi-send-fill" viewBox="0 0 16 16" post-id ="<?php echo $post_full["post_id"]; ?>" owner-id ="<?php echo $post_full["user_id"]; ?>" >
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                    </svg>
                </div>
            </div>
            <p id="res" style="color: red;"></p>
            <hr class="hr hr-blurry m-2" />
        <?php endif; ?>
        <!--lista di commenti del post-->
        <section>
            <?php if(!empty($comments)):
                foreach($comments as $comment): ?>
                    <div class="row mt-3">
                        <div class="col-2">
                            <div class="ratio ratio-1x1 overflow-hidden">
                                <img  alt="profile picture" src="img/<?php 
                                if(!empty($comment["profile_img"])) {
                                echo($comment["profile_img"]); 
                                } else {
                                echo("default-propic.jpg");
                                } ?>" class="propic rounded-circle" />
                            </div>
                        </div>
                        <div class="col-10">
                            <article class="card-comment p-3 shadow-sm rounded-4 bg-light">
                                <p><?php echo $comment["text"];?></p>
                                <section class="row">
                                    <div class="col">
                                        <a href="profile.php?id=<?php echo $comment["user"]; ?>" class="username" id="<?php echo $comment["user"]; ?>">@<?php echo $comment["username"]; ?></a>
                                    </div>
                                    <div class="col text-end">
                                        <?php if ($_SESSION["userId"] == $post_full["user_id"] && empty($comment["responded_by"])): ?>
                                            <button data-bs-toggle="modal" data-bs-target="#reply-msg-modal" type="button" class="btn btn-sm" id="reply"
                                                    data-postId="<?php echo $post_full['post_id']; ?>"
                                                    data-userId="<?php echo $comment['user']; ?>"
                                                    data-commentId="<?php echo $comment['comment_id']; ?>">Reply</button>
                                        <?php endif; ?>
                                    </div>
                                </section>
                            </article>
                        </div>
                    </div>
                    <!--controllo se il commento ha una risposta-->
                    <?php if(!empty($comment["responded_by"])): ?>
                    <div class = "row justify-content-end mt-3">
                        <div class="col-1 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </div>
                        <div class="col-6">
                            <article class="card-comment p-2 shadow-sm rounded-4 bg-light">
                                <?php $response = $dbh->getCommentOnPostResponse($post_full["post_id"], $comment["responded_by"]);
                                    echo $response[0]["text"];
                                ?>   
                                <div class="row">
                                    <div class="col text-end">
                                        <a href="profile.php?id=<?php echo $post_full["username"]; ?>" >@<?php echo $post_full["username"]; ?></a>
                                    </div>
                                </div>                                         
                            </article>
                        </div>
                        <div class="col-2">
                            <div class="ratio ratio-1x1 overflow-hidden">
                                <?php $user = $dbh->getUserById($post_full["user_id"])[0]; ?>
                                <img  alt="profile picture" src="img/<?php 
                                if(!empty($user["profile_img"])) {
                                echo($user["profile_img"]); 
                                } else {
                                echo("default-propic.jpg");
                                } ?>" class="propic rounded-circle" />
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center mt-3">There are no comments :'( </p>
            <?php endif; ?>
        </section>
    </article>
</section>
<?php include("./components/reply-modal.php"); ?>
</html>