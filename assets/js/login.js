$(function () {
    $('#loginForm .loader').hide(); //MODAL INITIALISATION 
    $('#loginForm .success').hide();
    $('#loginForm .errors').hide();
    $('#loginSubmit').click(function () {
        $('#loginForm .content').hide();
        $.ajax({
            type: 'POST',
            url: '../ajax/loginController.php',
            data: {
                login: $('#login').val(),
                loginPassword: $('#loginPassword').val()
            },
            success: function (data) {
                $('#loginForm .errors div').html('');
                $('#loginForm .success').hide();
                $('#loginForm .errors').hide();
                if (data == 1) {
                    $('li.notLogged').hide();
                    $('li.logged').show();
                    $('#loginForm .success').show();
                    setTimeout(function () {
                        $('#loginModal').modal('close');
                        setTimeout(function () {
                            $('#loginForm .success').hide();
                            $('#loginForm .container').show();
                        }, 1000);
                    }, 1500);
                } else {
                    let errors = data.split('|');
                    $.each(errors, function (id, error)
                    {
                        $('#loginForm .errors div').append('<p>' + error + '</p>');
                    });
                    $('#loginForm .errors').show();
                    $('#loginForm .content').show();
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    $('#loginPasswordVisibility').click(function () {
        let registrationPasswordInput = $('#loginPasswordVisibility');
        if (registrationPasswordInput.is(':password')) {
            registrationPasswordInput.attr('type', 'text');
            $(this).html('<i class="fas fa-eye-slash"></i>');
        } else {
            registrationPasswordInput.attr('type', 'password');
            $(this).html('<i class="fas fa-eye"></i>');
        }
    });

    $(document).ajaxStart(function (e) {
        if (e.target.activeElement.id == 'loginSubmit') {
            $('#loginForm .loader').show();
        }
    });

    $(document).ajaxStop(function (e) {
        if (e.target.activeElement.id == 'loginSubmit') {
            $('#loginForm .loader').hide();
        }
    });
});