document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('send-comment').addEventListener('click', async function () {
        var commentValue = document.getElementById('input-comment').value.trim();
        var postId = this.getAttribute('post-id');
        var receiver = this.getAttribute('owner-id');

        var commentForm = new FormData();
        commentForm.append('inputComment', commentValue);
        commentForm.append('postId', postId);
        commentForm.append('receiver',receiver);

        var response = await axios.post('./api/insert-comment.php', commentForm)
            if (response.data["insertDone"]) {
                setTimeout(() => document.location.reload(), 1000);
                var notFrom = new FormData();
                notFrom.append("not_type",'Comment');
                notFrom.append("receiver",receiver);
                notFrom.append("post_id",postId);
        
                axios.post('./api/insertNotification.php', notFrom);
            } else {
                document.getElementById("res").innerText = response.data["error"];
            }
        });
});
