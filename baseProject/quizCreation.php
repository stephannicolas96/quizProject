<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/create.css">
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
            <option value="php">PHP</option>
            <option value="c">C</option>
            <option value="csharp">C#</option>
            <option value="cpp">C++</option>   
            <option value="java">Java</option>
            <option value="python">Python 3</option>   
        </select>
        <!-- Font Size Selection -->
        <select id="editorFontSize" class="custom-select">
            <?php for($fontSize = 10; $fontSize<= 100; $fontSize++){ ?>
            <option value="<?= $fontSize ?>" <?= ($fontSize == 20) ? 'selected' : '' ?>><?= $fontSize ?> px</option>
            <?php } ?>
        </select>
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
        <script src="assets/js/import/jquery.min.js"></script>
        <script src="assets/js/import/bootstrap.min.js"></script>
        <script src="assets/js/import/ace/ace.js"></script>
        <script src="assets/js/quizCreation.js"></script>
    </body>
</html>