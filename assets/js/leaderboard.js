$(function () {
    $.each(scriptingModes, function (id, element) {
        $('#' + element.mode).click(function () {
            window.location = 'leaderboard-' + (id + 1);
        });
    });
});