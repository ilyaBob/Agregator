$('.login__close, .overlay').on('click', function () {
    $('.overlay, .login').hide();
})
$('.js-show-login').on('click', function () {
    $('.overlay, .login').show();
})

$('.nav__btn').click(function () {
    if ($(this).hasClass('is-active')) {
        $(this).parents('.submenu').removeClass('is-active');
        $(this).removeClass('is-active');
        $(this).next().hide();
    } else {
        $(this).parents('.submenu').addClass('is-active');
        $(this).addClass('is-active');
        $(this).next().show();
    }
});
