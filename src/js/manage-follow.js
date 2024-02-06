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
        const userId = card.getAttribute('user-id');
        if(type == "follow" ){
            var notFrom = new FormData();
            notFrom.append("not_type", 'Follow');
            notFrom.append("receiver", card.getAttribute('user-id'));
            axios.post('./api/insertNotification.php',notFrom);
        }

        const formData = new FormData();
        formData.append('type', type);
        formData.append('id', userId);
        axios.post("./api/manage-follow.php",formData).then(() => {
            setTimeout(() => location.reload(), 100)
        });
    }
});