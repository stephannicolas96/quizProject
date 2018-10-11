//------------------------------------ IMAGE ------------------------------------//
var imageForm = $('#uploadImage'),
        imageErrors = $('.errors', profileForm);

imageErrors.hide();

$('#userImage').on('change', function () {
    $("#uploadImage").submit();
});

$("#uploadImage").on('submit', function (e) {
    e.preventDefault();
    let submitType = 0;
    if (e.originalEvent != null) { //erase image button
        submitType = 1;
    }
    let formData = new FormData(this);
    formData.append('submitType', submitType);
    $.ajax({
        type: "POST",
        url: "../ajax/image.php",
        data: formData,
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {
            //TODO : ADD AN UPLOADING PROGRESS BAR
            profileErrors.html('');
            profileErrors.hide();
            data = $.parseJSON(data);
            if (data['success']) {
                if (submitType == 0) {
                    var file = $('#userImage')[0].files[0];
                    var imagefile = file.type;
                    var match = 'image/png';
                    if (imagefile == match)
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL($('#userImage')[0].files[0]);
                    }
                } else {
                    $('#userImageDisplayed').attr('src', '../assets/images/userImages/user-image.png');
                }
            } else { // FAILURE
                profileErrors.show();
                $.each(data['errors'], function (id, error)
                {
                    profileErrors.append('<p>' + error + '</p>');
                });
            }
        }
    });
});

function imageIsLoaded(e) {
    $('label[for="userImage"]>img').attr('src', e.target.result);
}

//------------------------------------ PROFILE ------------------------------------//
var profileForm = $('#profileForm'),
        profilePassword = $('#actualPassword', profileForm),
        profileNewPassword = $('#newPassword', profileForm),
        profileErrors = $('.errors', profileForm),
        profileSuccess = $('.success', profileForm),
        profileLoader = $('.loader', profileForm),
        profileUpdate = $('#update', profileForm),
        profileDeleteUser = $('#deleteUser', profileForm);


profileSuccess.hide();
profileLoader.hide();
profileErrors.hide();

$("#profileForm").on('submit', function (e) {
    e.preventDefault();
    let submitType = 0;
    let canSubmit = true;
    if (e.originalEvent.explicitOriginalTarget.name == 'deleteUser') {
        canSubmit = confirm('Do you really want to delete your account ?'); //TODO TRADUCTION
        submitType = 1;
    }
    if (canSubmit) {
        let formData = new FormData(this);
        formData.append('submitType', submitType);
        $.ajax({
            type: "POST",
            url: "../ajax/profile.php",
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                data = JSON.parse(data);
                setTimeout(function () {
                    profileLoader.hide();
                    profileErrors.html('');
                    profileErrors.hide();
                    profileSuccess.hide();
                    if (submitType = 0) {
                        profilePassword.val('');
                        profileNewPassword.val('');
                    }
                    if (data['success']) { // SUCCESS
                        profileSuccess.show();
                    } else { // FAILURE
                        if (submitType = 1) {
                            profilePassword.val('');
                        }
                        profileErrors.show();
                        $.each(data['errors'], function (id, error)
                        {
                            profileErrors.append('<p>' + error + '</p>');
                        });
                    }
                    profileDeleteUser.show();
                    profileUpdate.show();
                });
            },
            beforeSend: function () {
                profileDeleteUser.hide();
                profileUpdate.hide();
                profileErrors.hide();
                profileLoader.show();
            }
        });
    }
});