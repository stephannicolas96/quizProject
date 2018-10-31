//Manage the footer to make it fixed at the bottom when the content don't fill the entire page
if (($('body').height() - 48) < $(window).height()) {
    $('footer').addClass('fixed');
}

//Langage Dropdown
function openDropdown(div) {
    $(div).addClass('active');
}
window.onload = function () {
    let langageDropdown = document.getElementById('langageDropdown');
    document.onclick = function (e) {
        if (e.target.id != 'langageDropdown' && langageDropdown.classList.contains('active') && !e.target.classList.contains('btn-clear')) {
            langageDropdown.classList.remove('active');
        }
    };
};

$(function () {

    var registrationForm = $('#registrationForm'), //REGISTRATION FORM VARS BEGIN
            registrationSubmit = $('#registrationSubmit'),
            registrationModal = $('#registrationModal'),
            registrationLoader = $('.loader', registrationForm),
            registrationSuccess = $('.success', registrationForm),
            registrationErrors = $('.errors', registrationForm),
            registrationContent = $('.content', registrationForm),
            registrationPassword = $('#registrationPassword'), //REGISTRATION FORM VARS END
            loginForm = $('#loginForm'), //LOGIN FORM VARS BEGIN
            loginSubmit = $('#loginSubmit'),
            loginModal = $('#loginModal'),
            loginLoader = $('.loader', loginForm),
            loginSuccess = $('.success', loginForm),
            loginErrors = $('.errors', loginForm),
            loginContent = $('.content', loginForm),
            loginPassword = $('#loginPassword'), //LOGIN FORM VARS END
            duelSelectionForm = $('#duelSelectionForm'), //DUEL SELECTION FORM VARS BEGIN
            duelSelectionLoader = $('.loader', duelSelectionForm),
            duelSelectionSuccess = $('.success', duelSelectionForm),
            duelSelectionErrors = $('.editorError', duelSelectionForm),
            duelSelectionContent = $('.content', duelSelectionForm),
            opponentUsername = $('#opponentUsername');//DUEL SELECTION FORM VARS END

    tarteaucitron.init({
        "privacyUrl": "", /* Privacy policy url */

        "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
        "cookieName": "tartaucitron", /* Cookie name */

        "orientation": "top", /* Banner position (top - bottom) */
        "showAlertSmall": false, /* Show the small banner on bottom right */
        "cookieslist": true, /* Show the cookie list */

        "adblocker": false, /* Show a Warning if an adblocker is detected */
        "AcceptAllCta": true, /* Show the accept all button when highPrivacy on */
        "highPrivacy": false, /* Disable auto consent */
        "handleBrowserDNTRequest": false, /* If Do Not Track == 1, accept all */

        "removeCredit": false, /* Remove credit link */
        "moreInfoLink": true, /* Show more info link */

        //"cookieDomain": ".my-multisite-domaine.fr" /* Shared cookie for subdomain */
    });
    (tarteaucitron.job = tarteaucitron.job || []).push('recaptcha');


    //Add a simple hide and show button to all password inputs
    $('input[type=password]').each(function () {
        let input = $(this);
        let button = $('<button class="btn-password fas fa-eye" type="button"></button>');
        input.parent().append(button);
        button.click(function () {
            if (button.hasClass('fa-eye')) {
                input.attr('type', 'text');
                button.addClass('fa-eye-slash');
                button.removeClass('fa-eye');
            } else {
                input.attr('type', 'password');
                button.addClass('fa-eye');
                button.removeClass('fa-eye-slash');
            }
        });
    });

    //Add a progress bar to password input with a strength attribute
    $('input[type=password][strength]').each(function () {
        let input = $(this);
        input.parent().append('<div class="passwordStrength"><div class="passwordStrengthForeground" strength="' + input.attr('strength') + '"></div></div>');
        input.removeAttr('strength');
    });

    //Initialize all materialize stuff needed
    $('.modal').modal();
    $('.button-collapse').sideNav();
    $('.tooltipped').tooltip({html: true});

    //Change the strength of the password based on the current entered password
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

    //Allow a display of a list of usernames when something is writing in the input
    opponentUsername.on('input', function () {
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

    //------------------------------------ REGISTRATION FORM ------------------------------------//
    registrationForm.on('submit', function (e) {
        e.preventDefault(); //Prevent the page from reloading
        $.ajax({
            type: 'POST',
            url: '../ajax/registration.php',
            data: new FormData(this),
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            dataType: 'json',
            success: function (data) {
                registrationLoader.hide();
                if (data['success']) { // REGISTRATION SUCCESS (show a success message and then close the registration modal)
                    registrationSuccess.show();
                    setTimeout(function () {
                        registrationModal.modal('close');
                        location.reload();
                    }, 500);
                } else { // REGISTRATION FAILURE (show all the error messages)
                    registrationPassword.val('');
                    registrationErrors.show();
                    $.each(data['errors'], function (id, error)
                    {
                        registrationErrors.append('<p>' + error + '</p>');
                    });
                    registrationContent.show();
                    registrationSubmit.parent().show();
                }
            },
            beforeSend: function () { //BEFORE AJAX CALL (hide the form and display a loading screen)
                registrationSubmit.parent().hide();
                registrationErrors.hide();
                registrationErrors.html('');
                registrationSuccess.hide();
                registrationContent.hide();
                registrationLoader.show();
            }
        });
    });

    //------------------------------------ LOGIN FORM ------------------------------------//
    loginForm.on('submit', function (e) {
        e.preventDefault(); //Prevent the page from reloading
        $.ajax({
            type: 'POST',
            url: '../ajax/login.php',
            data: new FormData(this),
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            dataType: 'json',
            success: function (data) {
                loginLoader.hide();
                loginErrors.html('');
                loginErrors.hide();
                loginSuccess.hide();
                if (data['success']) { // LOGIN SUCCESS (show a success message and then close the registration modal and reload the page)
                    loginSuccess.show();
                    setTimeout(function () {
                        loginModal.modal('close');
                        window.location.href = 'home.html';
                    }, 500);
                } else { // LOGIN FAILURE (show all the error messages)
                    loginPassword.val('');
                    loginErrors.show();
                    $.each(data['errors'], function (id, error)
                    {
                        loginErrors.append('<p>' + error + '</p>');
                    });
                    loginContent.show();
                    loginSubmit.parent().show();
                }
            },
            beforeSend: function () { //BEFORE AJAX CALL (hide the form and display a loading screen)
                loginSubmit.parent().hide();
                loginErrors.hide();
                loginContent.hide();
                loginLoader.show();
            }
        });
    });

    //------------------------------------ LOGIN FORM ------------------------------------//
    duelSelectionForm.on('submit', function (e) {
        e.preventDefault(); //Prevent the page from reloading
        let submitType = 0;
        if (e.originalEvent.explicitOriginalTarget.name == 'randomOpponent') {
            submitType = 1;
        } else if (e.originalEvent.explicitOriginalTarget.name == 'chosenOpponent') {
            submitType = 2;
        }
        let formData = new FormData(this);
        formData.append('submitType', submitType);
        $.ajax({
            type: 'POST',
            url: '../ajax/modalDuelSelection.php',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            dataType: 'json',
            success: function (data)   // A function to be called if request succeeds
            {
                duelSelectionLoader.hide();
                if (data['success']) {
                    duelSelectionSuccess.show();
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                } else {
                    duelSelectionContent.show();
                    $.each(data['errors'], function (id, error)
                    {
                        duelSelectionErrors.append('<p>' + error + '</p>');
                    });
                    duelSelectionErrors.show();
                }
            },
            beforeSend: function () //BEFORE AJAX CALL (hide the form and display a loading screen)
            {
                duelSelectionErrors.hide();
                duelSelectionErrors.html('');
                duelSelectionSuccess.hide();
                duelSelectionContent.hide();
                duelSelectionLoader.show();
            }
        });
    });

});