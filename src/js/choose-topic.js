document.addEventListener("DOMContentLoaded", function () {
    const topics = document.querySelectorAll('.dropdown-item')
    topics.forEach((t) => {
        t.addEventListener('click', function () {
            const id = t.id;
            const formData = new FormData();
            formData.append('id', id);
            axios.post("./api/choose-topic.php",formData).then(response => {
                setTimeout(() => document.location.href = "explore.php");
            });

        });
    });
});