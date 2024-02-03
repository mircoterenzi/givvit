document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll('.post');
    
    cards.forEach(c => {
        c.addEventListener('click', function(){
            const path = c.getAttribute('data-link');
            setTimeout(() => {
                window.location.href = path;
            }, 100);
        });
    });
});