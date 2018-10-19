$('input[type=email]').blur(function (event) {
    var target = $(event.target);
    $.ajax({
        type: 'POST',
        url: '../ajax/emailChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        success: function (data) {

        }
    });
});

$('input[strength]').blur(function () {
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
        url: '../ajax/getTenUsername.php',
        data: {
            username: $(this).val()
        },
        timeout: 1000,
        dataType: 'json',
        success: function (data) {
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
