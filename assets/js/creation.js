$(function () {
    var selectedMode = 0,
            questionEditor = ace.edit('questionEditor'),
            inputEditor = ace.edit('inputEditor'),
            codeEditor = ace.edit('codeEditor');

    //--- set theme---//
    questionEditor.setTheme('ace/theme/monokai');
    inputEditor.setTheme('ace/theme/monokai');
    codeEditor.setTheme('ace/theme/monokai');

    //--- set modes ---//
    inputEditor.session.setMode('ace/mode/text');
    codeEditor.session.setMode('ace/mode/' + scriptingModes[0].aceMode);

    //--- set value ---//
    codeEditor.session.setValue(scriptingModes[0].value);
    questionEditor.setValue(questionValue);

    //--- allow modes selection ---//
    $.each(scriptingModes, function (id, element) {
        $('#' + element.mode).click(function () {
            codeEditor.session.setMode('ace/mode/' + element.aceMode);
            selectedMode = id;
            codeEditor.session.setValue(element.value);
        });
    });
    //--- shortcut ---//
    addCommandToEditor(questionEditor);
    addCommandToEditor(inputEditor);
    addCommandToEditor(codeEditor);

    //--- generate one input example ---//
    inputEditor.on('change', function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/exampleInput.php',
            data: {
                inputFormat: inputEditor.getValue()
            },
            timeout: 3000,
            success: function (data) {
                data = $.parseJSON(data);
                if (data['success'] && data['message']) {
                    $('#inputExample .content').html('');
                    data['message'] = data['message'].slice(0, -1);
                    data['message'] = data['message'].split('|');
                    $.each(data['message'], function (id, element) {
                        $('#inputExample .content').append(element + '<br/>');
                    });
                } else {

                }
            },
            beforeSend: function () {
                $('#inputExample .content').hide();
                $('#inputExample .loader').show();
            },
            complete: function () {
                $('#inputExample .content').show();
                $('#inputExample .loader').hide();
            }
        });
    });

    $('#action').click(function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/creation.php',
            data: {
                question: questionEditor.getValue(),
                inputFormat: inputEditor.getValue(),
                numberOfInputToGenerate: 20,
                userCode: codeEditor.getValue(),
                langage: scriptingModes[selectedMode].mode
            },
            success: function (data) {
                console.log(data);
            },
            beforeSend: function () {
                $('#inputExample .content').hide();
                $('#inputExample .loader').show();
            },
            complete: function () {
                $('#inputExample .content').show();
                $('#inputExample .loader').hide();
            }
        });
    });

});
