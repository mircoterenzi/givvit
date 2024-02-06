document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('delete').addEventListener('click', async function () {
        var postId = this.getAttribute('post-id');
        var deleteFrom = new FormData();
        deleteFrom.append("postId", postId);
   
        var response = await axios.post('./api/delete-post.php', deleteFrom)
        if (response.data["done"]) {
            setTimeout(() => document.location.href = "index.php", 500);
        } else {
            alert( response.data["error"] );
        }
    });
});