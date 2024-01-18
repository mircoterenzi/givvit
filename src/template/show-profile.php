<!-- Profile bubble -->
<section class="container p-4 shadow-sm rounded-5 bg-white">
    <div class="d-flex justify-content-center mb-2">
        <div class="ratio ratio-1x1 align-self-center w-50">
            <img src="img/example.jpg" class="rounded-circle img-fluid h-100 w-auto" alt="profile picture"/>
        </div>
        <div class="col align-self-center ms-4">
            <p class="row">Followers: #</p>
            <p class="row">Following: #</p>
        </div>
    </div>
    <div class="row">
        <div class="col text-start">
            <p class="fw-bold">@username</p>
        </div>
        <div class="col text-end">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
            </svg>
        </div>
    </div>
    <p>Sono un ragazzo a cui piace la vita fuori dagli schemi senza diagrammi degli stati, classi e di attività</p>
</section>

<!-- Post selection -->
<section class="d-flex p-4 justify-content-center">
    <button type="button" class="btn btn-primary mx-2">Posted: #</button>
    <button type="button" class="btn btn-primary mx-2">Supported: #</button>
</section>

<!-- Posts -->
</section>
    <?php require("show-post.php"); ?>
</section>