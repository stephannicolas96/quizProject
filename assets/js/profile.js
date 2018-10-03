$('#userImage').on('change', function () {
    /*$.ajax({
     type: 'POST',
     url: '../ajax/profile.php',
     data: {
     image: $(this).val()
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
     });*/
    $("#uploadImage").submit();
    var file = this.files[0];
    var imagefile = file.type;
    var match = 'image/png';
    if (imagefile == match)
    {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
    }
});

$("#uploadImage").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../ajax/profile.php",
        data: new FormData(this),
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {
            data = $.parseJSON(data);
            if (data['success']) {
            }
        }
    });
});

function imageIsLoaded(e) {
    $('label[for="userImage"]>img').attr('src', e.target.result);
}