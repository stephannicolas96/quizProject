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

$('input[strength]').on('keyup', function () {
    let strength = $('.passwordStrengthForeground', $(this).parent());
    $.ajax({
        type: 'POST',
        url: '../ajax/passwordChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        success: function (data) {
            strength.attr('strength', data);
        }
    });
});

$('#opponentUsername').on('input', function () {
    $.ajax({
        type: 'POST',
        url: '../ajax/getAllUsername.php',
        data: {
            username: $(this).val()
        },
        timeout: 1000,
        success: function (data) {
            data = JSON.parse(data);
            let users = {};
            for (var i = 0; i < data.length; i++) {
                users[data[i].username] = '../assets/images/userImages/' + data[i].image;
            }
            $('#opponentUsername').autocomplete({
                data: users,
                minLength: 0, // The minimum length of the input for the autocomplete to start. Default: 1.
                limit: 10,
            });
        }
    });
});