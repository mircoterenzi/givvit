<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <title>Givvit: <?php echo $templateParams["title"]; ?></title>
        <link rel="icon" type="image/x-icon" href="img/logo-icon.png"/>
        <?php
        if(isset($templateParams["js"])):
            foreach($templateParams["js"] as $script):
        ?>
            <script defer src="<?php echo $script; ?>"></script>
        <?php
            endforeach;
        endif;
        ?>
    </head>
    <body class="d-flex justify-content-center py-4">
        <div class="card mw-75 m-3 p-5 shadow-lg rounded-5">
            <header>
                <img src="img/logo-icon.png" alt="Givvit icon" width="40"/>
                <h1 class="h3 my-3 fw-normal"><?php echo $templateParams["title"]; ?></h1>
            </header>
            <main>
                <?php require($templateParams["name"]); ?>
            </main>
        </div>
    </body>
</html>
