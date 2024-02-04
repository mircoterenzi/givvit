document.addEventListener("DOMContentLoaded", function () {
    const sendButton = document.querySelectorAll('.send');
    const inputComment = document.getElementById('.input-comment');
    
    sendButton.forEach(add => {
        add.addEventListener('click', function(){
            const formData = new FormData();
            alert("Ciao");
        });
    });
});

