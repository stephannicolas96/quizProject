$(function () {
    $('#changePasswordDiv').hide();

    $('#changePassword').click(function () {
        $(this).hide();
        $('#changePasswordDiv').show();
    });

    $('#eraseUserImage').click(function () {

    });

    $('#deleteUser').click(function () {
        if (confirm('voulez-vous réellement supprimer votre compte')){
            var input = $("<input>").attr('type', 'hidden').attr('name', 'deleteUser').val('');
            $('#modifyUser').append($(input));   
            $('#modifyUser').submit();
        }
    })
});
