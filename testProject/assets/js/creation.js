$(function () {
    var selectedMode = 0;
    var scriptingLanguages = [{
            mode: 'php',
            aceMode: 'php',
            value: '<?php\n' +
                    'do{\n\t' +
                    '$f = stream_get_line(STDIN, 10000, PHP_EOL);\n\t' +
                    'if($f!==false){\n\t\t' +
                    '$input[] = $f;\n\t\t' +
                    'echo $f;\n\t' +
                    '}\n' +
                    '}while($f!==false);\n'
        }, {
            mode: 'cpp',
            aceMode: 'c_cpp',
            value: '#include <iostream>\n' +
                    '#include <limits>\n' +
                    '#include <sstream>\n\n' +
                    'int main() {\n\t' +
                    'std::string line;\n\t' +
                    'while (std::getline(std::cin, line))\n\t' +
                    '{\n\t\t' +
                    'std::cout << line;\n\t' +
                    '}\n' +
                    '}'
        }, {
            mode: 'c',
            aceMode: 'c_cpp',
            value: ''
        }];
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


    $('#action').click(function () {
        var questionText = questionEditor.getValue();
        checkQuestionEditor(questionText);
    });

    function checkQuestionEditor(input) {
        $.ajax({
            type: 'POST',
            url: 'controllers/creationQuestionController.php',
            data: {
                input: input
            },
            success: function (data) {
                if (data == 1) {
                    var inputValue = inputEditor.getValue();
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
            var code = codeEditor.getValue();
            var mode = scriptingLanguages[selectedMode].mode;
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
