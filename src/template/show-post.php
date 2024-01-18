<?php if(isset($templateParams["posts"])): ?>
    <?php foreach($templateParams["posts"] as $post): ?>
    <article class="mb-4 p-4 shadow-sm rounded-5 bg-white">
        <div class="row">
            <div class="col text-start">
                <a class="badge link-underline link-underline-opacity-0 bg-primary"><?php echo $post["topic"]; ?></a>
            </div>
            <div class="col text-end">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
            </div>
        </div>
        <h2 class="h3 my-3"><?php echo $post["title"]; ?></h1>

        <!-- If the photo is present:
            <?php if(isset($post["image"])): ?>
            <?php echo $templateParams["image"]; ?>
            <?php endif; ?>
        -->

        <img src="img/example.jpg" class="img-fluid mb-1" alt="post image"/>
        <p><?php echo $post["short_description"]; ?></p>
        <div class="progress" role="progressbar" aria-label="progress with donations" aria-valuenow="25" aria-valuemin="0" aria-valuemax="<?php echo $post["amount_requested"]; ?>">
            <div class="progress-bar" style="width: 25%">25%</div>
        </div>
        <div class="row mt-2">
            <div class="col inline text-start">
                <p>@username</p>
            </div>
            <div class="col text-end">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
        </div>
    </article>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">Non ci sono post :(</p>
<?php endif; ?>


