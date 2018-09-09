$('input[type=email]').change(function (event) {
    var target = $(event.target);
    $.ajax({
        type: 'POST',
        url: 'assets/controllers/emailChecker.php',
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

$('#registrationForm input[type=password]').change(function () {
    $.ajax({
        type: 'POST',
        url: 'assets/controllers/passwordChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        success: function (data) {
            console.log(data);
        },
        error: function () {

        }
    });
});