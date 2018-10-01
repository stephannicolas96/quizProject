$('input[type=password]').each(function () {
    let input = $(this);
    let button = $('<button class="btn-password fas fa-eye" type="button"></button>');
    input.parent().append(button);
    button.click(function () {
        if (button.hasClass('fa-eye')) {
            input.attr('type', 'text');
            button.addClass('fa-eye-slash');
            button.removeClass('fa-eye');
        } else {
            input.attr('type', 'password');
            button.addClass('fa-eye');
            button.removeClass('fa-eye-slash');
        }
    });
});
$('input[type=password][strength]').each(function () {
    let input = $(this);
    input.parent().append('<div class="passwordStrength"><div class="passwordStrengthForeground" strength="' + input.attr('strength') + '"></div></div>');
    input.removeAttr('strength');
});