
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
    const add = document.querySelector('.empty-star');
    if(add != null) {
        add.addEventListener('click', () => star("liked"));
    }

    const remove = document.querySelector('.full-star');
    if(remove != null) {
        remove.addEventListener('click', () => star("not-liked"));
    }

    function star(type) {
        const mainpost = document.querySelector('.mainpost');
        const formData = new FormData();
            formData.append('type', type);
            formData.append('postid', mainpost.id);
            axios.post("./api/star.php",formData).then(() => {
                setTimeout(() => location.reload(), 100)
            });
    }
});
