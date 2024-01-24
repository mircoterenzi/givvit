<?php include_once("db-config.php"); ?>
<div class="modal fade" id="user-list-modal" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <nav>
                    <a href="#followers" class="me-3">Followers</a>
                    <a href="#following">Following</a>
                </nav>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <h1 class="h5" id="followers">Followers:</h1>
                    <ul>
                        <?php foreach($dbh->getUserFollowers($_GET["id"]) as $follower): ?>
                        <li class="m-2">
                            <a class="p-3" href="profile.php?id=<?php echo $follower["user_id"]; ?>"><?php echo $follower["username"]; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <h1 class="h5" id="followers">Following:</h1>
                    <ul>
                        <?php foreach($dbh->getFollowedByUser($_GET["id"]) as $followed): ?>
                        <li class="m-2">
                            <a href="profile.php?id=<?php echo $followed["user_id"]; ?>"><?php echo $followed["username"]; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>