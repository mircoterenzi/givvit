<div class="modal fade" id="reply-msg-modal" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Reply to the message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="reply-text" class="form-label" hidden>Your reply</label>
                        <textarea class="form-control" id="reply-text" rows="3" placeholder="Insert your reply..."></textarea>
                    </div>
                </form>
            </div>
            <input type="hidden" id="reply-values" data-postId="" data-userId="" data-commentId="">
            <div class="modal-footer">
                <button id="send-reply" type="button" class="rm-follow btn">Reply</button>
            </div>
        </div>
    </div>
</div>