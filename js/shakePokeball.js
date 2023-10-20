document.querySelector('.pokeball-image').addEventListener('click', function() {
    var pokeball = this;

    pokeball.classList.add('pokeball-clicked');
    
    pokeball.addEventListener('animationend', function() {
        pokeball.classList.remove('pokeball-clicked');
    }, { once: true });
});