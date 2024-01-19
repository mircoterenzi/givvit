<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Givvit: <?php echo $templateParams["title"]; ?></title>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="../../js/login.js" defer></script>
        <script src="../../js/register.js" defer></script>
        <link rel="icon" type="image/x-icon" href="img/logo-icon.png"/>
    </head>
    <body class="d-flex justify-content-center py-4 bg-primary-subtle">
        <div class="mw-75 m-3 p-5 shadow-lg rounded-5 bg-white">
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
