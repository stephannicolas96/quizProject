$(function () {
    var registrationForm = $('#registrationForm'),
            registrationSubmit = $('#registrationSubmit'),
            registrationModal = $('#registrationModal'),
            registrationLoader = $('.loader', registrationForm),
            registrationSuccess = $('.success', registrationForm),
            registrationErrors = $('.errors', registrationForm),
            registrationContent = $('.content', registrationForm),
            username = $('#username'),
            email = $('#email'),
            password = $('#registrationPassword');

    registrationSuccess.hide();
    registrationLoader.hide();
    registrationErrors.hide();

    function success(data) {
        registrationErrors.html('');
        registrationErrors.hide();
        registrationSuccess.hide();
        if (data == 1) { // REGISTRATION SUCCESS
            registrationSuccess.show();
            username.val('');
            email.val('');
            password.val('');
            setTimeout(function () {
                registrationModal.modal('close');
                setTimeout(function () {
                    registrationSuccess.hide();
                }, 1000);
            }, 1500);
        } else { // REGISTRATION FAILURE
            registrationErrors.show();
            let errors = data.split('|');
            $.each(errors, function (id, error)
            {
                registrationErrors.append('<p>' + error + '</p>');
            });
        }
    }

    function error() {
        console.log('error');
    }

    function beforeSend() {
        registrationContent.hide();
        registrationLoader.show();
    }

    function complete() {
        registrationContent.show();
        registrationLoader.hide();
    }

    registrationSubmit.click(function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/registration.php',
            data: {
                username: username.val(),
                email: email.val(),
                password: password.val()
            },
            success: function (data) {
                success(data);
            },
            error: function () {
                error();
            },
            beforeSend: function () {
                beforeSend();
            },
            complete: function () {
                complete();
            }
        });
    });
});
