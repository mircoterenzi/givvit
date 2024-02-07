<div class="modal fade" id="rm-post-modal" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Pay attention</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>you are deleting this post forever. Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Undo</button>
                <button type="button" class="btn"  id="confirm-delete" data-post-id ="<?php echo $post_full["post_id"]; ?>" >Delet post</button>
            </div>
        </div>
    </div>
</div>