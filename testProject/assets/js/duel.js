var myCodeMirror = CodeMirror(document.getElementById('editor'), {
    value: /*'do{\n\t' +
     '$f = stream_get_line(STDIN, 10000, PHP_EOL);\n\t' +
     'if($f!==false){\n\t\t' +
     '$input[] = $f;\n\t\t' +
     'echo $f;\n\t' +
     '}\n' +
     '}while($f!==false);\n',*/
            '#include <iostream>\n' +
            '#include <limits>\n' +
            '#include <sstream>\n\n' +
            'int main() {\n\t' +
            'std::string line;\n\t' +
            'while (std::getline(std::cin, line))\n\t' +
            '{\n\t\t' +
            'std::cout << line;\n\t' +
            '}\n' +
            '}',
    mode: 'cpp'
});

$(function () {
    $('#action').click(function () {

        var editorCode = myCodeMirror.getValue();
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
});


//compiler gcc c compiler g++ c++ compiler