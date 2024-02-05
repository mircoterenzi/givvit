document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('send-comment').addEventListener('click', function () {
        var commentValue = document.getElementById('input-comment').value.trim();
        var postId = this.getAttribute('post-id');
        var reciver = this.getAttribute('owner-id');

        var notFrom = new FormData();
        notFrom.append("not_type",'Comment');
        notFrom.append("receiver",reciver);
        notFrom.append("post_id",postId);

        axios.post('./api/insertNotification.php', notFrom);

        var commentForm = new FormData();
        commentForm.append('inputComment', commentValue);
        commentForm.append('postId', postId);

        axios.post('./api/insert-comment.php', commentForm).then(response => {
            if (response.data["insertDone"]) {
                setTimeout(() => document.location.reload(), 1000);
            } else {
                document.getElementById('res').innerText = response.data["error"];
            }
        });
    });
});
