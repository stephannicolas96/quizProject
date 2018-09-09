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
            #editor { 
                position: relative;
                width: 300px;
                height: 300px;
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

        <div id="editor"></div>
        <div id="error" style="position: relative; z-index:999;"></div>
        <button id="action">Lancer la requête AJAX</button> 

        <script src="assets/js/import/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script src="assets/js/valueChecker.js"></script>
        <script src="assets/js/import/codeMirror/lib/codemirror.js"></script>
        <script src="assets/js/import/codeMirror/mode/php/php.js"></script>
        <script src="assets/js/materializeInitializer.js"></script>
        <script src="assets/js/duel.js"></script>
    </body>
</html>

