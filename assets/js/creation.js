$(function () {
    var selectedMode = 0,
            questionEditor = ace.edit('questionEditor'),
            inputEditor = ace.edit('inputEditor'),
            codeEditor = ace.edit('codeEditor');

    questionEditor.setTheme('ace/theme/monokai');
    inputEditor.setTheme('ace/theme/monokai');
    inputEditor.session.setMode('ace/mode/text');
    codeEditor.setTheme('ace/theme/monokai');
    codeEditor.session.setMode('ace/mode/' + scriptingModes[0].aceMode);
    codeEditor.session.setValue(scriptingModes[0].value);

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

    $('#action').click(function () {
        let questionText = questionEditor.getValue();
        checkQuestionEditor(questionText);
    });

    //--- generate one input example ---//
    inputEditor.on('change', function () {
        ajaxCreationInput(
                inputEditor.getValue(),
                1,
                function (data) {
                    $('#inputExample .content').html('');
                    data = data.slice(0, -1);
                    data = data.split('|');
                    $.each(data, function (id, element) {
                        $('#inputExample .content').append(element + '<br/>');
                    });
                },
                function () {
                    console.log('error'); // TODO ADD A REAL ERROR...
                }
        )
    });


    function ajaxCreationInput(input, numberOfInput, successCallback, errorCallback) {
        $.ajax({
            type: 'POST',
            url: '../ajax/creationInput.php',
            data: {
                input: input,
                numberOfInput: numberOfInput
            },
            success: function (data) {
                if (successCallback) {
                    successCallback(data);
                }
            },
            error: function () {
                if (errorCallback) {
                    errorCallback();
                }
            },
            beforeSend: function(){
               console.log('whoaa'); 
            },
            complete: function(){
               console.log('whoaaaaaaaaaaaa'); 
            }
        });
    }

    function checkQuestionEditor(input) {
        $.ajax({
            type: 'POST',
            url: '../ajax/creationQuestion.php',
            data: {
                input: input
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
            url: '../ajax/creationInput.php',
            data: {
                input: input,
                numberOfInput: 20
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
            let mode = scriptingModes[selectedMode].mode;
            checkCodeEditor(code, inputs, mode);
        } else {
            console.log('error'); // TODO ADD A REAL ERROR...
        }
    }

    function checkCodeEditor(code, inputs, mode) {
        $.ajax({
            type: 'POST',
            url: '../ajax/creationCode.php',
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
