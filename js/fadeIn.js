$(document).ready(function () {
    $('.card-element').each(function (index) {
        var $card = $(this);
        setTimeout(function () {
            $card.removeClass('fadeIn');
        }, index * 100); // 200 ms de retraso entre elementos (ajusta según tus preferencias)
    });
});