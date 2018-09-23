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

$('#registrationPassword').change(function () {
    $.ajax({
        type: 'POST',
        url: '../ajax/passwordChecker.php',
        data: {
            inputValue: $(this).val()
        },
        timeout: 1000,
        success: function (data) {
            switch (data) {
                case '5':
                    $('#passwordDifficultyProgressBarForeground').css('background-color', 'green');
                    $('#passwordDifficultyProgressBarForeground').css('width', '100%');
                    break;
                case '4':
                    $('#passwordDifficultyProgressBarForeground').css('background-color', 'green');
                    $('#passwordDifficultyProgressBarForeground').css('width', '80%');
                    break;
                case '3':
                    $('#passwordDifficultyProgressBarForeground').css('background-color', 'orange');
                    $('#passwordDifficultyProgressBarForeground').css('width', '60%');
                    break;
                case '2':
                    $('#passwordDifficultyProgressBarForeground').css('background-color', 'orange');
                    $('#passwordDifficultyProgressBarForeground').css('width', '40%');
                    break;
                case '1':
                    $('#passwordDifficultyProgressBarForeground').css('background-color', 'red');
                    $('#passwordDifficultyProgressBarForeground').css('width', '20%');
                    break;
                case '0':
                    $('#passwordDifficultyProgressBarForeground').css('background-color', 'red');
                    $('#passwordDifficultyProgressBarForeground').css('width', '0');
                    break;
                default:
                    break;
            }
        },
        error: function () {

        }
    });
});