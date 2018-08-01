<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link id="themeCss" rel="stylesheet" href="assets/css/index-monokai.css">
        <script src="assets/js/import/jquery.min.js"></script>
        <script src="assets/js/import/popper.min.js"></script>
        <script src="assets/js/import/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.7.5/beautify-css.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.7.5/beautify.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.7.5/beautify-html.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js"></script>
        <title>QUIZ</title>
    </head>
    <body class="theme-body-color">
        <!-- Theme Selection -->
        <select id="editorTheme" class="custom-select">
            <option value="monokai">Dark</option>
            <option value="crimson_editor">Light</option>
            <option value="cobalt">Blue</option>
        </select>
        <!-- Langage Selection -->
        <select id="editorLangage" class="custom-select">
            <option value="html/css/javascript">HTML/CSS/JS</option>
            <option value="html/css/jquery">JQuery</option>
            <option value="php">PHP</option>
            <option value="c">C</option>
            <option value="csharp">C#</option>
            <option value="cpp">C++</option>   
            <option value="java">Java</option>
            <option value="python">Python 3</option>   
        </select>
        <!-- Font Size Selection -->
        <select id="editorFontSize" class="custom-select"></select>
        <!-- Code Window Selection -->
        <ul class="nav nav-tabs mx-3" id="editorTabs"></ul>
        <!-- Code Editor -->
        <div id="editorContainer" class="tab-content">
            <div id="editor" class="tab-pane active show"></div>
            <div id="output" class="tab-pane mx-3">
                <div id="baseOutput"></div>
                <div id="webOutput">
                    <iframe id="outputFrame" frameborder="0">
                        <html>
                            <head></head>
                            <body></body>
                        </html>
                    </iframe>
                </div>
            </div>
        </div>
        <script src="assets/js/quizCreation.js"></script>
    </body>
</html>