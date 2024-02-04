document.getElementById('send-comment').addEventListener('click', function () {
    var commentValue = document.getElementById('input-comment').value.trim();
    var postId = this.getAttribute('post-id');

    var commentForm = new FormData();
    commentForm.append('inputComment', commentValue);
    commentForm.append('postId', postId);

    console.log(commentForm.get('inputComment'), commentForm.get('postId'));

    axios.post('./api/insert-comment.php', commentForm).then(response => {
        if (response.data["insertDone"]) {
            setTimeout(() => document.location.reload(), 1000);
        } else {
            document.getElementById('res').innerText = response.data["error"];
        }
    });
});
