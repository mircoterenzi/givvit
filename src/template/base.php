<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <title>Givvit: <?php echo $templateParams["title"]; ?></title>
        <link rel="icon" type="image/x-icon" href="img/logo-icon.png"/>
        <?php
        if(isset($templateParams["js"])):
            foreach($templateParams["js"] as $script):
        ?>
            <script async src="<?php echo $script; ?>"></script>
        <?php
            endforeach;
        endif;
        ?>
    </head>
    <body class="container justify-content-center py-4">
        <!-- Top navbar -->
        <nav class="nav p-2 fixed-top shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col text-start pos-relative">
                        <svg data-bs-toggle="modal" data-bs-target="#notification-modal" xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-bell" viewBox="0 0 16 16" alt="bell icon">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                        </svg>
                        <?php
                        $templateParams["notifications"] = $dbh->getNotificationsById($_SESSION["userId"]);
                        if(!empty($dbh->getUnreadNotificationsById($_SESSION["userId"]))):
                        ?>
                        <span class="badge bg-danger"><?php echo(count($dbh->getUnreadNotificationsById($_SESSION["userId"]))); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col text-center">
                        <img src="img/logo.png" alt="Givvit logo" height="25"/>
                    </div>
                    <div class="col text-end">
                        <div class="d-flex justify-content-end">
                            <!-- Desktop menu -->
                            <div class="desktop me-2">
                                <a href="index.php" class="me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-house" viewBox="0 0 16 16" alt="home icon">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                                    </svg>
                                </a>
                                <a href="explore.php" class="me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-compass" viewBox="0 0 16 16" alt="compass icon">
                                        <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016m6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                                        <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
                                    </svg>
                                </a>
                                <a href="profile.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-person-circle" viewBox="0 0 16 16" alt="profile icon">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                    </svg>
                                </a>
                            </div>
                            <svg data-bs-toggle="modal" data-bs-target="#new-post-modal" xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-plus-circle" viewBox="0 0 16 16" alt="plus icon">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Mobile menu / Bottom navbar -->
        <div class="mobile">
            <div class="d-flex fixed-bottom justify-content-center">
                <nav class="nav p-3 mb-2 shadow-lg rounded-5">
                    <a href="explore.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-compass" viewBox="0 0 16 16" alt="compass icon">
                            <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016m6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                            <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
                        </svg>
                    </a>
                    <a href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-house mx-4" viewBox="0 0 16 16" alt="home icon">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                        </svg>
                    </a>
                    <a href="profile.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" class="bi bi-person-circle" viewBox="0 0 16 16" alt="profile icon">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
        <!-- Main -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <header class="d-flex px-4 mt-5">
                    <h1 class="h2"><?php echo $templateParams["title"]; ?></h1>
                </header>
                <main class="container">
                    <?php require($templateParams["name"]); ?>
                </main>
            </div>
        </div>
        <!-- Notification window -->
        <?php require_once("./components/notification-modal.php"); ?>
        <!-- Add new post window -->
        <?php require_once("./components/new-post-modal.php"); ?>
    </body>
</html>
