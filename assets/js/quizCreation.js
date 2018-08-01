$(function () {

    var editor = ace.edit('editor');

    var currentEditorTheme = $('#editorTheme').val();

    var EditSession = require('ace/edit_session').EditSession;
    var editorSessions = [];
    var langageData = {
        html: {
            name: 'HTML',
            aceName: 'html',
            code: '<!DOCTYPE html>\n<html>\n\t<head>\n\t\t<title>Page Title</title>\n\t</head>\n\t<body>\n\n\t</body>\n</html>'
        },
        css: {
            name: 'CSS',
            aceName: 'css',
            code: 'body {\n\n}'
        },
        javascript: {
            name: 'JS',
            aceName: 'javascript',
            code: ''
        },
        jquery: {
            name: 'JS',
            aceName: 'javascript',
            code: '$(function() {\n\n});'
        },
        cpp: {
            name: 'C++',
            aceName: 'c_cpp',
            code: '#include <iostream>\nusing namespace std;\n\nint main() {\n\treturn 0;\n}'
        },
        c: {
            name: 'C',
            aceName: 'c_cpp',
            code: '#include <stdio.h>\n\nint main() {\n\treturn 0;\n}'
        },
        csharp: {
            name: 'C#',
            aceName: 'csharp',
            code: 'using System;\nusing System.Collections.Generic;\nusing System.Linq;\nusing System.Text;\nusing System.Threading.Tasks;\n\n\nnamespace AnacondaGames\n{\n\tclass Program\n\t{\n\t\tstatic void Main(string[] args)\n\t\t{\n\n\n\t\t}\n\t}\n}'
        },
        php: {
            name: 'PHP',
            aceName: 'php',
            code: '<?php\n\n?>'
        },
        python: {
            name: 'Pyton 3',
            aceName: 'python',
            code: ''
        },
        java: {
            name: 'Java',
            aceName: 'java',
            code: 'public class Program\n{\n\tpublic static void main(String[] args) {\n\n\t}\n}'
        }
    };

    var previousTab = null;

//----------------------------EDITOR FONT SIZE MANAGEMENT----------------------------//

    function changeFontSize(fontSize) {
        $('#editor').css('font-size', fontSize + 'px');
    }

    function fontSizeIncDec(value) {
        var newValue = parseInt($('#editor').css('font-size')) + value;
        if (newValue > 100 || newValue < 10) {
            return;
        }
        $('#editor').css('font-size', newValue);
        $('#editorFontSize').val(newValue);
    }

    //Setup Default Value
    for (var i = 10; i <= 100; i++) {
        var selected = (i == 20) ? 'selected' : '';
        $('#editorFontSize').append('<option value="' + i + '" ' + selected + '>' + i + '</option>');
    }

    changeFontSize($('#editorFontSize').val());

    $('#editorFontSize').change(function () {
        changeFontSize(this.value);
    });

//----------------------------EDITOR THEME MANAGEMENT----------------------------//
    function changeTheme(nextTheme, editorWindow, previousTheme = null) {
        editorWindow.setTheme('ace/theme/' + nextTheme);
        $('#themeCss').attr('href', 'assets/css/index-' + nextTheme + '.css');
    }

    //Setup Default Value
    changeTheme(currentEditorTheme, editor);

    //Setup Value On Select Change
    $('#editorTheme').change(function () {
        changeTheme(this.value, editor, currentEditorTheme);
        currentEditorTheme = this.value;
    });


//----------------------------EDITOR LANGAGE MANAGEMENT----------------------------//
    function createSession(langage, langagesData) {
        editorSessions.push(new EditSession(langagesData[langage].code));
        editorSessions[editorSessions.length - 1].setMode('ace/mode/' + langagesData[langage].aceName);
    }

    function createSessions(langagesArray, langagesData) {
        editorSessions = [];
        for (var i = 0; i < langagesArray.length; i++) {
            createSession(langagesArray[i], langagesData);
        }
    }

    function createTabElement(langage, index = null) {
        var id = (index != null) ? 'id="langage' + index + '"' : 'id="run"';
        var href = (index != null) ? '#editor' : '#output';
        $('#editorTabs').append('<li class="nav-item">'
                + '<a class="nav-link theme-color theme-bg-color" data-toggle="tab" href="' + href + '"' + id + '>' + langage + '</a>'
                + '</li>');
    }

    function createEditor(langagesArray, editorWindow, langagesData) {
        $('#editorTabs').empty();
        for (var i = 0; i < langagesArray.length; i++) {
            createTabElement(langagesData[langagesArray[i]].name, i);
            $('#langage' + i).click(function () {
                var id = $(this).attr('id').split('langage')[1];
                editor.setSession(editorSessions[id]);
                if ($(previousTab).hasClass('theme-bg-color-active')) {
                    $(previousTab).removeClass('theme-bg-color-active');
                }
                if ($(previousTab).hasClass('theme-color-active')) {
                    $(previousTab).removeClass('theme-color-active');
                }
                $(this).addClass('theme-bg-color-active');
                $(this).addClass('theme-color-active');
                previousTab = $(this);
            });
        }
        createTabElement('Output');
        $('#run').click(function () {
            if ($(previousTab).hasClass('theme-bg-color-active')) {
                $(previousTab).removeClass('theme-bg-color-active');
            }
            if ($(previousTab).hasClass('theme-color-active')) {
                $(previousTab).removeClass('theme-color-active');
            }
            $(this).addClass('theme-bg-color-active');
            $(this).addClass('theme-color-active');
            previousTab = $(this);

            var currentLangage = $('#editorLangage').val();
            var outputCode;
            switch (currentLangage) {
                case 'html/css/javascript':
                    var output = [];
                    for (var i = 0; i < editorSessions.length; i++) {
                        editor.setSession(editorSessions[i]);
                        output.push(editor.getValue());
                    }
                    editor.setSession(editorSessions[0]);
                    outputCode = addCssAndJsToHtml(output[0], output[1], output[2]);
                    break;
                default:

                    break;
            }
            $('#outputFrame').src = '/test';
            if (editor.session.getValue() == '') {
                alert('cannot compile empty source');
            } else {
                $.ajax({
                    url:'/test',
                    data: {
                        sourceCode: outputCode,
                        language: 'html',
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(){
                        console.log('okk');
                    }
                })
            }
        });
        createSessions(langagesArray, langagesData);
        editorWindow.setSession(editorSessions[0]);
        $('.nav-tabs li:eq(0) a').tab('show');
        $('.nav-tabs li:eq(0) a').addClass('theme-bg-color-active');
        $('.nav-tabs li:eq(0) a').addClass('theme-color-active');
        previousTab = $('.nav-tabs li:eq(0) a');
    }

    createEditor($('#editorLangage').val().split('/'), editor, langageData);

    //Setup Value On Select Change
    $('#editorLangage').change(function () {
        createEditor(this.value.split('/'), editor, langageData);
    });

//----------------------------EDITOR KEY BINDING MANAGEMENT----------------------------//

    editor.commands.addCommand({
        name: 'FontSize++',
        bindKey: {win: 'Ctrl-+', mac: 'Command-+', lin: 'Ctrl-+'},
        exec: function (editor) {
            fontSizeIncDec(1)
        },
        readOnly: true // false if this command should not apply in readOnly mode
    });
    editor.commands.addCommand({
        name: 'FontSize--',
        bindKey: {win: 'Ctrl--', mac: 'Command--', lin: 'Ctrl--'},
        exec: function (editor) {
            fontSizeIncDec(-1)
        },
        readOnly: true // false if this command should not apply in readOnly mode
    });

    //----------------------------TEST----------------------------//    

    function addCssAndJsToHtml(html = null, css = null, js = null) {
        var cssBalised =  '\t<style>' + css + '</style>\n\t\t';
        var jsBalised = '<script>' + js + '</script>\n\t';
        var headIndex = html.indexOf("</head>");
        return html.slice(0, headIndex) + cssBalised + jsBalised + html.slice(headIndex);
    }
});

