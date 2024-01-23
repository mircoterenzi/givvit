<div class="modal fade" id="rm-follow-modal" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Pay attention</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    You are unfollowing <?php
                    require_once("db-config.php");
                    echo $dbh->getUserById($_GET["id"])[0]["username"];
                    ?>. Are you sure?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="rm-follow btn">Unfollow</button>
            </div>
        </div>
    </div>
</div>