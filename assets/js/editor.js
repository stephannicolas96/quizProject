const scriptingModes = [{
        mode: 'php',
        aceMode: 'php',
        value: '<?php\n' +
                'do{\n\t' +
                '$f = stream_get_line(STDIN, 10000, PHP_EOL);\n\t' +
                'if($f!==false){\n\t\t' +
                '$input[] = $f;\n\t\t' +
                'echo $f . PHP_EOL;\n\t' +
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
                'std::cout << line << std::endl;\n\t' +
                '}\n' +
                '}'
    }, {
        mode: 'c',
        aceMode: 'c_cpp',
        value: '#include <stdlib.h>\n' +
                '#include <stdio.h>\n\n' +
                'int main() {\n\t' +
                'char s[1024];\n\t' +
                'while (fgets(s, sizeof(s), stdin)) {\n\t\t' +
                'printf("%s", s);\n\t' +
                '}\n\t' +
                'return 0;\n' +
                '}'
    }, {
        mode: 'csharp',
        aceMode: 'csharp',
        value: 'using System;\n' +
                'using System.Collections.Generic;\n' +
                'using System.Linq;\n' +
                'using System.Text;\n\n' +
                'static void Main(string[] args)\n' +
                '{\n\t' +
                'string line;\n\t' +
                'while ((line = Console.ReadLine()) != null) {\n\n\t' +
                '}\n' +
                '}'
    }];

const questionValue = 'Enunciated\n\n\n' +
        'Input\n\n\n' +
        'Output\n\n';

function addCommandToEditor(editor) {
    editor.commands.addCommand({
        name: 'FontSize++',
        bindKey: {win: 'Ctrl-+', mac: 'Command-+', lin: 'Ctrl-+'},
        exec: function (editor) {
            fontSizeIncDec(editor, 1);
        },
        readOnly: true
    });
    editor.commands.addCommand({
        name: 'FontSize--',
        bindKey: {win: 'Ctrl--', mac: 'Command--', lin: 'Ctrl--'},
        exec: function (editor) {
            fontSizeIncDec(editor, -1);
        },
        readOnly: true
    });
}

function fontSizeIncDec(editor, value) {
    var newValue = editor.getOption('fontSize') + value;
    if (newValue > 100 || newValue < 10) {
        return;
    }
    editor.setOptions({fontSize: newValue});
}