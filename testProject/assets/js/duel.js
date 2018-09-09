var cm = CodeMirror(document.getElementById('editor'), {
    theme: 'monokai',
    lineNumbers: true,
});
$(function () {
    $('#action').click(function () {
        var editorCode = cm.getValue();
        $.ajax({
            type: 'POST',
            url: 'assets/controllers/compiler.php',
            data: {language: 'cpp',
                code: editorCode},
            timeout: 3000,
            success: function (data) {
                $('#error').html(data);
            },
            error: function () {
                $('#error').html(data);
            }
        });
    });
    var scriptingLanguages = [{
            mode: 'php',
            value: 'do{\n\t' +
                    '$f = stream_get_line(STDIN, 10000, PHP_EOL);\n\t' +
                    'if($f!==false){\n\t\t' +
                    '$input[] = $f;\n\t\t' +
                    'echo $f;\n\t' +
                    '}\n' +
                    '}while($f!==false);\n'
        }, {
            mode: 'cpp',
            value: '#include < iostream > \n' +
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
            value: ''
        }];
    $.each(scriptingLanguages, function (element) {
        $('#' + element).click(function () {
            cm.setOption('mode', element.mode);
            cm.setOption('value', element.value);
        });
    });
});
//compiler gcc c compiler g++ c++ compiler