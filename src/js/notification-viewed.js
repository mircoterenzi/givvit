document.addEventListener("DOMContentLoaded", function () {
    const notifications = document.querySelectorAll('.notification')
    notifications.forEach((n) => {
        n.addEventListener('click', function () {
            if (!this.classList.contains("seen")) {
                const id = n.id;
                n.style.opacity = "0.5"; 
                const formData = new FormData();
                formData.append('id', id);
                axios.post("./api/notification-viewed.php",formData);
                this.classList.add("seen");
            }   
        });
    });
});