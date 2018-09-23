<?php
session_start();
include_once 'classes/path.php';
include_once path::getControllersPath() . 'duelController.php';
include_once path::getControllersPath() . 'langageController.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>TODO: FIND A TITLE FOR THIS PAGE</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link rel="stylesheet" href="assets/js/import/codeMirror/lib/codemirror.css" />
        <link rel="stylesheet" href="assets/js/import/codeMirror/theme/monokai.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body>        
        <?php include path::getLayoutPath() . 'navbar.php'; ?>

        <div class="container">
            <div class="row" id="modeSelector">
                <div class="col s4 offset-s4">
                    <div class="col s2 offset-s2">
                        <input id="php" name="mode" type="radio" checked/>
                        <label for="php"><img src="assets/images/php.png" /></label>
                    </div>
                    <div class="col s2">
                        <input id="cpp" name="mode" type="radio" />
                        <label for="cpp"><img src="assets/images/cpp.png" /></label>
                    </div>  
                    <div class="col s2">
                        <input id="c" name="mode" type="radio" />
                        <label for="c"><img src="assets/images/c.png" /></label>
                    </div>  
                    <div class="col s2">
                        <input id="csharp" name="mode" type="radio" />
                        <label for="csharp"><img src="assets/images/csharp.png" /></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s3">
                    <div id="questionEditor"></div>
                </div>
                <div class="col s7">
                    <div id="codeEditor"></div>
                </div>
                <div class="col s2" id="inputEditorContainer">
                    <div id="inputEditor"></div>
                    <div id="inputExample" class="opened"><p class="content"></p></div>
                </div>
            </div>
        </div>
        <div id="error"></div>
        <button id="action">Lancer la requête AJAX</button> 

        <script src="assets/js/import/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script src="assets/js/materializeInitializer.js"></script>
        <script src="assets/js/valueChecker.js"></script>

        <script src="assets/js/import/ace/ace.js"></script>
        <script src="assets/js/editor.js"></script>
        <script src="assets/js/creation.js"></script>
    </body>
</html>

