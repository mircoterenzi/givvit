document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('confirm-delete').addEventListener('click', async function () {
        const postId = this.getAttribute('data-post-id');
        const deleteFrom = new FormData();
        deleteFrom.append("postId", postId);
   
        const response = await axios.post('./api/delete-post.php', deleteFrom)
        if (response.data["done"]) {
            setTimeout(() => document.location.href = "index.php", 500);
        } else {
            alert( response.data["error"] );
            location.reload();
        }
    });
});