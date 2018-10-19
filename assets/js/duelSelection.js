var duelSelectionForm = $('#duelSelectionForm'),
        duelSelectionLoader = $('.loader', duelSelectionForm),
        duelSelectionSuccess = $('.success', duelSelectionForm),
        duelSelectionErrors = $('.errors', duelSelectionForm),
        duelSelectionContent = $('.content', duelSelectionForm),
        opponentUsername = $('#opponentUsername');

duelSelectionForm.on('submit', function (e) {
    e.preventDefault();
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
            setTimeout(function () {
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
            }, 1000);
        },
        beforeSend: function ()
        {
            duelSelectionErrors.hide();
            duelSelectionErrors.html('');
            duelSelectionSuccess.hide();
            duelSelectionContent.hide();
            duelSelectionLoader.show();
        }
    });
});