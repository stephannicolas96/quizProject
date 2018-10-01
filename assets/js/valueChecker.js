$('input[type=email]').change(function (event) {
    var target = $(event.target);
    $.ajax({
        type: 'POST',
        url: '../ajax/emailChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        success: function (data) {
            console.log(data);
            if (data == '1') {
                target.removeClass('notOk');
                target.addClass('ok');
            } else {
                target.removeClass('ok');
                target.addClass('notOk');
            }
        },
        error: function () {
            target.removeClass('ok');
            target.addClass('notOk');
        }
    });
});

$('input[strength]').on('keyup', function () {
    let strength = $('.passwordStrengthForeground', $(this).parent());
    $.ajax({
        type: 'POST',
        url: '../ajax/passwordChecker.php',
        data: {
            inputValue: $(this).val()
        },
        success: function (data) {
            strength.attr('strength', data);
        },
        error: function () {
            console.log('error');
        }
    });
});