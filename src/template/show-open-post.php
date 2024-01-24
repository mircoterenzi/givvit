<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<?php
    $post_full= $templateParams["post_open"][0];
?>

<!-- Posts -->
</section>
        <!--itera ogni elemento $postnell'array $templateParams["posts"]-->
        <article class="mb-4 p-4 shadow-sm rounded-5 bg-white">
            <div class="row">
                <!--badge topic $post_full["topic"]-->
                <div class="col text-start">
                    <a class="badge link-underline link-underline-opacity-0 bg-primary"><?php echo $post_full["topic"]; ?></a>
                </div>

                <!--stella SVG-->
                <div class="col text-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                </div>
                <script>src="./js/star.js"</script>

            </div>
            <!--titolo del post-->
            <h2 class="h3 my-3"><?php echo $post_full["title"]; ?></h1>

            <div class="row mt-2">
                <!--ICONA BOTTONE IMG PROFILO, NON VERA FOTO-->
                <button type="button" class="btn btn-primary btn-sm rounded-circle" style="width: 28px; height: 28px;">
                    <i class="fa fa-user"></i>
                </button>
                <!--tag username-->
                <div class="col inline text-start">
                    <p><?php echo $post_full["username"] ?></p>
                </div>
            </div>
            <br>
        
            <!-- STAMPARE DA $post_full["image"]-->
            <!--carousel-->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/example.jpg" alt="" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/example.jpg" alt="" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/example.jpg" alt="" class="d-block w-100">
            </div>
            </div>
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
            </div>
            

            <!--descrizione lunga-->
            <p><?php echo $post_full["long_description"]; ?></p>

            <!--barra progressi-->
            <div class="progress" role="progressbar" aria-label="progress with donations" aria-valuenow="25" aria-valuemin="0" aria-valuemax="<?php echo $post_full["amount_requested"]; ?>">
                <div class="progress-bar" style="width:  <?php echo round($post_full["ammount_raised"]/$post_full["amount_requested"] * 100,0)?>%">
                <?php echo round($post_full["ammount_raised"]/$post_full["amount_requested"] * 100,2)?> % 
            </div>
            </div>

            <!-- Post selection -->
            <section class="d-flex flex-row p-4">
                <button type="button" class="btn btn-outline-secondary mx-2">import: $</button>
                <button type="button" class="btn btn-primary mx-2 bg-success">donate</button>
            </section>

            <!--commenti-->
            <div class="form-floating">
            <textarea class="form-control" id="comment" name="text" placeholder="Comment goes here"></textarea>
            <label for="comment">Commenta...</label>
            </div>
        </article>

</section>
