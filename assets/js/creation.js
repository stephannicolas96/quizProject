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
    var inputExample = $('#inputExample'),
            intputExampleLoader = $('.loader', inputExample),
            intputExampleContent = $('.content', inputExample);

    var inputExampleTimeout = null;
    inputEditor.on('change', function () {
        clearTimeout(inputExampleTimeout);
        inputExampleTimeout = setTimeout(function () {
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
                        intputExampleContent.html('');
                        data['message'] = data['message'].split('|');
                        $.each(data['message'], function (id, element) {
                            intputExampleContent.append(element + '<br/>');
                        });
                    }
                },
                beforeSend: function () {
                    intputExampleContent.hide();
                    intputExampleLoader.show();
                },
                complete: function () {
                    intputExampleContent.show();
                    intputExampleLoader.hide();
                }
            });
        }, 1500);
    });

    //--- set the base value to the input example after the input editor event was set to make the ajax call and compute this example ---//
    inputEditor.session.setValue(
            '#This is a basic example for an input format\n' +
            '1->100*2/A->z*5~1->5'
            );

    //--- register the question in the database ---//
    var registerQuestion = $('#register'),
            questionErrors = $('#questionErrors'),
            questionSuccess = $('#questionSuccess'),
            questionLoader = $('#questionLoader');

    registerQuestion.click(function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/creation.php',
            data: {
                question: questionEditor.getValue(),
                inputFormat: inputEditor.getValue(),
                userCode: codeEditor.getValue(),
                numberOfInputToGenerate: 20,
                langage: scriptingModes[selectedMode].mode
            },
            dataType: 'json',
            success: function (data) {
                if (data['success'] == -1) {
                    $('.warning:eq(0)').css('visibility', 'visible');
                } else if (data['success'] == -2) {
                    $('.warning:eq(1)').css('visibility', 'visible');
                } else if (data['success'] == -3) {
                    $('.warning:eq(2)').css('visibility', 'visible');
                }
                if (data['success'] < 1) {
                    questionErrors.html(data['message'] + '<br/>');
                    if (data['outputs'][0]['executionOutput']) {
                        questionErrors.append(data['outputs'][0]['executionOutput']);
                    }
                    if (data['outputs'][0]['compilationOutput']) {
                        questionErrors.append(data['outputs'][0]['compilationOutput']);
                    }
                    questionErrors.show();
                } else if (data['success'] == 1) {
                    questionSuccess.html(data['message']);
                    questionSuccess.show();
                }
            },
            beforeSend: function () {
                $('.warning').css('visibility', 'hidden');
                registerQuestion.css('visibility', 'hidden');
                questionErrors.hide();
                questionSuccess.hide();
                questionLoader.show();
            },
            complete: function () {
                registerQuestion.css('visibility', 'visible');
                questionLoader.hide();
            }
        });
    });
}
);
