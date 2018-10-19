var registrationForm = $('#registrationForm'),
        registrationSubmit = $('#registrationSubmit'),
        registrationModal = $('#registrationModal'),
        registrationLoader = $('.loader', registrationForm),
        registrationSuccess = $('.success', registrationForm),
        registrationErrors = $('.errors', registrationForm),
        registrationContent = $('.content', registrationForm),
        password = $('#registrationPassword');

registrationForm.on('submit', function (e) {
    e.preventDefault();
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
            if (data['success']) { // REGISTRATION SUCCESS
                registrationSuccess.show();
                setTimeout(function () {
                    registrationModal.modal('close');
                    location.reload();
                }, 500);
            } else { // REGISTRATION FAILURE
                password.val('');
                registrationErrors.show();
                $.each(data['errors'], function (id, error)
                {
                    registrationErrors.append('<p>' + error + '</p>');
                });
                registrationContent.show();
                registrationSubmit.parent().show();
            }
        },
        beforeSend: function () {
            registrationSubmit.parent().hide();
            registrationErrors.hide();
            registrationErrors.html('');
            registrationSuccess.hide();
            registrationContent.hide();
            registrationLoader.show();
        }
    });
});
