var myCodeMirror = CodeMirror(document.getElementById('editor'), {
    value: 'do{\n\t' +
            '$f = stream_get_line(STDIN, 10000, PHP_EOL);\n\t' +
            'if($f!==false){\n\t\t' +
            '$input[] = $f;\n\t\t' +
            'var_dump($f);\n\t' +
            '}\n' +
            '}while($f!==false);\n',
    mode: 'php'
});

$(function () {
    $('#action').click(function () {

        var editorCode = myCodeMirror.getValue();
        $.ajax({
            type: 'POST',
            url: 'assets/controllers/compiler.php',
            data: {code: editorCode},
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
