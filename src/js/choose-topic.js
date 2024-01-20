document.addEventListener("DOMContentLoaded", function () {
    const topics = document.querySelectorAll('.dropdown-item');
    topics.forEach((t) => {
        t.addEventListener('click', function() {
            const name = t.id;
            const formData = new FormData();
            formData.append('topic', name);
            axios.post('./api/choose-topic.php', formData).then(() => {
                setTimeout(() => document.location.href = "explore-with-topic.php", 1000);
            });
        });
    });
});
