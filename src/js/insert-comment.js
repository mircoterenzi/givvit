document.addEventListener("DOMContentLoaded", function () {
    const sendButton = document.querySelectorAll('.send');
    const inputComment = document.getElementById('input-comment');

    sendButton.forEach(add => {
        add.addEventListener('click', function(){
        var commentValue = inputComment.value;/**contenuto di testo del commento di input, senza spazi bianchi ad inizio o fine */

        if (commentValue !== '') {
            var formData = new FormData();
            formData.append('inputComment', commentValue);
            formData.append('postId', add.getAttribute('postid'));
            axios.post('./api/insert-comment.php', formData);
        }
        });
    });
});

