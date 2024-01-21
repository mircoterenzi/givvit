document.addEventListener("DOMContentLoaded", function () {
    const notifications = document.querySelectorAll('.notification')
    notifications.forEach((n) => {
        n.addEventListener('mouseout', function () {
            if (!this.classList.contains("seen")) {
                const id = n.id;
                const curr = document.getElementById(id);
                curr.style.opacity = "0.5"; 
                const formData = new FormData();
                formData.append('id', id);
                axios.post("./api/notification-viewed.php",formData).then(() => {
                    setTimeout(() => document.location.href = "", 30000); //TODO make better
                });
                this.classList.add("seen");
            }
        });
    });
});