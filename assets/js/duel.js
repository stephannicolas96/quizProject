$(function () {
    var editor = ace.edit('editor');
    editor.setTheme('ace/theme/monokai');
    editor.session.setMode('ace/mode/' + scriptingLanguages[0].aceMode);
    editor.session.setValue(scriptingLanguages[0].value);
    
    $('#action').click(function () {
        let editorCode = editor.getValue();
        let editorMode = editor.getOption('mode');
        editorMode = editorMode.substr(editorMode.lastIndexOf('/') + 1);
        $.ajax({
            type: 'POST',
            url: '../ajax/compiler.php',
            data: {
                mode: editorMode,
                code: editorCode
            },
            timeout: 3000,
            success: function (data) {
                $('#error').html(data);
            },
            error: function () {
                console.log('error');
            }
        });
    });
    $.each(scriptingLanguages, function (id, element) {
        $('#' + element.mode).click(function () {
            editor.session.setMode('ace/mode/' + element.aceMode);
            editor.session.setValue(element.value);
        });
    });
});
//compiler gcc c compiler g++ c++ compiler