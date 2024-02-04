
/*
//observer che controlla cambiamenti in postContainer e poi chiamare il callback
const postContainerLike = document.getElementById('postContainer');
// Questa chiamata iniziale può essere intesa per inizializzare alcune operazioni o per eseguire operazioni prima che l'observer inizi a monitorare i cambiamenti
callBackFunctionLike()

// MutationObserver monitora observerLike e chiama callBackFunctionLike ogni votla che ci sono cambiamenti nel container
var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
var observerLike = new MutationObserver(callBackFunctionLike);
observerLike.observe(postContainerLike, {
    childList: true
});

*/

document.addEventListener("DOMContentLoaded", function () {
    const addStars = document.querySelectorAll('.empty-star');
    const removeStars = document.querySelectorAll('.full-star');
    
    addStars.forEach(add => {
        add.addEventListener('click', function(){
            const formData = new FormData();
            formData.append('type', "liked");
            formData.append('postid', add.getAttribute('post-id'));

            var notFrom = new FormData();
            notFrom.append("not_type", 'Like');
            notFrom.append("receiver", add.getAttribute('owner-id'));
            notFrom.append("post_id", add.getAttribute('post-id'));
            axios.post('./api/insertNotification.php',notFrom);

            axios.post("./api/star.php",formData).then(() => {
                setTimeout(() => location.reload(), 100)
            });
        });
    });

    removeStars.forEach(remove => {
        remove.addEventListener('click', function(){
            const formData = new FormData();
            formData.append('type', "not-liked");
            formData.append('postid', remove.getAttribute('value')); 
            axios.post("./api/star.php",formData).then(() => {
                setTimeout(() => location.reload(), 100)
            });
        });
    });
});

