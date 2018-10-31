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
                let editorError = $('.editorError');
                editorError.html('');
                let show = true;
                if (data['executionTime'])
                {
                    editorError.append('<p>' + data['executionTime'] + '</p>')
                }
                $.each(data['output'], function (id, output)
                {
                    if (show) {
                        if (output['executionOutput']) {
                            editorError.append('<p>' + output['executionOutput'] + '</p>');
                        }

                        if (output['compilationOutput']) {
                            editorError.append('<p>' + output['compilationOutput'] + '</p>');
                        }
                    }

                    if (!output['success']) {
                        show = false
                    }
                });
            }
        });
    });
});