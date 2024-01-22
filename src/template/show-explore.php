<div class="d-flex justify-content-between px-2 mb-3">
    <h2 class="h5">
        <?php if(!empty($_GET["topic"])): ?>
        <span class="badge text-center"><?php echo $_GET['topic']; ?></span>
        <?php endif; ?>
    </h2>
    <div class="dropdown">
        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
        </svg>
            Manage filter
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a href="explore.php" class="dropdown-item">Remove Filters</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php foreach($templateParams["topics-list"] as $topic): ?>
                <li><a href="explore.php?topic=<?php echo $topic["name"]; ?>" class="dropdown-item"><?php echo $topic["name"]; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php require("show-post.php"); ?>