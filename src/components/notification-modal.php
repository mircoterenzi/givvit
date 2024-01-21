<div class="modal fade" id="notification-modal" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="notifications">Notifications</h1>
                <button type="button" onclick="reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                require("template/show-notification.php");
                ?>
            </div>
        </div>
    </div>
</div>