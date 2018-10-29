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
    questionEditor.session.setValue(questionValue);
    codeEditor.session.setValue(scriptingModes[0].value);

    //--- allow modes selection ---//
    $.each(scriptingModes, function (id, element) {
        $('#' + element.mode).click(function () {
                scriptingModes[selectedMode].value = codeEditor.session.getValue();
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
            dataType: 'json',
            success: function (data) {
                if (data['success'] && data['message']) {
                    $('#inputExample .content').html('');
                    data['message'] = data['message'].split('|');
                    $.each(data['message'], function (id, element) {
                        $('#inputExample .content').append(element + '<br/>');
                    });
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

    $('#register').click(function () {
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
            dataType: 'json',
            success: function (data) {
                $('.warning').css('visibility', 'hidden');
                $('#message').html('');
                if(data['success'] == -1){
                    let w = $('.warning:eq(0)');
                    w.css('visibility', 'visible');
                    w.attr('data-tooltip', data['message']);
                    w.tooltip();
                } else if(data['success'] == -2){
                    let w = $('.warning:eq(1)');
                    w.css('visibility', 'visible');
                    w.attr('data-tooltip', data['message']);
                    w.tooltip();
                } else if(data['success'] == -3){
                    let w = $('.warning:eq(2)');
                    w.css('visibility', 'visible');
                    w.attr('data-tooltip', data['message']);
                    w.tooltip();
                } else if(data['success'] == -4){
                    $('#questionErrors').html(data['message']);
                    $('#questionErrors').append(data['outputs']);
                } else if(data['success'] == 1){
                    $('#questionSuccess').html(data['message']);
                }
            },
            beforeSend: function () {
                $('#register').css('visibility', 'hidden');
            },
            complete: function () {
                $('#register').css('visibility', 'visible');
            }
        });
    });

});
