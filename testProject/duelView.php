<?php
session_start();
include_once 'assets/classes/path.php';
include path::getLangagePath() . 'fr_FR.php'; //TEMP REMOVE
include_once path::getControllersPath() . 'duelController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>TODO: FIND A TITLE FOR THIS PAGE</title>
        <style type="text/css" media="screen">
            #editor { 
                position: absolute;
                top: 10%;
                right: 10%;
                bottom: 10%;
                left: 10%;
            }
        </style>
    </head>
    <body>        
        <?php include path::getLayoutPath() . 'navbar.php'; ?>

        <div id="editor"></div>
        
        <div id="error" style="position: relative; z-index:999;"></div>

        <button id="action">Lancer la requête AJAX</button>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="<?= path::getJsImportPath() ?>codeMirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="<?= path::getJsImportPath() ?>codeMirror/lib/codemirror.css">
        <script src="<?= path::getJsImportPath() ?>codeMirror/mode/php/php.js"></script>
        <script src="<?= path::getJsPath() ?>duel.js"></script>
    </body>
</html>

