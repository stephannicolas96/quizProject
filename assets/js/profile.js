Pizza.init(document.body, {
    donut: false,
    donut_inner_ratio: 0.4, // between 0 and 1
    percent_offset: 30, // relative to radius
    /*stroke_color: '#333',*/
    stroke_width: 0,
    show_percent: false, // show or hide the percentage on the chart.
    animation_speed: 500,
    animation_type: 'elastic' // options: backin, backout, bounce, easein, 
});

//------------------------------------ IMAGE ------------------------------------//
var imageForm = $('#uploadImage'),
        imageErrors = $('.errors', imageForm);

$('#userImage').on('change', function () {
    $('#uploadImage').submit();
});

$('#uploadImage').on('submit', function (e) {
    e.preventDefault();
    let submitType = 0;
    if (e.originalEvent != null) { //erase image button
        submitType = 1;
        if ($('#userImageDisplayed').attr('src') == '../assets/images/userImages/user-image.png') {
            return;
        }
    }
    let formData = new FormData(this);
    formData.append('submitType', submitType);
    $.ajax({
        type: 'POST',
        url: '../ajax/image.php',
        data: formData,
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (data)   // A function to be called if request succeeds
        {
            imageErrors.html('');
            imageErrors.hide();
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
                    $('#userImage').val('');
                }
            } else { // FAILURE
                imageErrors.show();
                $.each(data['errors'], function (id, error)
                {
                    imageErrors.append('<p>' + error + '</p>');
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

$('#profileForm').on('submit', function (e) {
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
            type: 'POST',
            url: '../ajax/profile.php',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            dataType: 'json',
            success: function (data)   // A function to be called if request succeeds
            {
                profileLoader.hide();
                profileErrors.html('');
                profileErrors.hide();
                profileSuccess.hide();
                profilePassword.val('');
                profileNewPassword.val('');
                if (data['success']) { // SUCCESS
                    if (submitType == 1)
                    {
                        window.location.href = 'logout';
                    } else {
                        profileSuccess.show();
                    }
                } else { // FAILURE
                    profileErrors.show();
                    $.each(data['errors'], function (id, error)
                    {
                        profileErrors.append('<p>' + error + '</p>');
                    });
                }
                profileDeleteUser.show();
                profileUpdate.show();
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