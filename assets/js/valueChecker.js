var emailAjax = null;
$('input[type=email]').change(function (event) {
    var target = $(event.target);
    $.ajax({
        type: 'POST',
        url: '../ajax/emailChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        beforeSend: function () {
            if (emailAjax != null) {
                emailAjax.abort();
            }
        },
        success: function (data) {
            if (data == '1') {
                target.removeClass('notOk');
                target.addClass('ok');
            } else {
                target.removeClass('ok');
                target.addClass('notOk');
            }
        }
    });
});

var passwordAjax = null;
$('input[strength]').on('keyup', function () {
    let strength = $('.passwordStrengthForeground', $(this).parent());
    $.ajax({
        type: 'POST',
        url: '../ajax/passwordChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        beforeSend: function () {
            if (passwordAjax != null) {
                passwordAjax.abort();
            }
        },
        success: function (data) {
            strength.attr('strength', data);
        }
    });
});

var usernameAjax = null;
$('#opponentUsername').on('input', function () {
    usernameAjax = $.ajax({
        type: 'POST',
        url: '../ajax/getAllUsername.php',
        data: {
            username: $(this).val()
        },
        timeout: 1000,
        beforeSend: function () {
            if (usernameAjax != null) {
                usernameAjax.abort();
            }
        },
        success: function (data) {
            data = JSON.parse(data);
            let users = {};
            if (data['success']) {
                for (var i = 0; i < data['data'].length; i++) {
                    users[data['data'][i].username] = '../assets/images/userImages/' + data['data'][i].image;
                }
            }
            $('#opponentUsername').autocomplete({
                data: users,
                limit: 10,
            });
        }
    });
});