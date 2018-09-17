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
        <style type="text/css" media="screen">
            #questionEditor,  #codeEditor, #inputEditor{ 
                position: relative;
                width: 100%;
                height: 500px;
                border: solid white 1px;
            }
            .container {
                max-width: 100%;
                width: 95%;
            }
            .container .row .col {
                padding: 0;
            }
        </style>
        <link rel="stylesheet" href="assets/js/import/codeMirror/lib/codemirror.css" />
        <link rel="stylesheet" href="assets/js/import/codeMirror/theme/monokai.css" />
    </head>
    <body>        
        <?php include path::getLayoutPath() . 'navbar.php'; ?>
        <button id="php">php</button>
        <button id="cpp">cpp</button>
        <button id="c">c</button>
        
        <div class="container">
            <div class="row">
                <div class="col s3">
                    <div id="questionEditor"></div>
                </div>
                <div class="col s7">
                    <div id="codeEditor"></div>
                </div>
                <div class="col s2">
                    <div id="inputEditor"></div>
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
        <script src="assets/js/creation.js"></script>
    </body>
</html>

