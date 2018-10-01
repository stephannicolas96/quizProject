$(function () {
    $('#registrationForm .loader').hide(); //MODAL INITIALISATION 
    $('#registrationForm .success').hide();
    $('#registrationForm .errors').hide();
    $('#registrationSubmit').click(function () {
        $('#registrationForm .content').hide();
        $.ajax({
            type: 'POST',
            url: '../ajax/registration.php',
            data: {
                username: $('#username').val(),
                email: $('#email').val(),
                password: $('#registrationPassword').val()
            },
            success: function (data) {
                $('#registrationForm .errors div').html('');
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
                    let errors = data.split('|');
                    $.each(errors, function (id, error)
                    {
                        $('#registrationForm .errors div').append('<p>' + error + '</p>');
                    });
                    $('#registrationForm .errors').show();
                    $('#registrationForm .content').show();
                }
            },
            error: function () {
                console.log('error');
            },
            beforeSend: function(){
               $('#registrationForm .loader').show();
            },
            complete: function(){            
                $('#registrationForm .loader').hide();
            }
        });
    });
});