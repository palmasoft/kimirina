$(function() {
    var timeout = 0;

    // If our browser support transitions (class will be added with the help of modernizr library) add a timeout of 750ms
    // Nice fallback for our animation on older browser (such as IE8-9)
    if ($('html').hasClass('csstransitions'))
        timeout = 750;

    // On button hover or touch reveal the login form
    $('.login-btn').mouseenter(function() {
        $('#login-marco').removeClass('brillo-login');
        $('.left-door, .right-door, .login-btn').addClass('login-animate');

        setTimeout(function() {

            $('#login-container').fadeIn(1500);
            if (is_chrome()) {
                $('.login-btn .name').fadeOut(250, function() {
                    //$('.login-btn .square1, .login-btn .square2').fadeIn(750);
                    $('#login-user').focus();
                });
            } else {
                $('#aviso-navegador').slideDown();
                $('#login-block').slideUp();
            }

        }, timeout);
    });

    $("#login-form").submit(function(event) {
        if (event.handled !== true) {
            validar_usuario();
            event.handled = true;
        }
        return false;
    });

});


function is_chrome() {
    var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    return is_chrome;
}