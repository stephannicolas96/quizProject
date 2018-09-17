$(function () {
    $('#registrationForm .loader').hide(); //MODAL INITIALISATION 
    $('#registrationForm .success').hide();
    $('#registrationForm .errors').hide();
    $('#registrationSubmit').click(function () {
        $('#registrationForm .container').hide();
        $.ajax({
            type: 'POST',
            url: 'controllers/registrationController.php',
            data: {
                username: $('#username').val(),
                email: $('#email').val(),
                registrationPassword: $('#registrationPassword').val()
            },
            success: function (data) {
                $('#registrationForm .errors').html('');
                $('#registrationForm .success').hide();
                $('#registrationForm .errors').hide();
                if (data == 1) {
                    $('#registrationForm .success').show();
                    setTimeout(function () {
                        $('#registrationModal').modal('close');
                        setTimeout(function () {
                            $('#registrationForm .success').hide();
                            $('#registrationForm .container').show();
                        }, 1000);
                    }, 1500);
                } else {
                    var errors = data.split('|');
                    $.each(errors, function (id, error)
                    {
                        $('#registrationForm .errors').append('<p>' + error + '</p>');
                    });
                    $('#registrationForm .errors').show();
                    $('#registrationForm .container').show();
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    $('#passwordVisibility').click(function () {
        var registrationPasswordInput = $('#registrationPassword');
        if (registrationPasswordInput.is(':password')) {
            registrationPasswordInput.attr('type', 'text');
            $(this).html('<i class="fas fa-eye-slash"></i>');
        } else {
            registrationPasswordInput.attr('type', 'password');
            $(this).html('<i class="fas fa-eye"></i>');
        }
    });

    $(document).ajaxStart(function (e) {
        if (e.target.activeElement.id == 'registrationSubmit') {
            $('#registrationForm .loader').show();
        }
    });

    $(document).ajaxStop(function (e) {
        if (e.target.activeElement.id == 'registrationSubmit') {
            $('#registrationForm .loader').hide();
        }
    });
});