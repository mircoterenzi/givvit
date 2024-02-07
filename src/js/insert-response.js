document.addEventListener('DOMContentLoaded', function () {
    const replyButton = document.getElementById('reply');
    const replyText = document.getElementById('reply-text');
    const replyValues = document.getElementById('reply-values');
    const sendReplyButton = document.getElementById('send-reply');

    if(replyButton != null) {
        replyButton.addEventListener('click', function () {
            replyValues.setAttribute('data-postId', replyButton.getAttribute('data-postId'));
            replyValues.setAttribute('data-userId', replyButton.getAttribute('data-userId'));
            replyValues.setAttribute('data-commentId', replyButton.getAttribute('data-commentId'));
        });
    }

    sendReplyButton.addEventListener('click', async function () {
        const commentValue = replyText.value.trim();
        const postId = replyValues.getAttribute('data-postId');
        const receiver = replyValues.getAttribute('data-userId');
        const commentId = replyValues.getAttribute('data-commentId');

        const commentForm = new FormData();
        commentForm.append('inputComment', commentValue);
        commentForm.append('postId', postId);
        commentForm.append('comment_id', commentId);

        const response = await axios.post('./api/insert-response.php', commentForm);
        if (response.data["insertDone"]) {
            const notFrom = new FormData();
            notFrom.append("not_type",'Reply');
            notFrom.append("receiver",receiver);
            notFrom.append("post_id",postId);
    
            await axios.post('./api/insert-notification.php', notFrom);

            setTimeout(() => document.location.reload(), 100);
        } else {
            alert(response.data["error"]);
        }
    });
});
