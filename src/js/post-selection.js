document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.btn')
    buttons.forEach((b) => {
        b.addEventListener('click', function () {
            const id = b.id;
            const formData = new FormData();
            formData.append('id', id);
            axios.post("./api/post-selection.php",formData).then(response => {
                document.location.href = "profile.php";
            });

        });
    });
});