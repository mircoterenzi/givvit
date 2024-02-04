document.addEventListener("DOMContentLoaded", function () {
    const sendButton = document.querySelectorAll('.send');
    const inputComment = document.getElementById('input-comment');

    sendButton.forEach(add => {
        add.addEventListener('click', function(){
        var commentValue = inputComment.value.trim();/**contenuto di testo del commento di input, senza spazi bianchi ad inizio o fine */
        if (commentValue !== '') {
            var formData = new FormData();
            formData.append('inputComment', commentValue);
            formData.append('postId', add.getAttribute('postid'));/**prendo da post id perchè è id proprio del bottone */
            axios.post('./api/insert-comment.php', formData);
        }else{
            /**il commento è vuoto e non lo aggiungo al database */
        }
        });
    });
});

