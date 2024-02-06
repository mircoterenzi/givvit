document.addEventListener('DOMContentLoaded', function () {
    var replyButton = document.getElementById('reply');
    var replyText = document.getElementById('reply-text');
    var replyValues = document.getElementById('reply-values');
    var sendReplyButton = document.getElementById('send-reply');

    if(replyButton != null) {
        replyButton.addEventListener('click', function () {
            replyValues.setAttribute('data-postId', replyButton.getAttribute('data-postId'));
            replyValues.setAttribute('data-userId', replyButton.getAttribute('data-userId'));
            replyValues.setAttribute('data-commentId', replyButton.getAttribute('data-commentId'));
        });
    }

    sendReplyButton.addEventListener('click', async function () {
        var commentValue = replyText.value.trim();
        var postId = replyValues.getAttribute('data-postId');
        var receiver = replyValues.getAttribute('data-userId');
        var commentId = replyValues.getAttribute('data-commentId');

        var commentForm = new FormData();
        commentForm.append('inputComment', commentValue);
        commentForm.append('postId', postId);
        commentForm.append('comment_id', commentId);

        var response = await axios.post('./api/insert-response.php', commentForm);
        if (response.data["insertDone"]) {
            var notFrom = new FormData();
            notFrom.append("not_type",'Reply');
            notFrom.append("receiver",receiver);
            notFrom.append("post_id",postId);

            console.log("wait");
    
            await axios.post('./api/insert-notification.php', notFrom);

            setTimeout(() => document.location.reload(), 100);
        } else {
            alert(response.data["error"]);
        }
    });
});
