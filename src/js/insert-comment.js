document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('send-comment')
    
    if (btn != null) {
        btn.addEventListener('click', async function () {
            const commentValue = document.getElementById('input-comment').value.trim();
            const postId = this.getAttribute('post-id');
            const receiver = this.getAttribute('owner-id');

            const commentForm = new FormData();
            commentForm.append('inputComment', commentValue);
            commentForm.append('postId', postId);
            commentForm.append('receiver',receiver);

            const response = await axios.post('./api/insert-comment.php', commentForm)
            if (response.data["insertDone"]) {
                setTimeout(() => document.location.reload(), 100);
                const notFrom = new FormData();
                notFrom.append("not_type",'Comment');
                notFrom.append("receiver",receiver);
                notFrom.append("post_id",postId);
        
                axios.post('./api/insert-notification.php', notFrom);
            } else {
                document.getElementById("res").innerText = response.data["error"];
            }
        });
    }
});
