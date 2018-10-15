var loginForm = $('#loginForm'),
        loginSubmit = $('#loginSubmit'),
        loginModal = $('#loginModal'),
        loginLoader = $('.loader', loginForm),
        loginSuccess = $('.success', loginForm),
        loginErrors = $('.errors', loginForm),
        loginContent = $('.content', loginForm),
        password = $('#loginPassword');

loginForm.on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../ajax/login.php',
        data: new FormData(this),
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data) {
            data = JSON.parse(data);
            setTimeout(function () {
                loginLoader.hide();
                loginErrors.html('');
                loginErrors.hide();
                loginSuccess.hide();
                if (data['success']) { // LOGIN SUCCESS
                    loginSuccess.show();
                    setTimeout(function () {
                        loginModal.modal('close');
                        window.location.href = 'home.html';
                    }, 500);
                } else { // LOGIN FAILURE
                    password.val('');
                    loginErrors.show();
                    $.each(data['errors'], function (id, error)
                    {
                        loginErrors.append('<p>' + error + '</p>');
                    });
                    loginContent.show();
                    loginSubmit.parent().show();
                }
            }, 1000);
        },
        beforeSend: function () {
            loginSubmit.parent().hide();
            loginErrors.hide();
            loginContent.hide();
            loginLoader.show();
        }
    });
});