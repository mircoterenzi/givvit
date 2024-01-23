document.addEventListener("DOMContentLoaded", function () {
    const add = document.querySelector('.add-follow');
    if(add != null) {
        add.addEventListener('click', () => manageFollow("follow"));
    }

    const rm = document.querySelector('.rm-follow');
    if(rm != null) {
        rm.addEventListener('click', () => manageFollow("unfollow"));
    }

    function manageFollow(type) {
        const card = document.querySelector('.card');
        const formData = new FormData();
            formData.append('type', type);
            formData.append('id', card.id);
            axios.post("./api/manage-follow.php",formData).then(() => {
                setTimeout(() => location.reload(), 200)
            });
    }
});