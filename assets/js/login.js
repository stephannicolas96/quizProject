$(function () {
    var loginForm = $('#loginForm'),
            loginSubmit = $('#loginSubmit'),
            loginModal = $('#loginModal'),
            loginLoader = $('.loader', loginForm),
            loginSuccess = $('.success', loginForm),
            loginErrors = $('.errors', loginForm),
            loginContent = $('.content', loginForm),
            login = $('#login'),
            password = $('#loginPassword'),
            notLoggedNavbar = $('li.notLogged'),
            loggedNavbar = $('li.logged');
            
    loginSuccess.hide();
    loginLoader.hide();
    loginErrors.hide();

    function success(data) {
        loginErrors.html('');
        loginErrors.hide();
        loginSuccess.hide();
        if (data == 1) { // LOGIN SUCCESS
            notLoggedNavbar.hide();
            loggedNavbar.show();
            loginSuccess.show();
            login.val('');
            password.val('');
            setTimeout(function () {
                loginModal.modal('close');
                setTimeout(function () {
                    loginSuccess.hide();
                }, 1000);
            }, 1500);
        } else { // LOGIN FAILURE
            loginErrors.show();
            let errors = data.split('|');
            $.each(errors, function (id, error)
            {
                loginErrors.append('<p>' + error + '</p>');
            });
        }
    }

    function error() {
        console.log('error');
    }

    function beforeSend() {
        loginContent.hide();
        loginLoader.show();
    }

    function complete() {
        loginContent.show();
        loginLoader.hide();
    }

    loginSubmit.click(function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/login.php',
            data: {
                login: login.val(),
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