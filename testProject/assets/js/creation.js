$(function () {
    var selectedMode = 0;

    var questionEditor = ace.edit('questionEditor');
    questionEditor.setTheme('ace/theme/monokai');
    var inputEditor = ace.edit('inputEditor');
    inputEditor.setTheme('ace/theme/monokai');
    inputEditor.session.setMode('ace/mode/text');
    var codeEditor = ace.edit('codeEditor');
    codeEditor.setTheme('ace/theme/monokai');
    codeEditor.session.setMode('ace/mode/' + scriptingLanguages[0].aceMode);
    codeEditor.session.setValue(scriptingLanguages[0].value);
    $.each(scriptingLanguages, function (id, element) {
        $('#' + element.mode).click(function () {
            codeEditor.session.setMode('ace/mode/' + element.aceMode);
            selectedMode = id;
            codeEditor.session.setValue(element.value);
        });
    });

    addCommandToEditor(questionEditor);
    addCommandToEditor(inputEditor);
    addCommandToEditor(codeEditor);

    $('#action').click(function () {
        let questionText = questionEditor.getValue();
        checkQuestionEditor(questionText);
    });

    inputEditor.on('change', function () {
        let input = inputEditor.getValue();
        $.ajax({
            type: 'POST',
            url: 'controllers/creationInputController.php',
            data: {
                input: input,
                numberOfInput: 1
            },
            success: function (data) {
                $('#inputExample .content').html('');
                data = data.slice(0, -1);
                data = data.split('|');
                $.each(data, function (id, element) {
                    $('#inputExample .content').append(element + '<br/>');
                });
            },
            error: function () {
                console.log('error'); // TODO ADD A REAL ERROR...
            }
        });
    });

    function checkQuestionEditor(input) {
        $.ajax({
            type: 'POST',
            url: 'controllers/creationQuestionController.php',
            data: {
                input: input,
                numberOfInput: 20
            },
            success: function (data) {
                if (data == 1) {
                    let inputValue = inputEditor.getValue();
                    checkInputEditor(inputValue, normalInputCheck);
                } else {
                    console.log('error'); // TODO ADD A REAL ERROR...
                }
            },
            error: function () {
                console.log('error'); // TODO ADD A REAL ERROR...
            }
        });
    }

    function checkInputEditor(input, callback) {
        $.ajax({
            type: 'POST',
            url: 'controllers/creationInputController.php',
            data: {
                input: input
            },
            success: function (data) {
                if (callback) {
                    callback(data);
                }
            },
            error: function () {
                console.log('error'); // TODO ADD A REAL ERROR...
            }
        });
    }

    function normalInputCheck(data) {
        var inputs = data.split('/');
        inputs.pop();
        if (!inputs.includes('error')) {
            let code = codeEditor.getValue();
            let mode = scriptingLanguages[selectedMode].mode;
            checkCodeEditor(code, inputs, mode);
        } else {
            console.log('error'); // TODO ADD A REAL ERROR...
        }
    }

    function checkCodeEditor(code, inputs, mode) {
        $.ajax({
            type: 'POST',
            url: 'controllers/creationCodeController.php',
            data: {
                mode: mode,
                code: code,
                inputs: inputs
            },
            success: function (data) {
                if (data) {
                    console.log(data);
                } else {
                    console.log('error'); // TODO ADD A REAL ERROR...
                }
            },
            error: function () {
                console.log('error'); // TODO ADD A REAL ERROR...
            }
        });
    }
});
