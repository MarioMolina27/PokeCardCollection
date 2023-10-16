$(document).ready(function () {
    $('.card-element').each(function (index) {
        var $card = $(this);
        setTimeout(function () {
            $card.removeClass('fadeIn');
            $card.css('display', 'block'); // Muestra el elemento
        }, index * 400); // 200 ms de retraso entre elementos (ajusta según tus preferencias)
    });
});