<div class="d-flex justify-content-end">
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Add filter</button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php foreach($templateParams["topics"] as $topic): ?>
        <li><a class="dropdown-item" href="#"><?php echo($topic["name"]) ?></a></li>
        <?php endforeach; ?>
    </ul>
    </div>
</div>