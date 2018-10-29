$(function () {
    var mode = $('#duelLangageImg').attr('data-langageId') - 1;
    var editor = ace.edit('duelEditor');
    editor.setTheme('ace/theme/monokai');
    editor.session.setMode('ace/mode/' + scriptingModes[mode].aceMode);
    editor.session.setValue(scriptingModes[mode].value);
    
    $('#duelSubmit').click(function () {
        let editorCode = editor.getValue();
        let editorMode = editor.getOption('mode');
        editorMode = editorMode.substr(editorMode.lastIndexOf('/') + 1);
        $.ajax({
            type: 'POST',
            url: '../ajax/battle.php',
            data: {
                langage: scriptingModes[mode].mode,
                code: editorCode
            },
            timeout: 3000,
            dataType: 'json',
            success: function (data) {
                console.log(data);
            }
        });
    });
});