document.addEventListener("DOMContentLoaded", function () {
    const addStars = document.querySelectorAll('.empty-star');
    const removeStars = document.querySelectorAll('.full-star');
    
    addStars.forEach(add => {
        add.addEventListener('click', function(){
            const formData = new FormData();
            formData.append('type', "liked");
            formData.append('postid', add.getAttribute('data-post-id'));

            var notFrom = new FormData();
            notFrom.append("not_type", 'Like');
            notFrom.append("receiver", add.getAttribute('data-owner-id'));
            notFrom.append("post_id", add.getAttribute('data-post-id'));
            axios.post('./api/insert-notification.php',notFrom);

            axios.post("./api/star.php",formData).then(() => {
                setTimeout(() => location.reload(), 100)
            });
        });
    });

    removeStars.forEach(remove => {
        remove.addEventListener('click', function(){
            const formData = new FormData();
            formData.append('type', "not-liked");
            formData.append('postid', remove.getAttribute('data-post-id')); 
            axios.post("./api/star.php",formData).then(() => {
                setTimeout(() => location.reload(), 100)
            });
        });
    });
});

