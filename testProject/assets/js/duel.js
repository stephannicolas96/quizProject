$(function () {
    var scriptingLanguages = [{
            mode: 'php',
            aceMode: 'php',
            value: '<?php\n' +
                    'do{\n\t' +
                    '$f = stream_get_line(STDIN, 10000, PHP_EOL);\n\t' +
                    'if($f!==false){\n\t\t' +
                    '$input[] = $f;\n\t\t' +
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

    var editor = ace.edit('editor');
    editor.setTheme('ace/theme/monokai');
    editor.session.setMode('ace/mode/' + scriptingLanguages[0].aceMode);
    editor.session.setValue(scriptingLanguages[0].value);
    
    $('#action').click(function () {
        var editorCode = editor.getValue();
        var editorMode = editor.getOption('mode');
        editorMode = editorMode.substr(editorMode.lastIndexOf('/') + 1);
        $.ajax({
            type: 'POST',
            url: 'controllers/compiler.php',
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