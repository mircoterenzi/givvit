document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('delete').addEventListener('click', async function () {
        var postId = this.getAttribute('post-id');
   
        var response = await axios.post('./api/delete.post.php', deleteFrom)
        if (response.data["done"]) {
            setTimeout(() => document.location.href = "index.php", 500);
        } else {
            document.getElementById("res").innerText = response.data["error"];
        }
    });
});